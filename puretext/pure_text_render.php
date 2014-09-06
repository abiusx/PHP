<?php
require_once "bitmap.php";
class PureTextRender
{
	/**
	 * this variable contains ascii bitmap data used to render text
	 * generated using the generate function below
	 */
	protected $ascii_table="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";
	function __construct()
	{
		$this->ascii_table=unserialize(gzuncompress(base64_decode($this->ascii_table)));
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
		$ascii=new MultidimensionalBitArray(256,$charHeight,$charWidth);
		// $ascii=array();
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
					$ascii->set(($yIndex*16+$i/2),$j%$charHeight,$x,$rgb);
					// $ascii[($yIndex*16+$i/2)][$j%$charHeight][$x]=$rgb;
					
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
	protected function bitmap2bytemap(Bitmap $bitmap)
	{
		#TODO: skip this conversion!
		$width=$bitmap->width();
		$height=$bitmap->height();
		$bytemap=array();
		for ($j=0;$j<$height;++$j)
		{
			for ($i=0;$i<$width/8;++$i)
			{
				$bitstring="";	
				for ($k=0;$k<8;++$k)
					if ($bitmap->index($j,$i*8+$k)<$bitmap->size())
						$bitstring.=$bitmap->get($j,$i*8+$k);
					else
						$bitstring.="0";
				$bytemap[$j][]=bindec($bitstring);
				// if ($bitmap->index($j,$i)<$bitmap->size())
				// 	$bytemap[$j][]=$bitmap->byte($bitmap->index($j,$i));
				// else
				// 	$bytemap[$j][]=0;
			}
		}
		return $bytemap;
	}
	/**
	 * displays a bitmap string on the browser screen
	 */
	public function display_bitmap(Bitmap $bitmap)
	{
		header("Content-Type: image/bmp");
		echo $this->generate_bmp($bitmap);
	}
	/**
	 * generates a monochrome BMP file 
	 * a bitmap needs to be sent to this function, and it needs to literally be a bitmap,
	 * i.e a 2D array with every element being either 1 or 0
	 * @param  integer $width
	 * @param  integer $height
	 * @param  array $bitmap
	 * @return string
	 */
	public function generate_bmp(Bitmap $bitmap)
	{
		#TODO: dont convert to bytemap
		$width=$bitmap->width();
		$height=$bitmap->height();
		$bytemap=$this->bitmap2bytemap($bitmap);
		
		$rowSize=floor(($width+31)/32)*4;
		$size=$rowSize*$height + 62; //62 metadata size 
		#bitmap header
		$data= "BM"; //header
		$data.= (pack('V',$size)); //bitmap size , 4 bytes unsigned little endian
		$data.= "RRRR";
		$data.= (pack('V',14+40+8)); //bitmap data start offset , 4 bytes unsigned little endian, 14 forced, 40 header, 8 colors

		#info header
		$data.= pack('V',40); //bitmap header size (min 40), 4 bytes unsigned little-endian
		$data.= (pack('V',$width)); //bitmap width , 4 bytes signed integer
		$data.= (pack('V',$height)); //bitmap height , 4 bytes signed integer
		$data.= (pack('v',1)); //number of colored plains , 2 bytes 
		$data.= (pack('v',1)); //color depth , 2 bytes 
		$data.= (pack('V',0)); //compression algorithm , 4 bytes (0=none, RGB)
		$data.= (pack('V',0)); //size of raw data, 0 is fine for no compression , 4 bytes 
		$data.= (pack('V',11808)); //horizontal resolution (dpi), 4 bytes 
		$data.= (pack('V',11808)); //vertical resolution (dpi), 4 bytes 
		$data.= (pack('V',0)); //number of colors in pallette (0 = all), 4 bytes 
		$data.= (pack('V',0)); //number of important colors (0 = all), 4 bytes 

		#color palette
		$data.= (pack('V',0x00FFFFFF)); //next color, white
		$data.= (pack('V',0)); //first color, black

		for ($j=$height-1;$j>=0;--$j)
			for ($i=0;$i<$rowSize/4;++$i)
				for ($k=0;$k<4;++$k)
					if (isset($bytemap[$j][$i*4+$k]))
						$data.= pack('C',$bytemap[$j][$i*4+$k]);
					// if ($bitmap->index($j,$i*4+$k)<$bitmap->size())
						// $data.= pack('C',$bitmap->byte($j*$bitmap->width()+($i*4+$k) ));
					else
						$data.= pack('C',0);
		return $data;
	}
	/**
	 * filters text replacing some characters with their visible equivalents
	 * @param  string $text original
	 * @return string       filtered text
	 */
	protected function filter_text($text)
	{
		$text=str_replace("\t", "    ", $text);
		return $text;
	}
	/**
	 * converts a text to a bitmap
	 * which is a 2D array of ones and zeroes denoting the text
	 */
	public function text_bitmap($text)
	{
		$text=$this->filter_text($text);
		$height=$this->ascii_table->dimensions[1];
		$width =$this->ascii_table->dimensions[2];

		$size=$this->text_size($text);
		$result=new Bitmap($size[0],$size[1]);
		$baseY=$baseX=0;
		for ($index=0;$index<strlen($text);++$index)
		{
			if ($text[$index]==PHP_EOL)
			{
				$baseY+=$height;
				$baseX=0;
				continue;
			}
			// $ascii_entry=$this->ascii_table[ord($text[$index])];
			$ascii_entry=ord($text[$index]);
			for ($j=0;$j<$height;++$j)
			{
				for ($i=0;$i<$width;++$i)
					$result->set($baseY+$j,$baseX+$i, ~$this->ascii_table->get($ascii_entry,$j,$i));
					// $result[$baseY+$j][$baseX+$i]=$ascii_entry[$j][$i];
				$result->set($baseY+$j,$baseX+$width,0); //space between chars
			}
			$baseX+=$width;
		}
		return $result;
	}
	/**
	 * returns an array containing height and width of the text
	 * useful to know the size of image for rendering
	 */
	protected function text_size($text)
	{
		$height=($this->ascii_table->dimensions[1]);
		$width=($this->ascii_table->dimensions[2]);
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
		return array($maxY,$maxX);
	}

	/**
	 * rotates a bitmap, returning new dimensions with the bitmap
	 * return bitmap
	 */
	public function rotate_bitmap(Bitmap $bitmap, $degree)
	{
		$c=cos(deg2rad($degree));
		$s=sin(deg2rad($degree));

		$width=$bitmap->width();
		$height=$bitmap->height();
		$newHeight=round(abs($width*$s)+abs($height*$c));
		$newWidth=round(abs($width*$c) + abs($height*$s));
		$x0 = $width/2 - $c*$newWidth/2 - $s*$newHeight/2;
 		$y0 = $height/2 - $c*$newHeight/2 + $s*$newWidth/2;
		$result=new Bitmap($newHeight,$newWidth);
		for ($j=0;$j<$newHeight;++$j)
			for ($i=0;$i<$newWidth;++$i)
			{
				$y=-$s*$i+$c*$j+$y0;
				$x=$c*$i+$s*$j+$x0;
				if ($bitmap->index($y,$x)<$bitmap->size())
					$result->set($j,$i,$bitmap->get((int)$y,(int)$x));
			}
		return $result;
	}
	/**
	 * scales a bitmap to be bigger
	 */
	public function scale_bitmap(Bitmap $bitmap,$scaleX,$scaleY)
	{
		$height=$bitmap->height();
		$width=$bitmap->width();
		$newHeight=$height*$scaleY;
		$newWidth=$width*$scaleX;
		$result=new Bitmap($newHeight,$newWidth);
		for ($j=0;$j<$newHeight;++$j)
			for ($i=0;$i<$newWidth;++$i)
				$result->set($j,$i,$bitmap->get((int)($j/$scaleY),(int)($i/$scaleX)));
		return $result;
	}
	/**
	 * renders some text into an image, displaying it on the browser
	 */
	public function render_text($text,$scale=null)
	{
		$bitmap=$this->text_bitmap($text);
		if ($scale!==null)
			$bitmap=$this->scale_bitmap($bitmap,$scale,$scale);
		else
			$scale=1;
		$this->display_bitmap($bitmap);
	}
}