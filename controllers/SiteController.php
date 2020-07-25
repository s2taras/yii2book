<?php

namespace app\controllers;

use app\models\service\ServiceRecord;
use app\utilities\YamlResponseFormatter;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return 'Our CRM';
    }

    public function actionDocs()
    {
        return $this->render('docindex.md');
    }

    public function actionJson()
    {
        $models = ServiceRecord::find()->all();
        $data = array_map(function (ServiceRecord $model) {return $model->attributes;}, $models);

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = $data;

        return $response;
    }

    public function actionYaml()
    {
        $models = ServiceRecord::find()->all();
        $data = array_map(function (ServiceRecord $model) {return $model->attributes;}, $models);

        $response = Yii::$app->response;
        $response->format = YamlResponseFormatter::FORMAT;
        $response->data = $data;

        return $response;
    }
}