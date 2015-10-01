<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;

use app\models\Url;
use app\models\CountryUrl;
use app\models\BrowserUrl;
use app\models\FormUrlCreate;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $formUrlCreate = Yii::$app->session->has('formUrlCreate') ?
                            Yii::$app->session->remove('formUrlCreate') :
                            new FormUrlCreate();

        return $this->render('/index', ['formUrlCreate' => $formUrlCreate]);
    }

    public function actionUrlCreate()
    {
        $formUrlCreate = new FormUrlCreate(Yii::$app->request->post('FormUrlCreate'));
        $formUrlCreate->create();

        if ($formUrlCreate->createdUrl && $formUrlCreate->createdUrl->id) {
            $this->redirect(['site/url-view', 'url' => $formUrlCreate->createdUrl->short]);
        } else {
            Yii::$app->session->set('formUrlCreate', $formUrlCreate);
            $this->redirect(['site/index']);
        }
    }

    public function actionUrlView($url)
    {
        $url = Url::getByUrl($url);
        return $this->render('/view', ['url' => $url]);
    }

    public function actionUrlRedirect($url)
    {
        $url = Url::getByUrl($url);
        if (empty($url)) {
            throw new NotFoundHttpException('Url not found');
        }

        try {
            $geodata = Json::decode(Yii::$app->geolocation->getInfo(), true);
            CountryUrl::increment(empty($geodata['country_name']) ? 'Undefined' : $geodata['country_name'], $url);
        } catch (Exception $e) {
            CountryUrl::increment('Undefined', $url);
        }


        preg_match("/(MSIE|Opera|Firefox|Chrome|Version|Opera Mini|Netscape|Konqueror|SeaMonkey|Camino|Minefield|Iceweasel|K-Meleon|Maxthon)(?:\/| )([0-9.]+)/", Yii::$app->request->userAgent, $browser_info);
        list(,$browser,$version) = $browser_info;
        if (preg_match("/Opera ([0-9.]+)/i", Yii::$app->request->userAgent, $opera)) $browser = 'Opera '.$opera[1];
        if ($browser == 'MSIE') {
            preg_match("/(Maxthon|Avant Browser|MyIE2)/i", Yii::$app->request->userAgent, $ie);
            if ($ie) $browser =  $ie[1].' based on IE '.$version;
            $browser = 'IE '.$version;
        }
        if ($browser == 'Firefox') {
            preg_match("/(Flock|Navigator|Epiphany)\/([0-9.]+)/", Yii::$app->request->userAgent, $ff);
            if ($ff) $browser = $ff[1].' '.$ff[2];
        }
        if ($browser == 'Opera' && $version == '9.80') $browser = 'Opera '.substr(Yii::$app->request->userAgent,-5);
        if ($browser == 'Version') $browser = 'Safari '.$version;
        if (!$browser && strpos(Yii::$app->request->userAgent, 'Gecko')) $browser = 'Browser based on Gecko';
        $browser = $browser.' '.$version;

        BrowserUrl::increment($browser, $url);

        $this->redirect($url->origin);
    }
}
