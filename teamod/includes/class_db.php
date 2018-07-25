<?php
/***************************************************************************
 *							class_db.php
 *							------------
 *	begin		: 25/08/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.10 - 21/08/2005
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

class db_class extends sql_db
{
	var $trc_sql;
	var $sql_fields;
	var $sql_values;
	var $sql_update;
	var $sql_stack_fields;
	var $sql_stack_values;

	function db_class($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true)
	{
		parent::sql_db($sqlserver, $sqluser, $sqlpassword, $database, $persistency);
		$this->trc_sql = array();
	}

	function sql_query($query='', $transaction=false, $line='', $file='', $break_on_error=true)
	{
		if ( empty($file) )
		{
			$break_on_error = false;
		}
		if ( defined('DEBUG_RUN_STATS') )
		{
			$query_start = microtime();
		}
		$query_res = parent::sql_query($query, $transaction);
		if ( defined('DEBUG_RUN_STATS') )
		{
			$query_end = microtime();
			if ( defined('DEBUG_SQL') )
			{
				if ( empty($file) && function_exists('debug_backtrace') )
				{
					$dbg = debug_backtrace();
					$file = $dbg[0]['file'];
					$line = $dbg[0]['line'];
					unset($dbg);
				}
				$this->trc_sql[] = array('file' => empty($file) ? '?' : basename($file), 'line' => $line, 'sql' => $query, 'start' => $query_start, 'end' => $query_end);
			}
			else
			{
				$this->trc_sql[] = array('start' => $query_start, 'end' => $query_end);
			}
		}
		if ( !$query_res && $break_on_error )
		{
			message_die(GENERAL_ERROR, 'SQL requests not achieved', '', $line, $file, htmlspecialchars($query));
		}
		return $query_res;
	}

	function sql_escape_string($str)
	{
		return str_replace('\\\'', '\'\'', addslashes(preg_replace('/[\n\r]+/', '<br />', $str)));
	}

	function sql_type_cast(&$value)
	{
		if ( is_float($value) )
		{
			return doubleval($value);
		}
		if ( is_integer($value) || is_bool($value) )
		{
			return intval($value);
		}
		if ( is_string($value) || empty($value) )
		{
			return '\'' . $this->sql_escape_string($value) . '\'';
		}
		// uncastable var : let's do a basic protection on it to prevent sql injection attempt
		return '\'' . $this->sql_escape_string(htmlspecialchars($value)) . '\'';
	}

	function sql_statement(&$fields)
	{
		// init result
		$this->sql_fields = $this->sql_values = $this->sql_update = '';
		if ( empty($fields) )
		{
			return;
		}

		// process
		$first = true;
		foreach ( $fields as $field => $value )
		{
			// field must contain a field name
			if ( !empty($field) && is_string($field) )
			{
				$value = $this->sql_type_cast($value);
				$this->sql_fields .= ( $first ? '' : ', ' ) . $field;
				$this->sql_values .= ( $first ? '' : ', ' ) . $value;
				$this->sql_update .= ( $first ? '' : ', ' ) . $field . ' = ' . $value;
				$first = false;
			}
		}
	}

	function sql_stack_reset($id='')
	{
		if ( empty($id) )
		{
			$this->sql_stack_fields = array();
			$this->sql_stack_values = array();
		}
		else
		{
			$this->sql_stack_fields[$id] = array();
			$this->sql_stack_values[$id] = array();
		}
	}

	function sql_stack_statement(&$fields, $id='')
	{
		$this->sql_statement($fields);
		if ( empty($id) )
		{
			$this->sql_stack_fields = $this->sql_fields;
			$this->sql_stack_values[] = '(' . $this->sql_values . ')';
		}
		else
		{
			$this->sql_stack_fields[$id] = $this->sql_fields;
			$this->sql_stack_values[$id][] = '(' . $this->sql_values . ')';
		}
	}

	function sql_stack_insert($table, $transaction=false, $line='', $file='', $break_on_error=true, $id='')
	{
		if ( (empty($id) && empty($this->sql_stack_values)) || (!empty($id) && empty($this->sql_stack_values[$id])) )
		{
			return false;
		}
		switch( SQL_LAYER )
		{
			case 'mysql':
			case 'mysql4':
				if ( empty($id) )
				{
					$sql = 'INSERT INTO ' . $table . '
								(' . $this->sql_stack_fields . ') VALUES ' . implode(",\n", $this->sql_stack_values);
				}
				else
				{
					$sql = 'INSERT INTO ' . $table . '
								(' . $this->sql_stack_fields[$id] . ') VALUES ' . implode(",\n", $this->sql_stack_values[$id]);
				}
				$this->sql_stack_reset($id);
				return $this->sql_query($sql, $transaction, $line, $file, $break_on_error);
				break;
			default:
				$count_sql_stack_values = empty($id) ? count($this->sql_stack_values) : count($this->sql_stack_values[$id]);
				$result = !empty($count_sql_stack_values);
				for ( $i = 0; $i < $count_sql_stack_values; $i++ )
				{
					if ( empty($id) )
					{
						$sql = 'INSERT INTO ' . $table . '
									(' . $this->sql_stack_fields . ') VALUES ' . $this->sql_stack_values[$i];
					}
					else
					{
						$sql = 'INSERT INTO ' . $table . '
									(' . $this->sql_stack_fields[$id] . ') VALUES ' . $this->sql_stack_values[$id][$i];
					}
					$result &= $this->sql_query($sql, $transaction, $line, $file, $break_on_error);
				}
				$this->sql_stack_reset($id);
				return $result;
				break;
		}
	}
}

class cache
{
	var $cache_path;
	var $cache_file;
	var $cache_disabled;
	var $from_cache;
	var $data_time;

	// constructor
	function cache($cache_file='', $cache_path='', $cache_disabled=false)
	{
		global $config;

		$this->cache_path = empty($cache_path) ? $config->data['cache_path'] : $cache_path;
		$this->cache_file = $cache_file;
		$this->cache_disabled = $cache_disabled;
	}

	// read or create the cache and return the data
	function sql_query($query='', $line='', $file='', $force=false, $key_field='')
	{
		global $db, $config;

		// try with the cache
		$gentime = 0;
		$data = array();
		$this->cache_disabled |= empty($config->data['cache_key']);
		if ( !$force && !$this->cache_disabled )
		{
			$query_beg = microtime();
			@include($config->url($this->cache_path . $this->cache_file));
			if ( !empty($gentime) && ($cache_key == $config->data['cache_key']) )
			{
				$query_end = microtime();
				if ( defined('DEBUG_SQL') )
				{
					$db->trc_sql[] = array('file' => empty($file) ? '?' : basename($file), 'line' => $line, 'sql' => $query, 'start' => $query_beg, 'end' => $query_end, 'cached' => true);
				}
				else
				{
					$db->trc_sql[] = array('start' => $query_beg, 'end' => $query_end, 'cached' => true);
				}
			}
			else
			{
				$gentime = 0;
			}
		}
		$this->from_cache = !empty($gentime);
		$this->data_time = $gentime;

		// no data : read tables
		if ( !$this->from_cache )
		{
			// read table
			$result = $db->sql_query($query, false, $line, $file);
			$this->data_time = time();
			$i = -1;
			$data = array();
			$this->pre_process($data);
			while ( $row = $db->sql_fetchrow($result) )
			{
				$i = empty($key_field) ? ($i+1) : $row[$key_field];
				$data[$i] = $row;
				$this->row_process($data, $i);
			}
			$this->post_process($data);

			// free table
			$db->sql_freeresult($result);

			// write cache
			if ( !$this->cache_disabled )
			{
				$this->write_cache($data, $query);
			}
		}
		return $data;
	}

	function pre_process(&$rows)
	{
	}

	function row_process(&$rows, $row_id)
	{
	}

	function post_process(&$rows)
	{
	}

	function write_cache(&$data, &$query)
	{
		global $config;

		$tpl_data = '<' . '?php
//---------------------------------------------
// Generated : %s (GMT)
// Request : %s
//---------------------------------------------
if ( !defined(\'IN_PHPBB\') )
{
	die(\'Hack attempt\');
}
$gentime = %s;
$cache_key = \'%s\';
$data = unserialize(\'%s\');

?' . '>';

		// output to file
		$handle = @fopen($config->url($this->cache_path . $this->cache_file), 'w');
		@flock($handle, LOCK_EX);
		@fwrite($handle, sprintf($tpl_data, date('Y-m-d H:i:s', $this->data_time), preg_replace('/[\n\r\s\t]+/', ' ', $query), $this->data_time, $config->data['cache_key'], str_replace('\'', '\\\'', str_replace('\\', '\\\\', serialize($data)))));
		@flock($handle, LOCK_UN);
		@fclose($handle);
		@umask(0000);
		@chmod($filename, 0666);
	}
}

?>