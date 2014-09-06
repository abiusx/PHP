<?php
require_once "bit_array.php";
/***
class Bitmap extends MultidimensionalBitArray
{
	function __construct($height,$width)
	{
		$this->dimensions=array($height,$width);
		$this->data=new BitArray($this->size());

		parent::__construct();
	}
	function width()
	{
		return $this->dimensions[1];
	}
	function height()
	{
		return $this->dimensions[0];
	}
}
/**/
//the following version is almost twice as fast (11 vs 18.5), but has a lot of code repeat:
/**/
class Bitmap
{
	protected $width;
	protected $height;
	protected $data;
	function __construct($height,$width)
	{
		$this->width=$width;
		$this->height=$height;
		$this->data=new BitArray($this->size());
	}
	function width()
	{
		return $this->width;
	}
	function height()
	{
		return $this->height;
	}
	public function byte($offset)
	{
		return $this->data->byte($offset);
	}
	public function index($y,$x)
	{
		return $y*$this->width+$x;
	}
	public function get($y,$x)
	{
		return $this->data[$y*$this->width+$x];
	}
	public function set($y,$x,$value)
	{
		return $this->data[$y*$this->width+$x]=$value;
	}
	function size()
	{
		return $this->width*$this->height;
	}
}
/**/