<?php
/***************************************************************************
 *							class_presets.php
 *							-----------------
 *	begin		: 05/09/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.2 - 02/01/2005
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

//
// presets object
//
class presets
{
	var $data;
	var $names;
	var $type;

	function presets($type)
	{
		global $db;

		// initiate preset list
		$this->type = $type;
	}

	function read()
	{
		global $db;

		$this->names = array(0 => 'Custom');
		$this->data = array();

		// read all presets of this type
		$sql = 'SELECT p.*, pd.preset_auth, pd.preset_value
					FROM ' . PRESETS_TABLE . ' p
						LEFT JOIN ' . PRESETS_DATA_TABLE . ' pd ON pd.preset_id = p.preset_id
				WHERE p.preset_type = \'' . $this->type . '\'
				ORDER BY p.preset_name, p.preset_id, pd.preset_auth';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);

		while ( $row = $db->sql_fetchrow($result) )
		{
			if ( !isset($this->names[ $row['preset_id'] ]) )
			{
				$this->names[ $row['preset_id'] ] = $row['preset_name'];
				$this->data[ $row['preset_id'] ] = array();
			}
			if ( $row['preset_value'] )
			{
				$this->data[ $row['preset_id'] ][ $row['preset_auth'] ] = intval($row['preset_value']);
			}
		}
	}

	function search(&$auth_values)
	{
		if ( !empty($auth_values) )
		{
			ksort($auth_values);
		}
		foreach ( $this->names as $preset_id => $preset_name )
		{
			if ( !empty($preset_id) )
			{
				if ( $this->data[$preset_id] == $auth_values )
				{
					return $preset_id;
				}
			}
		}
		return 0;
	}

	function update($mode, $preset_id=0, $preset_name='', $preset_data=array())
	{
		global $db;

		// clean preset data
		$sql = 'DELETE FROM ' . PRESETS_DATA_TABLE . '
					WHERE preset_id = ' . $preset_id;
		$db->sql_query($sql, false, __LINE__, __FILE__);

		// delete
		if ( $mode == 'delete' )
		{
			// delete preset header
			$sql = 'DELETE FROM ' . PRESETS_TABLE . '
						WHERE preset_id = ' . $preset_id;
			$db->sql_query($sql, false, __LINE__, __FILE__);
		}
		else
		{
			// process preset header
			$fields = array(
				'preset_type' => $this->type,
				'preset_name' => $preset_name,
			);
			$db->sql_statement($fields);
			if ( $mode == 'create' )
			{
				$sql = 'INSERT INTO ' . PRESETS_TABLE . '
							(' . $db->sql_fields . ') VALUES (' . $db->sql_values . ')';
				$db->sql_query($sql, false, __LINE__, __FILE__);
				$preset_id = $db->sql_nextid();
			}
			else
			{
				$sql = 'UPDATE ' . PRESETS_TABLE . '
							SET ' . $db->sql_update . '
							WHERE preset_id = ' . $preset_id;
				$db->sql_query($sql, false, __LINE__, __FILE__);
			}

			// process preset data
			$db->sql_stack_reset();
			foreach ( $preset_data as $auth_name => $auth_value )
			{
				$fields = array(
					'preset_id' => $preset_id,
					'preset_auth' => $auth_name,
					'preset_value' => $auth_value,
				);
				$db->sql_stack_statement($fields);
			}
			$db->sql_stack_insert(PRESETS_DATA_TABLE, false, __LINE__, __FILE__);
		}
	}
}

?>