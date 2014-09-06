<?php
require_once "byte_array.php";

class BitArray implements arrayaccess , Countable
{
	protected $data;
	protected $count=0;
	function __construct($size=1)
	{
		$this->data=new ByteArray( ((int)($size/8))+1);
	}

	public function offsetExists($offset)
	{
		$arrayIndex=floor($index/8);
		return isset($this->data[$arrayIndex]);
	}
	public function offsetGet($offset)
	{
		$arrayIndex=($offset>>3);
		$bitIndex=7-($offset&7);
		return ($this->data[$arrayIndex]>>$bitIndex)&1;
	}
	public function offsetSet($offset, $value)
	{
		if ($offset>=$this->count)
			$this->count=$offset+1;
		$arrayIndex=($offset>>3);
		$bitIndex=7- ($offset&7);
		$bit=$value&1;
		if (!isset($this->data[$arrayIndex]))
			$this->data[$arrayIndex]= $bit<<$bitIndex;
		else
			$this->data[$arrayIndex]|=($bit << $bitIndex);
	}
	public function offsetUnset($offset)
	{
		$this->offsetSet($offset,0);
	}
	public function count()
	{
		return $this->count;
	}
	public function realCount()
	{
		return count($this->data);
	}
	public function byte($offset)
	{
		return $this->data[$offset];
	}
}
class MultidimensionalBitArray extends MultidimensionalByteArray
{
	function __construct()
	{
		$args=func_get_args();
		if (count($args))
		{
			$this->dimensions=$args;
			$this->data=new BitArray($this->size());
		}
		parent::__construct();
	}
}