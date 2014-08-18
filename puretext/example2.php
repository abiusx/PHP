<?php
require_once __DIR__."/pure_captcha.php";
$k=new PureCaptcha();
$captchaToken=$k->show();
//store the token somewhere for further use