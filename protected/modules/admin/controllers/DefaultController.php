<?php
class DefaultController extends AdminController
{
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */

    protected $index_items_count = 6;

	public function actionIndex()
	{
		//Список новых партнёров
		$userModel = User::model()->search( $this->index_items_count, 't.id desc');

		//Список новых клиентов
		$referralModel = Referrals::model()->search( $this->index_items_count, 't.id desc');

		//Последние заявки
		$statedsModel = Stateds::model()->search( $this->index_items_count, 't.id desc');

		//Лучшие партнёры за 30 дней
		$bestPartnersModel = User::model()->search( $this->index_items_count, 'month_profit desc');

		$this->render('index',array(
			'userModel'=>$userModel,
			'referralModel'=>$referralModel,
			'statedsModel'=>$statedsModel,
			'bestPartnersModel'=>$bestPartnersModel,
		));
	}

    public function recursion($model, $s = 0)
    {
        $start = $s;
        if($mod = $model->findAllByAttributes(array('parent_id'=>array($start))))
        {
            echo '<ul>';
            foreach($mod as $items)
            {
                echo '<li>'.$items->title;
                $this->recursion($model, $items->id);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    /**
     * @param $model Menu;
     * @param int $s start from menu level
     */
    public function recursionArray($model, $s = 0)
    {
        $start = $s;
        if($mod = $model->findAll('parent_id=:parent_id ORDER BY pos ASC', array(':parent_id'=>$start)))
        {
            echo '<ul>';
            foreach($mod as $items)
            {
                echo '<li>'.$items->title;
                $this->recursion($model, $items->id);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app() -> errorHandler -> error) {
            if (Yii::app() -> request -> isAjaxRequest)
                echo $error['message'];
            else
                $this -> render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $this->layout = '/layouts/loginLayout';
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionUpdate()
    {
    	$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sys_update.js');

		$meta = $this->updateMeta('latest_version');
		$cv = explode('.', $meta->current_version);
		$lv = explode('.', $meta->latest_version);
		
		$max = max(count($cv), count($lv));
		$hasUpdate = false;
		for ($i=0; $i<$max; $i++)
		{ 
			if (isset($lv[$i]))
			{
				if (isset($cv[$i]))
				{
					if ($lv[$i]>$cv[$i])
					{
						$hasUpdate = true;
						break;
					}
				}
				else
				{
					$hasUpdate = true;
					break;
				}
			}
			else
			{

			} 
		}

		$this->render( 
			'update', 
			array(
				'meta' => $meta, 
				'hasUpdate' => $hasUpdate
			)
		);
    }


	public function actionCheckUpdate()
	{
		$l = $this->getLicense();

		if ($l)
		{
			$metaData = file_get_contents(Yii::app()->params['updateServer'] . 'lastupdate/' . $l);
			$metaData = json_decode($metaData);

			$vers = Yii::app()->db->createCommand()
				->select('version')
				->from('versions')
				->limit(1)
				->order('date DESC')
				->queryRow();
			if (!empty($vers) && $metaData) {
				if ($vers['version'] != $metaData->latest_version) {
					$status = 'has_upd';
					$msg 	= 'Есть новое обновление';
				} else {
					$status = 'ok';
					$msg 	= 'Новых обновлений нет';
				}
			} else if($metaData) {
				$status = 'has_upd';
				$msg 	= 'Есть обновление. Новая версия - ' . $metaData->latest_version;
			} else {
				$status = 'error';
				$msg 	= 'Не удалось проверить обновления';
			}

		} 
		else
		{
			$status = 'error';
			$msg 	= 'Не найден файл лицензии'; 
		}




		echo json_encode(array(
			'status'=> $status,
			'msg'	=> $msg
		));
	}

	public function actionDownloadAndUpdate()
	{
		$l = $this->getLicense();

		if ($l)
		{
			# ссылка на сервер для обновления
			$zipFileURL = Yii::app()->params['updateServer'] . 'update/' . $l;
			$data = file_get_contents($zipFileURL);

			if($data)
			{
				$load_path = 'uploads/update_archive.zip';
				if( file_put_contents( $load_path, $data ) )
				{
					
					$zip = new ZipArchive();
					$zip->open($load_path);
					$zip->extractTo('./');

					if ( $zip->close() ) {
						$this->updateMeta('current_version');
						
						$status = 'updated';
						$msg = "Система обновлена";
						
						$version = file_get_contents('meta.json');
						$version = json_decode($version, true);
						$version = $version['current_version'];
						$versionsql = "INSERT INTO versions(version) VALUES('" . $version . "')";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($versionsql);
						$command->execute();
					}
					else
					{
						$status = 'error';
						$msg = "Не удалось распаковать архив";	
					}
				}
				else
				{
					$status = 'error';
					$msg = 'Не удалось сохранить архив с обновлением';
				}
			}
			else
			{
				$status = 'error';
				$msg = 'Не удалось скачать архив с обновлением';
			}
		}
		else
		{
			$status = 'error';
			$msg = 'Не найден файл с лицензией';
		}

		echo json_encode(array(
			'status'=> $status,
			'msg'	=> $msg
		));
	}

	public function updateMeta($param = false)
	{
		$l = $this->getLicense();
		if ($l) {
			$metaData = file_get_contents(Yii::app()->params['updateServer'] . 'lastupdate/' . $l);
			$encMeta = json_decode($metaData);
			if (!$param) {
				if(is_file('meta.json'))
				{
					file_put_contents('meta.json', $metaData);
				}
				return $encMeta;
			# если указан параметр, то обновляем только его
			} else {
				if (is_file('meta.json')) {
					if (isset($encMeta->$param)) {
						$currentMeta = file_get_contents('meta.json');
						$currentMeta = json_decode($currentMeta);
						if (!is_null($currentMeta)) {
							$currentMeta->$param = $encMeta->$param;
						}
						else
						{
							$currentMeta = $encMeta;
						}
						file_put_contents('meta.json', json_encode($currentMeta));
						return $currentMeta;
					}
				}
			}
		}
	}

	public function getLicense()
	{
		# получим лицензионный код покупателя
		if(is_file('meta.json'))
		{
			$meta = file_get_contents('meta.json');
			$meta = json_decode($meta);
			if ($meta) {
				$l = $meta->licence;
			}
		} 
		
		if (!isset($l) or is_null($l) or !$l) {
			if (is_file('license.txt'))
			{
				$l = file_get_contents('license.txt');
			}
			else
			{
				$l = false;
			}
		}
		return $l;
	}
}