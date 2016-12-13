<?php

class AdvertisementAdmin extends ModelAdmin
{

    public $showImportForm = false;

    public static $managed_models = array(
        'Advertisement',
    );

    public static $url_segment = 'advertisements';
    public static $menu_title = 'Advertisements';

    static function set_menu_title($v)
    {
        self::$menu_title = $v;
    }
}

