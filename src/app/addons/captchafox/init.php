<?php
use Tygh\Addons\CaptchaFox\CaptchaFoxDriver;
use Tygh\Registry;
use Tygh\Application;
use Tygh\Web\Antibot;

Tygh::$app->extend('antibot', function(Antibot $antibot, Application $app) {
    $driver = new CaptchaFoxDriver(Registry::get('addons.captchafox'));
    $antibot->setDriver($driver);

    return $antibot;
});