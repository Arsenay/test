<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Form;
use yii\helpers\Json;

class SiteController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['logout'],
				'rules' => [
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
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

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		\himiklab\yii2\recaptcha\ReCaptcha::widget([
            'name'          => 'reCaptcha',
            'siteKey'       => '6Lde7iIUAAAAAPhYRso9xllQ6Xv0gsTbKeDFVy2D',
            'widgetOptions' => ['class' => 'col-sm-offset-3']
        ]);

		$data = array();

		$this->all_items = rand(100, 1000);

		$data['form_href'] = Yii::$app->urlManager->createUrl(['site/form']);

		$data['categories'] = $this->createCategoriesTree($items);

		return $this->render('index', $data);
	}

	/* new */
	private $all_items = 0;

	private $items = 0;
	
	private function createCategoriesTree($level = 0){
		$categories = array();

		$all_items = ($level) ? rand(0, 15) : $this->all_items;

		$level++;

		while ( $all_items && $this->all_items != $this->items ) {
			$this->items++;

			$categories[$this->items]['name'] = $this->items;

			if ( rand(0, $level) == 0 ) {
				$categories[$this->items]['child'] = $this->createCategoriesTree($level);
			}

			$all_items--;
		}

		return $categories;
	}

	public function actionForm() {
		$form = new Form();

		$data['form'] = $form;

		$form->load(Yii::$app->request->post());

		if ( $json['validate'] = $form->validate() ) {
			$data['giphy'] = $this->randomGiphy();
		}

		$json['html'] = $this->renderPartial('form', $data);

		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

		return $json;
	}

	private function randomGiphy(){
		$request = 'http://api.giphy.com/v1/gifs/random?api_key=dc6zaTOxFJmzC';

		$response = @file_get_contents($request);

		if ($response === false) {
            throw new Exception('Unable connection to the Giphy server.');
        }

        $info = Json::decode($response, true);

        $image = isset($info["data"]["image_original_url"]) ? $info["data"]["image_original_url"] : '';

        return $image;
	}

	/* end new */

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		}
		return $this->render('login', [
			'model' => $model,
		]);
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return string
	 */
	public function actionContact()
	{
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
			Yii::$app->session->setFlash('contactFormSubmitted');

			return $this->refresh();
		}
		return $this->render('contact', [
			'model' => $model,
		]);
	}

	/**
	 * Displays about page.
	 *
	 * @return string
	 */
	public function actionAbout()
	{
		return $this->render('about');
	}
}
