<?php
assert(PHP_INT_SIZE==8);
/**
 * This continuous array implementation consumes about the
 * same amount of memory the array would take in C. It is not fixed-size
 * but can only be expanded (or coded for shrienks).
 * It consumes 8 times less memory than SplFixedArray
 * And about 20 times less than PHP arrays
 * Both PHP implementations take about 1 microsecond for 1 operation
 * This implementation takes about 30 microseconds for 1 operation (64 bit)
 * And about 15 microseconds for 1 operation (32 bit)
 * i.e its 20 times slower but consumes 20 times less memory
 */
class DynamicArray implements ArrayAccess , Countable 
{
	//big endian, no rotation needed
	static protected $wordSize=PHP_INT_SIZE;
	protected $data="";
	function __construct($size=1)
	{
		$this->data=str_repeat(chr(0), $size*static::$wordSize);
	}
	
	public function offsetExists ( $offset )
	{
		return $offset/static::$wordSize <strlen($this->data);
	}
	public function offsetGet ( $offset )
	{
		$res="";
		for ($i=0;$i<static::$wordSize;++$i)
		{
			$res<<=8;
			$res|=ord($this->data[$offset*static::$wordSize + $i]);
		}
		return $res;
	}
	public function offsetSet ( $offset , $value )
	{
		for ($i=0;$i<static::$wordSize;++$i)
		{
			$this->data[$offset*static::$wordSize + (static::$wordSize-$i-1)]=chr($value);
			$value>>=8;
		}
	}
	public function  offsetUnset ( $offset )
	{
		$this->offsetSet($offset,0);
	}
	public function count ()
	{
		return strlen($this->data/static::$wordSize);
	}
}
class DynamicArray64 extends DynamicArray
{
	static protected $wordSize=8;
	function __construct($size=1)
	{
		assert(PHP_INT_SIZE>=8);
		parent::__construct($size);
	}
}
class DynamicArray32 extends DynamicArray
{
	static protected $wordSize=4;
}
class DynamicArray16 extends DynamicArray
{
	static protected $wordSize=2;
	public function offsetGet ( $offset )
	{
		return ord($this->data[$offset<<1])<<8 | ord($this->data[($offset<<1) +1]);
	}
	public function offsetSet ( $offset , $value )
	{
		$this->data[($offset<<1)+1]=chr($value);
		$this->data[$offset<<1]=chr($value>>8);
	}
}

$m=memory_get_usage();
//sanity check
$dynamicArray=new DynamicArray16(1000000);
// $dynamicArray=new SplFixedArray(1000000);
// $dynamicArray=array();

for ($i=0;$i<1000000;++$i)
{
	$data=mt_rand(0,0xFFFF);
	$dynamicArray[$i]=$data;
	if ($dynamicArray[$i]!=$data)
		die("DynamicArray fault $i: {$data} not equal to {$dynamicArray[$i]}");
	unset($data);
}

echo ((memory_get_usage()-$m)/1024)." KB".PHP_EOL;