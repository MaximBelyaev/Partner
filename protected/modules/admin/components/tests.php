<?php
$dayOfWeek = date('l', time());

if ($dayOfWeek === 'Monday')
{
    $licenseCode = file_get_contents("license.txt");
    $domain = str_replace('.', '',$_SERVER['SERVER_NAME']);
    $licenseString = $licenseCode . 'hostname' . $domain;
    $request = Yii::app()->params->updateServer . 'check/' . $licenseString;
    $status = '';
    if ($request)
    {
        $status = file_get_contents($request);
    }

    if ($status === "doesn't exist")
    {
        $allNotifications = Notifications::model()->findAll();
        $notification = new Notifications();
        $notification->user_id = Yii::app()->user->id;
        $notification->text = "Ваша партнёрка будет отключена через 3 дня. Свяжитесь с администратором для выяснений дальнейших подробностей.";
        $notification->is_new = 1;
        foreach ($allNotifications as $n)
            if ($n->user_id !== $notification->user_id && $n->text !== $notification->text)
            {
                $notification->save();
            }
        $errorDate = strtotime(date("+3 day", strtotime($notification->date)));
        if (time() >= $errorDate)
        {
            header("Location: activate.php");
            exit();
        }
    }
}