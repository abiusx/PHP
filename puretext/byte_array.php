<?php
class IndexCountMistmatch extends Exception {}
class ByteArray implements arrayaccess , Countable 
{
	protected $data="";
	function __construct($size=1)
	{
		$this->data=str_repeat(chr(0), $size);
	}
	
	public function offsetExists ( $offset )
	{
		return $offset<strlen($this->data);
	}
	public function offsetGet ( $offset )
	{
		return ord($this->data[$offset]);
	}
	public function offsetSet ( $offset , $value )
	{
		return $this->data[$offset]=chr($value);
	}
	public function  offsetUnset ( $offset )
	{
		$this->offsetSet($offset,0);
	}
	public function count ()
	{
		return strlen($this->data);
	}
}
class MultidimensionalByteArray
{
	public $dimensions;
	protected $data;
	function __construct()
	{
		$args=func_get_args();
		if (count($args))
		{
			$this->dimensions=$args;
			$this->data=new ByteArray($this->size());
		}

	}
	protected function calculateIndex($args)
	{
		$t=count($args);
		if ($t!=count($this->dimensions))
			throw new IndexCountMistmatch();
		$index = 0;
		$multiplier=1;
		for ($i = 0;$i < $t;$i++)
		{
		  $index += $args[$i] * $multiplier;
		  $multiplier *= $this->dimensions[$i];
		}

		return $index;
	}
	public function index()
	{
		$args=func_get_args();
		return $this->calculateIndex($args);
	}
	public function get()
	{
		$args=func_get_args();
		$index=$this->calculateIndex($args);
		return $this->data[$index];
	}
	public function set()
	{
		$args=func_get_args();
		$value=array_pop($args);
		$index=$this->calculateIndex($args);
		$this->data[$index]=$value;
	}
	public function size ()
	{
		$size=1;
		for ($i=0;$i<count($this->dimensions);++$i)
			$size*=$this->dimensions[$i];
		return $size;
	}
	public function count()
	{
		return strlen($this->data);
	}
}