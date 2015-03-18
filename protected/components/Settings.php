<?php
/**
 * @var $site_name
 * @var $email
 * @var $top_news_count
 * @var $short_description_symbols
 * @var $default_language
 */
class Settings extends CComponent
{
    public $site_name ='';
    public $email ='';
    public $top_news_count = 0;
    public $short_description_symbols = 0;

    public function init()
    {
        $model = Settings::model()->findByPk(1);
        $this->site_name = $model->site_name;
        $this->email = $model->email;
        $this->top_news_count = $model->top_news_count;
        $this->short_description_symbols = $model->short_description_symbols;
    }
}