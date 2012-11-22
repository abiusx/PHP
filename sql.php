<?php
$DB = new mysqli ( "localhost", "root", "", "jf3" );
if (mysqli_connect_errno ())
	trigger_error ( "Unable to connect to MySQLi database." );
$DB->set_charset ( 'UTF-8' );
function SQL($Query)
{
	global $DB;
	$args = func_get_args ();
	array_unshift ( $args, $DB );
	if (get_class ( $DB ) == "PDO")
		return call_user_func_array ( SQL_pdo, $args );
	else 
		if (get_class ( $DB ) == "mysqli")
			return call_user_func_array ( SQL_mysqli, $args );
		else
			throw new Exception ( "Unknown database interface type." );
}
function SQL_pdo($DB, $Query)
{
	$args = func_get_args ();
	array_shift ( $args ); //$DB
	if (count ( $args ) == 1)
	{
		$result = $DB->query ( $Query );
		if ($result->rowCount ())
		{
			return $result->fetchAll ( PDO::FETCH_ASSOC );
		}
		return null;
	}
	else
	{
		if (! $stmt = $DB->prepare ( $Query ))
		{
			$Error = $DB->errorInfo ();
			trigger_error ( "Unable to prepare statement: {$Query}, reason: {$Error[2]}" );
		}
		array_shift ( $args ); //remove $Query from args
		$i = 0;
		foreach ( $args as &$v )
			$stmt->bindValue ( ++ $i, $v );
		$stmt->execute ();
		
		$type = substr ( trim ( strtoupper ( $Query ) ), 0, 6 );
		if ($type == "INSERT")
			return $DB->lastInsertId();
		elseif ($type == "DELETE" or $type == "UPDATE" or $type == "REPLAC")
			return $DB->affected_rows ();
		elseif ($type == "SELECT")
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
}

function SQL_mysqli($DB, $Query)
{
	$args = func_get_args ();
	array_shift ( $args ); //$DB
	if (count ( $args ) == 1)
	{
		$result = $DB->query ( $Query );
		if ($result->num_rows)
		{
			$out = array ();
			while ( null != ($r = $result->fetch_array ( MYSQLI_ASSOC )) )
				$out [] = $r;
			return $out;
		}
		return null;
	}
	else
	{
		if (! $preparedStatement = $DB->prepare ( $Query ))
			trigger_error ( "Unable to prepare statement: {$Query}, reason: {$DB->error}" );
		array_shift ( $args ); //remove $Query from args
		$a = array ();
		foreach ( $args as $k => &$v )
			$a [$k] = &$v;
		$types = str_repeat ( "s", count ( $args ) ); //all params are strings, works well on MySQL and SQLite
		array_unshift ( $a, $types );
		call_user_func_array ( array ($preparedStatement, 'bind_param' ), $a );
		$preparedStatement->execute ();
		
		$type = substr ( trim ( strtoupper ( $Query ) ), 0, 6 );
		if ($type == "INSERT")
			return $DB->insert_id ;
		elseif ($type == "DELETE" or $type == "UPDATE" or $type == "REPLAC")
			return $DB->affected_rows ();
		elseif ($type == "SELECT")
		{
			//fetching all results in a 2D array
			$metadata = $preparedStatement->result_metadata ();
			$out = array ();
			$fields = array ();
			if (! $metadata)
				return null;
			while ( null != ($field = $metadata->fetch_field ()) )
				$fields [] = &$out [$field->name];
			call_user_func_array ( array ($preparedStatement, "bind_result" ), $fields );
			$output = array ();
			$count = 0;
			while ( $preparedStatement->fetch () )
			{
				foreach ( $out as $k => $v )
					$output [$count] [$k] = $v;
				$count ++;
			}
			$preparedStatement->free_result ();
			return ($count == 0) ? null : $output;
		}
		else
			return null;
	}

}
