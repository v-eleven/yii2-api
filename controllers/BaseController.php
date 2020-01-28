<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    public $layout = false;

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        return true;
    }

    public function ajaxData($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $responseData = [
            'code' => Yii::$app->params['codes']['ajax_data'],
            'data' => $data,
        ];
        Yii::$app->response->content = json_encode($responseData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        Yii::$app->response->send();
        exit;
    }

    public function ajaxMessage($message, $code = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $responseData = [
            'code' => $code ?? Yii::$app->params['codes']['ajax_error'],
            'msg' => $message,
        ];
        Yii::$app->response->content = json_encode($responseData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        Yii::$app->response->send();
        exit;
    }
}
