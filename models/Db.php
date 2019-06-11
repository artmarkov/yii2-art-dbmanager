<?php
namespace artsoft\dbmanager\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;

class Db extends Model
{

    public function getFiles($files){
        Yii::$app->params['count_db'] = count($files);
        $arr = array();
        foreach($files as $key => $file){
            $arr[] = array(
                'dump' => $file,
                'size' => Yii::$app->formatter->asSize(filesize($file)),
                'create_at' => Yii::$app->formatter->asDatetime(filectime($file)),
                'type' => pathinfo($file, PATHINFO_EXTENSION),
            );
        }
       
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $arr,
            'sort' => [
                'attributes' => ['size', 'create_at'],
            ],
            'pagination' => [
                'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
            ],
        ]);
        return $dataProvider;
    }
    
    public function import($path) {
        if (file_exists($path)) {
            $path = \yii\helpers\Html::encode($path);
            $db = Yii::$app->getDb();
            if (!$db) {
                Yii::$app->session->setFlash('crudMessage', Yii::t('art/dbmanager', 'No database connection.'));
            }
            $db->password = str_replace("(","\(",$db->password);
            exec('mysql --host=' . $this->getDsnAttribute('host', $db->dsn) . ' --user=' . $db->username . ' --password=' . $db->password . ' ' . $this->getDsnAttribute('dbname', $db->dsn) . ' < ' . $path);
            Yii::$app->session->setFlash('crudMessage', Yii::t('art/dbmanager', "Dump {path} successfully imported.", ['path' => $path]));
        } else {
            Yii::$app->session->setFlash('crudMessage', Yii::t('art/dbmanager', 'The specified path does not exist.'));
        }
        return Yii::$app->response->redirect(['dbmanager/default/index']);
    }


    public function export($path = null) {
        $path = FileHelper::normalizePath(Yii::getAlias($path));
        if (file_exists($path)) {
            if (is_dir($path)) {
                if (!is_writable($path)) {
                    Yii::$app->session->setFlash('crudMessage', Yii::t('art/dbmanager','Directory is not writable.'));
                    return Yii::$app->response->redirect(['dbmanager/default/index']);
                }
                $fileName = 'dump_' . date('Y_m_d_H_i_s') . '.sql';
                $filePath = $path . DIRECTORY_SEPARATOR . $fileName;
                $db = Yii::$app->getDb();
                if (!$db) {
                    Yii::$app->session->setFlash('crudMessage', Yii::t('art/dbmanager', 'No database connection.'));
                    return Yii::$app->response->redirect(['dbmanager/default/index']);
                }
                //Экранируем скобку которая есть в пароле
                $db->password = str_replace("(","\(",$db->password);
                exec('mysqldump --host=' . $this->getDsnAttribute('host', $db->dsn) . ' --user=' . $db->username . ' --password=' . $db->password . ' ' . $this->getDsnAttribute('dbname', $db->dsn) . ' --skip-add-locks > ' . $filePath);
                Yii::$app->session->setFlash('crudMessage', Yii::t('art/dbmanager', "Export completed successfully. File {fileName} in the {path} folder.", ['fileName' => $fileName, 'path' => $path]));
            } else {
                Yii::$app->session->setFlash('crudMessage', Yii::t('art/dbmanager', 'The path must be a folder.'));
            }
        } else {
            Yii::$app->session->setFlash('crudMessage', Yii::t('art/dbmanager', 'The specified path does not exist.'));
        }
        return Yii::$app->response->redirect(['dbmanager/default/index']);
    }

    //Возвращает название хоста (например localhost)
    private function getDsnAttribute($name, $dsn) {
        if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
            return $match[1];
        } else {
            return null;
        }
    }

    public function delete($path) {
        if (file_exists($path)) {
            $path = \yii\helpers\Html::encode($path);
            unlink($path);
            Yii::$app->session->setFlash('crudMessage', Yii::t('art/dbmanager', 'The database dump removed.'));
        } else {
            Yii::$app->session->setFlash('crudMessage', Yii::t('art/dbmanager', 'The specified path does not exist.'));
        }
        return Yii::$app->response->redirect(['dbmanager/default/index']);
    }
    
    public function download($path) {       
        if (file_exists($path)) {
            $path = \yii\helpers\Html::encode($path);
          return  Yii::$app->response->sendFile($path);
        } else {
            Yii::$app->session->setFlash('crudMessage', Yii::t('art/dbmanager', 'The specified path does not exist.'));
        }
        return Yii::$app->response->redirect(['dbmanager/default/index']);
    }
   
}