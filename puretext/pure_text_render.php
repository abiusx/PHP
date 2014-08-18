<?php
class PureTextRender
{
	/**
	 * this variable contains ascii bitmap data used to render text
	 * generated using the generate function below
	 */
	protected $ascii_table="eNrtnVmOHrcOhbdE1Vxdq8lj1hBk78E12kBuO+4iKUqiyPNgt2FA+IfWV5wOyT8+lv34+OvPD3r++Cjrz399/tefH+Vff5bPn+vnz+3z5/7j59//+0t7clGfXNUnN/XJXX3yUJ881Scv9clbfxMqLpH+FhXtNfq8u07vP32eJPb9p9+8Jv32/hPzNemX+0/Mz0m/3H9ivlv65f6L3u2l/oZu9W9lvvu/RLz/X0+2vP9vr/n7+896zVNNzqX+hjLd/9Xf/f/6232//1R9/1knd/XJQ3IX3/0f1smLc4vl/g/F8n82/89/uf9PYv+fdaPc3H/W52x0/4P5/3vr+0/q57+d/1PE/k9p+PwXnTzVFtL4/lNM/+fg3X8Kfv97+j+4/47u/xkx/yn3f4rY/ynV/k8Z6P8g//l5/y/r+y96ui3qkysnLyKPf4vY/5Hn/0Wveao/56X+bm/1yfnu/x35+U/i+Jd//0UnD/XJU/058fxn1b9olAEgtQEgtgH4z8R4owLYtyeHFwBE3+2tPjkhAN0qwO8e0NtrklgBIbcAxFZAkOQ1D/XJU33yUn/OVBagWQmYlTJYJE71ewjAOrmpT+7qz3moA1mUwBoDsPaqAdDTXgPByuRv6pO7+uShPnly3JEijoERA/wEYPPnAsmTQHoR3FxBsF0SqKhFQNEA2Fu7QN/+ehf1yeFZIFFA6iYLpFeBsk5OCMCBNgC2h7urL6OoDNYjDYog+CcAJwCoA4CVVzkknrw8CIYOTg/AFUEIR82C4KIOgltkgUSf81J/t6myQC+VYJ7n5yUGmCsIHtEJiRjgaycY8QD4XgCifkot6pPGFkAuBR2RBi3VFoB18lafnBCAItNC00AL0FMLNAIAeRBc1C6Q3gIE08ItC4Jg3TCIEc0AopMQg7IAWFt1w9RLIeiprQO0zAJRtQUY2Q3JrwRHB2BDFmieLJCHduBgWaDFYT/wiH54pEGzAoBKsBEAcjk0mQXBqATrAUAl2KgSrO+IrO+IRyVYD8AFAOpGgsoBEJ00BkAvh44aBN8AgD1lZFe30hinQe3qAJTdAqwYCm0shhsRA2Aoih6AAgB6T0W3iwEgh64HAJVgrAVIDcCKubgohHUCgDwCsEUYjC46aRQEwwLEsAB7JBeoJwB2k9Hlc4HkYrj6LBDr5IQAHJFcILvVMPViOH4dwE4M16IfgCTvdkIX6PTvAvVsiKl3gXoOxqovhL1bANF3+/8AiAbZjQLgmgcAvRq0NLAA9VKIejGcfC5QqXaBgnWErXek7Xj125GQBk0WBG8TVIJ7ANDTAozUArnoB/DkAm0lggvkoQ6gjwGKOggeIYdWAECeLcCSe0HSiAV5+ixQfU+w/VSI2V2gFVKI3pVgOzEcJsPVA7ABAGiBNC5QnzoANQdgBwDzqUGRBbIDAD3BsAC9gmDSZ4GoGQAT9QSTGgASA5ClEsyfC6SwADSDBbgiaoH4Yjj9jrD6lkjWSaOWSNHJVmI4j1qg7Y4shushhcBgrFcLwOunHwPATn4LYfrJcD23RMotgF0hjOZwgVwD4KgSLPq+3MUAI+TQ8qkQchdI9IhoFgS3A2CJqAWSN8Swsty72jc2boiRSyH006Flgp7ptED7GsECiMz0pj7JaoiRj0XRb4mEBagHYEMMYAOAXSGsuMoCRQdgRwwwXx2gZxAsEyVMpwbdD1iA3nWAAgvgCIATAHgDADFATwAwHbr7bFA7FwhaoHoAMB0aAGSWQx8UWQxHj+cFGXo1qIcFGQaDsTxUgg9Mh+6+JnWEHNq+EBakH+BY/KVB7UYjztUUry+E9WiKV6RBZ5BDHyuyQJnEcJgO/RWAiSrB9MyQBuVvimdNaDBakyoSblipQWXrxQYBsKMhZr6GmPqxKF3qADRDEHzMI4XQxwDy4bh8F4iefpVg0Wte6pO3+qSsH8CFC4RK8DAxnDwLRNVZIHkdIHgl+LhgAUZbAHkWCBbADoAb/QBx5NAjLMDkLZEnAQAAkHgsylkQA8wfAzjNAs0QA5wTVYLnqAPw06ByOfRk/QAzpEHPEJVg7AmeYj+ASwuwzbMiqYcadERL5IgFGfoleQo1KGte2SgAdrhAOgD0a1LfpkLwYwCqDoLrpRCzu0BHBDXonFmgGIWw2dOgJyzAdyoiUluAHmI4BMH1AFyRACAzAMpUANTvCc4LwI06AMajJ64DXBRBCxSrDoBKcE8AUAmGBRBZAHJhAcgMgAUWYF4LgDRoPQDoCe6eBsV+AE8u0BZxOC6kEK6kEJ6b4i9UghEDpLYABwAYPRxXrgVinbzUJ1NZAFSCh1uAkWNR+BaAVSufMAi+cgMgejIa7wizW5Td0gJEzwLdAGA+ABAEmwFwE1YkzbciST8dGnuCvwJQInWE6Yfjsk4ajUcXnRwOgOGOMI9ZoHvJ3Q8wEgC7BRktO8LKU50G9RwD3CF7gtES2R4ACmIBNgzHbTMeXb8fwPeKpGALMu4dG2J0WiAA0BIAbvxM1QAc80yF6OkCwQJksQAnLECdBajfEqkfjut8P8AMCzLuC1Mh2izJ00+FCNcU7zoIxp7g7hagHQDYDyAGoFDoRcH6UrB8QQB/Tyr00I58oELYFDyhDbCPAhLbgCVSIsh+SUzLZfH2a8KcqyE8JoIKrbABceKAFl6QzJWxkkPILI9WVPDjHW9IBdl0xssJoCypIM+CoEIh68E00AagNX6yOOCI7AXR008RUV8PC6eJk20YKPqji/LR9OMdn/CCbOcDyeMAvg0gdSRMahtA9gT48oIu/7ronl4QBgSl84JQEzYSRdjZAJ/zIRRTQqewAYVAAHJBmXNBBTVh1AMyT4krZQEBkIZKpmSRXSSsyAUxCCAhAagJN7IBUZRxY2rCDbcF0BcCNhAQJw7AwhiFF4Qe4YniAFG+uPHi7DBxQKiacM9JWfo4INakLIEX5JMAdAk32hkTvUOG9DbAVzb0AgEZCKhfGcA6Od+83FJQE56YAOc1YRk8gwhYUBPuTkD92pgRuiCFDZiiJrygJpw6DiB1PaDtyNx+PWILasKNasLvNqAMsAFYG/ALARPUhKOtTxWp/CNtjikuCQg1Nhr9AdidJCZg97s8qSQh4NtH48wEiH6hwwg4/PaI6ffn0VO7QVW/OwODo6caHF0W1ISxOyA3ARdmxrXRBcnrAfJOeXpqlwhDF7TcEZVxJJ6WwjppvD2gfmqingBSqyIEHTJT2IAVNWF4Qa3mBcmOFn38XUVAQT2gLhdUXxFDNvR9h1hDG4CaMGxAFQGkJ4BREeOpkaoIQJ8wCGiVC6J6AjrEAclrwqKMDmrCAWvC6w4CMhAg+py5CGheE/42e2ZUE4YXhIqYmoAUNWFi2wD+Jj393NB6G2A/O7ppj5jvOKBZTZh1pxrVhPkVMVEnxq7WzRtXxPR9wpia+AsB6BM29oJ82gC7SNigIubKC9rIvzb0vSJG1ZGwvCJG6khYNG3uVL9mow0aFfsDXHbIbAW6IOiCMuuCtgUEgIDUBKwgAASkJmADASAgNQHdasL0zNApj4pYtorY1q0m3EMVoZ8dDQLSEnD2JuC9Isaqsq7qkyAABPybgG41Yb0u6J0AghcEArQEoCY8jIC5IuGoBOzoE56QANgAQwIwO7o7ASKtPghoTcASKRJGfwAIEBNgXhN+083/noA3xViLqYkgID0BW6T+AGxTxTZVMQHYJ2xEgN4GULUNoKf/FqUwNuAAAbYEyG0APbWb9Oip3aSn7w+YfZPefkIZB2VcZmXcfoEAEJCagDuCKkLvBbXrlI+2TTXqvKADNWFkQ1NnQ48ScWacngBs0ktnA5ZIBNTPCyK1F1Q/K4K/Q4b1bhsp4yiaDVixRUm3RUlfDyBJXct4XlDXLUqisTDDCNhyxwH6SNguF1TUuaDSIRdkUBP2bQMc7hNmfder+uSmvlPGFbF6bShmRxsQcGCnvJeN2oiEhxBwtq4HULUNkHdJynNB9NROTdSrIvRe0EhlnKAiRq4JuPx5QfK5oagHoB6gJuDuZQOoYxzA7w8QUberNw8c6tc0yoaKvttUqojT8exou/4AerS6oB6qiB5dknaRcDQbcKJPWFkRa6eObjE9XfRuW21T9UkA9gkH6pRvsUMmvA3APmHMikgdCZ9bpEiYHETCJI6E5T1irNdEJMwjYPebDeXPikA2FDZATcABZZxum6ro3YIAvwSE3CfcQxUhslju+gP4BIg+54wEdN8nzI8DeuqC5OpokcYZNsAvAXckAuo3aOhtAOKAOQm4KOIWJUTCIIBNAGrCSgL0qgj91ETRSaNs6Js2lNEjxkr7lqJW+9YRsMyjC+pRD5D3CbNOGtUDiuTkpdY2tFJFCAjoaANQEx7uBWGDxlACNhCAOGAeAkhOAL0QsPvLBdFTOzVR3yOGbGg6G4Ca8IQ1YVakBAJ4BJyYllLXKS/vDxAFiKf6pFF/gOgbmpGAC16QNy9Iro6mAbkgA1WEj1zQDQK8EFA/O7pnh4xCHf09PIMIuAmqiDpVhH5eEMEGeCAAs6OHTcwicSRM6lyQfU04yia9u/s+YXkkTK4JqO+U76mKkM+KqCCAprABK5RxICA1AVsvG6DfovTeJwwCQICagL23F0SPpz1iICA9AUfuTXogID0Bp79IuJ4AAgEggEvA5bc/gD87mtQE6FUR9nvE3itioipcp53y5VFvUfJBwB1hcq5+h4wow76rTx7qk53qAU23KBnUA0hOALEIWIhy1wNE3oEbAuQ75dsRwLAB5NgGLFRy1wNAQHoClghblEAACFATsObOhoKA9ARsiAN0BNjtkhwxNbHLLsk5CNgRB4CA1AQcuXVBICA9ASfiABCQmoBrng0aPmdF1G9T1c+Mk+8RY5281SdlBBQXBNy5taGiiqfx3FB5l6T9PuH0uqClEHrE2I8pTM6N1yW5lIIeMRCQmoAFPWIgIDUBK3rEQEBqAjb0iIGA1ATsmJ7ee4eMiHTjekD93FAFAZ7nhi6l++xovhdU3yFD6g4ZuTKO1DaAnn7ZUFLbAOpqA6gfASeUcaPqAfCCXNiAC8o4EJCagBvKOBCQmYCFoIwDAakJQJ9wdwJG5oK6akNlR0cRsPjThsqzoSIRYgAbMFmXpOts6BJqn/BcBLDerRsvqEIdXR7H2dBlgza0bp8w6x4b7xGT75K0jwNIHwe4UkcvO7ShICA1AQe0oSAgNQEntKEgIDUBF7ShICA1ASFrwvxcEAjITsBKUEePJoDMCBixP0BAQPFYE14LCOhNQDtVBPYHMFyJrwRgn/CEBNh7Qd4JaGgDsE8YBOQmAPuEQUBuAnZkQ0FAagIOxAG2BGBy7lyTc9cTcQAISE3AhTgABKQm4EYcAAIyE7A57BPWe0Gs27ipfTb3FTH0CSsIKNCG2syMkxNA0QmYYn/AhppwIFUEbICCANSEQUBuAlATBgG5CdgRB4CA1AQcyIaCgNQEnBH7A/TZUBITwHq3hzpNfqpf09/MOJcTs7YLHTK6iVn2NoCefttU6cH+gE8CbmRDe++QgRfkqR6wE7KhICA1AQXZUBCQmoAFuSAQkJoA1IRTE0CvBMiG/pA6zSCLhIk/K+IbJ+QHAVuEXBCpCaAHyrhg09NJaAPQJwwbkNcG/P0PsBTMHA==";
	function __construct()
	{
		$this->ascii_table=unserialize(gzuncompress(base64_decode($this->ascii_table)));
	}
	/**
	 * displays an ASCII character using characters!
	 * just for testing purposes, to see if the ascii_table is properly made
	 */
	public function display_char($char,$ascii_table=null)
	{
		if ($ascii_table===null)
			$ascii_table=$this->ascii_table;
		$data=$ascii_table[ord($char)];
		for ($j=0;$j<13;++$j)
		{
			for ($i=0;$i<6;++$i)
				echo $data[$j][$i]?" ":"#";
			echo PHP_EOL;
		}
	}

