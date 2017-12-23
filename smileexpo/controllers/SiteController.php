<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Form;
use app\models\Menu;
use yii\helpers\Url;

class SiteController extends Controller
{
	private $all_items = 0;
	private $items = 1;

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
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
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$model = new Form();

		$data = [];
		if ($root = Menu::findOne(['name' => '1'])) {
			$data = $root->tree();
		}

		return $this->render('index', [
			'model'	=> $model,
			'data'	=> $data,
		]);
	}

	public function actionThread()
	{
		if ($root = Menu::findOne(['name' => '1'])) {
			$tree = $root->tree();
		} else {
			return $this->redirect(Url::home());
		}

		$ids = explode(',', Yii::$app->request->get('ids'));
		$ids = array_diff($ids, array(''));
		$ids = array_unique($ids);
		sort($ids);
		$ids = array_unique($ids);
		if (count($ids) > 0) {
			$data[0] = [
				'id' => '0',
				'tree' => '1',
				'lft' => '0',
				'rgt' => '0',
				'depth' => '0',
				'name' => '0',
				'title' => '0',
				'children' => [],
				'folder' => true,
			];

			foreach ($ids as $id) {
				$item = $this->findItem($tree, $id);
				
				if ($item) {
					$data[0]['children'][] = $item;
				} else {
					return $this->redirect(Url::home());
				}
			}
		} else {
			return $this->redirect(Url::home());
		}
		return $this->render('thread', [
			'data'	=> $data,
		]);
	}

	private function findItem($data, $name)
	{
		foreach ($data as $item) {
			if ($item['name'] == $name) {
				return $item;
			}
			if ($item['children']) {
				return $this->findItem($item['children'], $name);
			}
		}
		return false;
	}
	
	private function createTree(&$parent, $level = 0)
	{
		$all_items = ($level) ? rand(0, 4) : $this->all_items;

		$level++;

		while ( $all_items && $this->all_items != $this->items ) {
			$this->items++;

			$item = new Menu(['name' => (string)$this->items]);
			$item->appendTo($parent);

			if ( rand(0, 1) ) {
				$this->createTree($item, $level);
			}

			$all_items--;
		}
	}

	public function actionForm()
	{
		$model = new Form();

		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$this->all_items = $model->items;

			Menu::truncateTable();
			$root = new Menu(['name' => '1']);
			$root->makeRoot();
			$this->createTree($root);
			$root->save();
		}

		return $this->redirect(Url::home());
	}
}