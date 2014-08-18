<?php
require_once "pure_text_render.php";
class PureCaptcha extends PureTextRender
{
	/**
	 * generate a captcha compatible string
	 */
	protected function generate_captcha($length=4)
	{
		return substr(str_shuffle("2346789ABDHLMNPRTWXYZ"), 0, $length);
	}
	/**
	 * draw a captcha to the screen, returning its value
	 */
	public function show($distort=true)
	{
		$captcha=$this->generate_captcha();
		$text=" ".implode(" ",str_split($captcha));
		$bitmap=$this->text_bitmap($text);
		$scale=2.3;
		$degree=mt_rand(2,4);
		if (mt_rand()%100<50)
			$degree=-$degree;
		list($width,$height)=$this->text_size($text);
		list($bitmap,$width,$height)=$this->rotate_bitmap($bitmap,$width,$height,$degree);
		$bitmap=$this->scale_bitmap($bitmap,$width,$height,$scale,$scale);
		$width*=$scale;
		$height*=$scale;
		if ($distort) $bitmap=$this->distort($bitmap,$width,$height);
		$this->display_bitmap($width,$height,$bitmap);
		return $captcha;
	}
	/**
	 * adds random noise to the captcha
	 */
	protected function distort($bitmap,$width,$height)
	{
		for ($j=0;$j<$height;++$j)
			for ($i=0;$i<$width;++$i)
				if (isset($bitmap[$j][$i]) && mt_rand()%100<12)
					$bitmap[$j][$i]=0;
		return $bitmap;
	}
}
