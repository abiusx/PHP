<?php
require_once "pure_text_render.php";

mt_srand(time());
$bitArray=new BitArray();
for ($i=0;$i<1000;++$i)
{
	$bit=mt_rand(0,1);
	$bitArray[$i]=$bit;
	if ($bitArray[$i]!=$bit)
		die("BitArray fault $i: {$bit} not equal to {$bitArray[$i]}");
}
$byteArray=new ByteArray();
for ($i=0;$i<1000;++$i)
{
	$byte=mt_rand(0,255);
	$byteArray[$i]=$byte;
	if ($byteArray[$i]!=$byte)
		die("ByteArray fault $i: {$byte} not equal to {$byteArray[$i]}");
}
$mba=new MultidimensionalByteArray(3,5,7);
for ($i=0;$i<3;++$i)
for ($j=0;$j<5;++$j)
for ($k=0;$k<7;++$k)
{
	$byte=mt_rand(0,255);
	$mba->set($i,$j,$k,$byte);
	if ($mba->get($i,$j,$k)!=$byte)
		die("MultidimensionalByteArray fault: $i,$j,$k");
}


$mba=new MultidimensionalBitArray(3,5,7);
for ($i=0;$i<3;++$i)
for ($j=0;$j<5;++$j)
for ($k=0;$k<7;++$k)
{
	$bit=mt_rand(0,1);
	$mba->set($i,$j,$k,$bit);
	if ($mba->get($i,$j,$k)!=$bit)
		die("MultidimensionalBitArray fault: $i,$j,$k");
}


$startMemory=(memory_get_usage()/1024);
$b=new PureTextRender();
// $data=$a;
// echo count($data).PHP_EOL;
$text="Hello there baow you doing today?
	I hope you're well!

	How you doing there?
	";
$bitmap=$b->text_bitmap($text);
$bitmap=$b->scale_bitmap($bitmap,5,5);
$b->display_bitmap($bitmap);die();

/***/
echo((memory_get_usage()/1024)-$startMemory)." KB".PHP_EOL;
echo(memory_get_peak_usage()/1024/1024)." MB".PHP_EOL;