	/**
	 * generates an ASCII bitmap table from an image file
	 * currently set to extract it from gif files, like the first one at:
	 * http://www.hassings.dk/lars/fonts.html
	 * needs to be fixed size fonts. Can either display the progress or not.
	 * returns a 2D ascii bitmap array
	 * you can then compress it and replace with the member variable above to have
	 * a new font: base64_encode(gzcompress(serialize($ascii),9))
	 */
	function generate_ascii_table($file,$charWidth=6,$charHeight=13,$display=true)
	{

		$ascii=array();
		$im = imagecreatefromgif($file);
		for ($j=0;$j<16*$charHeight;++$j)	
		{
			for ($i=0;$i<32;++$i)
			{
				if ($i%2==1) continue; //skip empty spaces
					for ($x=0;$x<$charWidth;++$x)
					{
						$rgb = imagecolorat($im, $i*$charWidth+$x, $j);
						if ($display) echo $rgb?" ":"#";

						$yIndex=floor($j/$charHeight);
						$ascii[($yIndex*16+$i/2)][$j%$charHeight][$x]=$rgb;
						
					}
					if ($display) echo "|";
			}
			if ($display) echo PHP_EOL;
			if ($j%$charHeight==$charHeight-1)
				if ($display) echo str_repeat("-", ($charWidth+1)*16).PHP_EOL;
		}
		return $ascii;
	}
	/**
	 * converts a bitmap to a bytemap, which is necessary for outputting it
	 * can't output bits ya know?
	 */
	protected function bitmap2bytemap($bitmap,$width,$height)
	{
		$bytemap=array();
		for ($j=0;$j<$height;++$j)
		{
			for ($i=0;$i<$width/8;++$i)
			{
				$bitstring="";	
				for ($k=0;$k<8;++$k)
					if (isset($bitmap[$j][$i*8+$k]))
						$bitstring.=$bitmap[$j][$i*8+$k];
					else
						$bitstring.="1";
				$bytemap[$j][]=bindec($bitstring);
			}
		}
		return $bytemap;
	}
	/**
	 * displays a bitmap on the browser screen
	 * a bitmap needs to be sent to this function, and it needs to literally be a bitmap,
	 * i.e a 2D array with every element being either 1 or 0
	 */
	public function display_bitmap($width,$height,$bitmap)
	{
		$rowSize=floor(($width+31)/32)*4;
		$size=$rowSize*$height + 62; //62 metadata size 
		$bytemap=$this->bitmap2bytemap($bitmap,$width,$height);
		

		header("Content-Type: image/bmp");
		#bitmap header
		echo "BM"; //header
		echo (pack('V',$size)); //bitmap size , 4 bytes unsigned little endian
		echo "RRRR";
		echo (pack('V',14+40+8)); //bitmap data start offset , 4 bytes unsigned little endian, 14 forced, 40 header, 8 colors

		#info header
		echo pack('V',40); //bitmap header size (min 40), 4 bytes unsigned little-endian
		echo (pack('V',$width)); //bitmap width , 4 bytes signed integer
		echo (pack('V',$height)); //bitmap height , 4 bytes signed integer
		echo (pack('v',1)); //number of colored plains , 2 bytes 
		echo (pack('v',1)); //color depth , 2 bytes 
		echo (pack('V',0)); //compression algorithm , 4 bytes (0=none, RGB)
		echo (pack('V',0)); //size of raw data, 0 is fine for no compression , 4 bytes 
		echo (pack('V',11808)); //horizontal resolution (dpi), 4 bytes 
		echo (pack('V',11808)); //vertical resolution (dpi), 4 bytes 
		echo (pack('V',0)); //number of colors in pallette (0 = all), 4 bytes 
		echo (pack('V',0)); //number of important colors (0 = all), 4 bytes 

		#color palette
		echo (pack('V',0)); //first color, black
		echo (pack('V',0x00FFFFFF)); //next color, white

		for ($j=$height-1;$j>=0;--$j)
			for ($i=0;$i<$rowSize/4;++$i)
				for ($k=0;$k<4;++$k)
					if (isset($bytemap[$j][$i*4+$k]))
						echo pack('C',$bytemap[$j][$i*4+$k]);
					else
						echo pack('C',1);
	}
	/**
	 * converts a text to a bitmap
	 * which is a 2D array of ones and zeroes denoting the text
	 */
	public function text_bitmap($text)
	{
		$height=count($this->ascii_table[0]);
		$width=count($this->ascii_table[0][0]);

		$result=array();
		$baseY=$baseX=0;
		for ($index=0;$index<strlen($text);++$index)
		{
			if ($text[$index]==PHP_EOL)
			{
				$baseY+=$height;
				$baseX=0;
				continue;
			}
			$ascii_entry=$this->ascii_table[ord($text[$index])];
			for ($j=0;$j<$height;++$j)
			{
				for ($i=0;$i<$width;++$i)
					$result[$baseY+$j][$baseX+$i]=$ascii_entry[$j][$i];
				$result[$baseY+$j][$baseX+$width]=1; //space between chars
			}
			$baseX+=$width;
		}
		return $result;
	}
	/**
	 * returns an array containing width and height of the text
	 * useful to know the size of image for rendering
	 */
	public function text_size($text)
	{
		$height=count($this->ascii_table[0]);
		$width=count($this->ascii_table[0][0]);
		$maxX=0;
		$maxY=$height;
		$baseX=0;
		for ($index=0;$index<strlen($text);++$index)
		{
			if ($text[$index]===PHP_EOL)
			{
				$maxY+=$height;
				$baseX=0;
				continue;
			}
			$baseX+=$width;
			if ($baseX>$maxX)
				$maxX=$baseX;
		}
		return array($maxX,$maxY);
	}

