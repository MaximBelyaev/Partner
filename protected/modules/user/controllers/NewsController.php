<?php

class NewsController extends MyUserController
{

	public function actionIndex()
	{
		$model = new News;
		$dataProvider = 
		$this->render( 'index', array(
			'model' => $model,
		));
	}

	public function actionView()
	{
		$id    = $_GET['id'];
		$model = $this->loadModel($id);

		$watched = false;
		foreach ($this->news_views as $key => $value) {
			if ($value->news_id == $id) {
				$watched = true;
			}
		}
		if (!$watched) {
			$nw = new NewsViews();
			$nw->user_id = $this->user->id;
			$nw->news_id = $id;
			$nw->save();
			array_push($this->news_views, $nw);
			$this->news_to_watch--;
		}

		$this->render( 'view', array(
			'model' => $model,
		));
	}

	public function loadModel($id)
	{
		$model = News::model()->findByPk($id);
		if( $model === null ){
			throw new CHttpException( 404, "Новость с ID $id была удалена или не создана");
		}
		return $model;
	}

}