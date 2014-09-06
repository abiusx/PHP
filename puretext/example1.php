<?php
require_once __DIR__."/pure_text_render.php";
$obj=new PureTextRender();
$text="Hello there people!".PHP_EOL."This is rendered using only PHP...";
$bitmap=$obj->text_bitmap($text); 
$size=$obj->text_size($text); 
list($rotated,$size[0],$size[1])=$obj->rotate_bitmap($bitmap,$size[0],$size[1],10); 
$obj->display_bitmap($size[0],$size[1],$rotated); 