	/**
	 * rotates a bitmap, returning new dimensions with the bitmap
	 * return array(bitmap,new_width,new_height)
	 */
	public function rotate_bitmap($bitmap,$width,$height,$degree)
	{
		$c=cos(deg2rad($degree));
		$s=sin(deg2rad($degree));

		$newHeight=round($width*$s+$height*$c);
		$newWidth=round($width*$c + $height*$s);
		$x0 = $width/2 - $c*$newWidth/2 - $s*$newHeight/2;
 		$y0 = $height/2 - $c*$newHeight/2 + $s*$newWidth/2;
		$result=array();
		for ($j=0;$j<$newHeight;++$j)
			for ($i=0;$i<$newWidth;++$i)
			{
				$y=-$s*$i+$c*$j+$y0;
				$x=$c*$i+$s*$j+$x0;
				if (isset($bitmap[$y][$x]))
					$result[$j][$i]=$bitmap[$y][$x];
			}
		return array($result,$newWidth,$newHeight);
	}
	/**
	 * scales a bitmap to be bigger
	 */
	public function scale_bitmap($bitmap,$width,$height,$scaleX,$scaleY)
	{
		$newHeight=$height*$scaleY;
		$newWidth=$width*$scaleX;
		$result=array();
		for ($j=0;$j<$newHeight;++$j)
			for ($i=0;$i<$newWidth;++$i)
				$result[$j][$i]=$bitmap[$j/$scaleY][$i/$scaleX];
		return $result;
	}
	/**
	 * renders some text into an image, displaying it on the browser
	 */
	public function render_text($text,$scale=null)
	{
		$bitmap=$this->text_bitmap($text);
		$size=$this->text_size($text);
		if ($scale!==null)
			$bitmap=$this->scale_bitmap($bitmap,$size[0],$size[1],$scale,$scale);
		else
			$scale=1;
		$this->display_bitmap($size[0]*$scale,$size[1]*$scale,$bitmap);
	}
}