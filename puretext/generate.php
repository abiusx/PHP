<?php
require_once "pure_text_render.php";
$ptr=new PureTextRender();
$data=$ptr->generate_ascii_table("/Users/abiusx/Desktop/xterm613.gif");
$ascii_table_string=base64_encode(gzcompress(serialize($data),9));
echo $ascii_table_string;


//testing:
$data=unserialize(gzuncompress(base64_decode($ascii_table_string)));
echo PHP_EOL;
for ($i=0;$i<13;++$i)
{

	for ($j=0;$j<6;++$j)
	{
		echo $data->get(ord('C'),$i,$j);
	}
	echo PHP_EOL;
}