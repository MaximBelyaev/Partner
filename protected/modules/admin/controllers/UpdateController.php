<?php
class UpdateController extends AdminController
{

	public function actionCheckUpdate()
	{
		$l = $this->getLicense();

		if ($l)
		{
			# проверяем есть ли информация про обновления на сервере собновлений.
			$metaData = file_get_contents(Yii::app()->params['updateServer'] . 'lastupdate/' . $l);
			$metaData = json_decode($metaData);

			if ( !is_null($metaData) )
            {
				$vers = Yii::app()->db->createCommand()
					->select('version')
					->from('versions')
					->limit(1)
					->order('date DESC')
					->queryRow();
				if (!empty($vers) && $metaData)
                {
					if ($vers['version'] != $metaData->latest_version)
                    {
						$status = 'has_upd';
						$msg 	= 'Есть новое обновление';
					}
                    else
                    {
						$status = 'ok';
						$msg 	= 'Новых обновлений нет';
					}
				}
                elseif ($metaData)
                {
					if (isset($metaData->current_version) && $metaData->current_version != $metaData->latest_version)
                    {
						$status = 'has_upd';
						$msg 	= 'Есть обновление. Новая версия - ' . $metaData->latest_version;
					}
                    elseif (!isset($metaData->current_version) && $metaData->latest_version)
                    {
						$status = 'has_upd';
						$msg 	= 'Есть обновление. Новая версия - ' . $metaData->latest_version;
					}
                    else
                    {
						$status = 'ok ';
						$msg 	= 'Новых обновлений нет';
					}
				}
                else
                {
					$status = 'error';
					$msg 	= 'Не удалось проверить обновления';
				}
			}
            else
            {
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

	/* скачиваем архив с обновлением, если надо обновляем БД */
	public function actionDownloadAndUpdate()
	{
		/* получаем лицензию пользователя */
		$l = $this->getLicense();

		if ($l)
		{
			/* ссылка на сервер для обновления */
			$zipFileURL = Yii::app()->params['updateServer'] . 'update/' . $l;
			/* получаем архив с последней версией */
			$data = file_get_contents($zipFileURL);

			if ($data)
			{
				$load_path = 'uploads/update_archive.zip';
				/* полученный архив сохраняем в файл на сервере */
				if (file_put_contents ($load_path, $data))
				{
					$zip = new ZipArchive();
					$zip->open($load_path);
					$zip->extractTo('./');

					if ($zip->close())
                    {
						$dbUpdateUrl = Yii::app()->params['updateServer'] . 'dbUpdate/' . $l;
						$dbData = file_get_contents($dbUpdateUrl);
						$dbData = json_decode($dbData);

						if ($dbData)
                        {
							if ($dbData->status == 'has_update')
                            {
								$connection = Yii::app()->db;
								try
                                {
									$command = $connection->createCommand($dbData->db_update);
									$command->execute();
								}
                                catch (Exception $e)
                                {
									$command = $connection->createCommand($dbData->db_revert);
									@$command->execute();
								}
							}
						}

						$this->updateMeta('current_version');
						$status = 'updated';
						$msg = "Система обновлена";
                        $version = file_get_contents(Yii::app()->params['updateServer'] . 'lastupdate/' . $l);
                        $version = json_decode($version);
                        $version = $version->current_version;
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
		if ($l)
        {
			$metaData = file_get_contents(Yii::app()->params['updateServer'] . 'lastupdate/' . $l);
			$encMeta = json_decode($metaData);
			if (!$param)
            {
				if (is_file('meta.json'))
				{
					file_put_contents('meta.json', $metaData);
				}
				return $encMeta;
			# если указан параметр, то обновляем только его
			}
            else
            {
				if (is_file('meta.json'))
                {
					if (isset($encMeta->$param))
                    {
						$currentMeta = file_get_contents('meta.json');
						$currentMeta = json_decode($currentMeta);
						if (!is_null($currentMeta))
                        {
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
		if (is_file('meta.json'))
		{
			$meta = file_get_contents('meta.json');
			$meta = json_decode($meta);
			if ($meta)
            {
				$l = $meta->licence;
			}
		}

		if (!isset($l) or is_null($l) or !$l)
        {
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