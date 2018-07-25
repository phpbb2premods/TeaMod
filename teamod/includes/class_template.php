<?php
/***************************************************************************
 *							class_template.php
 *							------------------
 *	begin		: 29/08/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.6 - 19/10/2005
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

/***************************************************************************
*
* Note : this one is in its greatest part a simplified version of phpBB 2.1.x 
* template engine, so credits for good things go to PsoTFX, and eventual bugs to me :).
*
 ***************************************************************************/

define('CH_extended_templates', true);
define('CH_EXTENDED_TPL_VERSION', '1.0.2');

class template_class
{
	var $_tpldata = array();

	// hash of filenames for each template handle.
	var $files = array();
	var $filename = array();
	var $mains = array();

	// this will hash handle names to the compiled/uncompiled code for that handle.
	var $compiled_code = array();

	// directories
	var $template_path;
	var $cache_path;

	// parms
	var $template_name;
	var $root;
	var $cacheprefix;
	var $alt_template_name;
	var $alt_root;
	var $alt_cacheprefix;

	var $no_debug;

	function template_class($root='.', $alt_template_name='', $template_path='')
	{
		global $config;

		// default values
		if ( is_object($config) && !empty($config->data) && (!isset($config->data['mod_extended_tpl_CH']) || ($config->data['mod_extended_tpl_CH'] != CH_EXTENDED_TPL_VERSION)) )
		{
			$config->set('mod_extended_tpl_CH', CH_EXTENDED_TPL_VERSION, true);
		}
		if ( !is_object($config) || empty($config->data) )
		{
			$config->data['cache_path'] = 'cache/';
			$config->data['cache_disabled_template'] = true;
			$config->data['cache_check_template'] = true;
		}
		else if ( $config->data['cache_disabled_template'] )
		{
			$config->data['cache_check_template'] = true;
		}

		// set the cache path
		$this->cache_path = $config->data['cache_path'];
		$this->template_path = empty($template_path) ? 'templates/' : $template_path;

		$this->set($root, $alt_template_name);

		$this->no_debug = false;
	}

	function set($root, $alt_template_name)
	{
		global $config;

		// get main template settings
		$this->template_name = str_replace('//', '/', str_replace('./', '', substr($root, strlen($config->root . $this->template_path))) . '/');
		$this->root = $config->root . $this->template_path . $this->template_name;
		$this->cacheprefix = $config->root . $this->cache_path . 'tpl_' . str_replace('/', '_', $this->template_name);

		// get custom tpls settings
		$this->alt_template_name = $this->tpl_realpath($alt_template_name);
		$this->alt_root = empty($this->alt_template_name) ? '' : $config->root . $this->template_path . $this->alt_template_name;
		$this->alt_cacheprefix = empty($this->alt_template_name) ? '' : $config->root . $this->cache_path . 'tpl_' . str_replace('/', '_', $this->alt_template_name);

		// raz
		$this->_tpldata = array();
	}

	function tpl_realpath($tpl_name)
	{
		global $config;

		if ( !empty($tpl_name) )
		{
			$real_path = phpbb_realpath($config->root . $this->template_path . $this->template_name);
			if ( $real_path != $config->root . $this->template_path . $this->template_name )
			{
				$tpl_real_path = phpbb_realpath($config->root . $this->template_path . $this->template_name . $tpl_name);
				if ( empty($tpl_real_path) )
				{
					$tpl_name = '';
				}
				else
				{
					$root_real_path = phpbb_realpath($config->root . $this->template_path);
					$tpl_name = str_replace('//', '/', str_replace('\\', '/', substr($tpl_real_path, strlen($root_real_path)+1)) . '/');
				}
			}
			// phpbb_realpath fails to get the real path sometime (when not available), so find another way
			else
			{
				$res = $this->template_name;
				if ( substr($tpl_name, 0, 2) == './' )
				{
					$tpl_name = substr($tpl_name, 2);
				}
				if ( substr($tpl_name, 0, 3) == '../' )
				{
					$res = '';
					$tpl_name = substr($tpl_name, 3);
				}
				if ( preg_match('/\.\.\//', $tpl_name) )
				{
					$tpl_name = '';
				}
				else
				{
					$tpl_name = str_replace('//', '/', str_replace('./', '', $res . $tpl_name) . '/');
				}
			}
		}
		return $tpl_name;
	}

	function set_switch($switch_name, $value=true)
	{
		$this->assign_block_vars($switch_name . ($value ? '' : '_ELSE'), array());
	}

	function save(&$save)
	{
		$save = $this->_tpldata;
	}

	function destroy()
	{
		$this->_tpldata = array();
	}

	function restore(&$save)
	{
		$this->_tpldata = $save;
	}

	function get_pparse($handle)
	{
		ob_start();
		$this->pparse($handle);
		$res = ob_get_contents();
		ob_end_clean();
		return $res;
	}

	// Sets the template filenames for handles. $filename_array
	// should be a hash of handle => filename pairs.
	function set_filenames($filename_array)
	{
		if ( !is_array($filename_array) )
		{
			return false;
		}

		$template_names = '';
		foreach ($filename_array as $handle => $filename)
		{
			if ( empty($filename) )
			{
				message_die(GENERAL_ERROR, 'template error - Empty filename specified for ' . $handle, '', __LINE__, __FILE__);
			}

			$this->filename[$handle] = $filename;
			if ( !empty($this->alt_root) )
			{
				$this->files[$handle] = $this->alt_root . $filename;
			}

			// doesn't exists : try the main
			if ( !$this->mains[$handle] = (!empty($this->alt_root) && file_exists($this->files[$handle])) )
			{
				$this->files[$handle] = $this->root . $filename;
				$this->mains[$handle] = false;
			}
		}

		return true;
	}

	function make_filename($filename)
	{
		return !empty($this->alt_root) && file_exists($this->alt_root . $filename) ?  $this->alt_root . $filename : (file_exists($this->root . $filename) ? $this->root . $filename : '');
	}

	// Methods for loading and evaluating the templates
	function pparse($handle)
	{
		if ( defined('DEBUG_TEMPLATE') && !$this->no_debug )
		{
			echo '<!-- Start of : ' . $this->files[$handle] . ' :: ' . $handle . ' -->' . "\n";
		}
		if ($filename = $this->_tpl_load($handle))
		{
			include($filename);
		}
		else
		{
			eval(' ?>' . $this->compiled_code[$handle] . '<?php ');
		}
		if ( defined('DEBUG_TEMPLATE') && !$this->no_debug )
		{
			echo '<!-- End of : ' . $this->files[$handle] . ' :: ' . $handle . ' -->' . "\n";
		}

		return true;
	}

	function assign_var_from_handle($varname, $handle)
	{
		return $this->assign_vars(array($varname => $this->get_pparse($handle)));
	}

	// Load a compiled template if possible, if not, recompile it
	function _tpl_load($handle)
	{
		global $config, $user, $db;

		// If we don't have a file assigned to this handle, die.
		if ( !isset($this->files[$handle]) )
		{
			message_die(GENERAL_ERROR, 'template->_tpl_load(): No file specified for handle ' . $handle, '', __LINE__, __FILE__);
		}

		// get the file name
		$w_filename = str_replace('/', '_', $this->filename[$handle]);
		$filename = ($this->mains[$handle] ? $this->alt_cacheprefix : $this->cacheprefix) . $w_filename . '.' . $config->ext;

		// Recompile page if the original template is newer, otherwise load the compiled version
		if ( !empty($this->compiled_code[$handle]) )
		{
			return false;
		}
		else if ( !$config->data['cache_disabled_template'] && @file_exists($filename) && (!$config->data['cache_check_template'] || (@filemtime($filename) > @filemtime($this->files[$handle]))) )
		{
			return $filename;
		}
		else
		{
			$this->_tpl_load_file($handle);
		}
		return false;
	}

	// Load template source from file
	function _tpl_load_file($handle)
	{
		global $config;

		// Try and open template for read
		if (!($fp = @fopen($this->files[$handle], 'r')))
		{
			message_die(GENERAL_ERROR, 'template->_tpl_load(): File ' . $this->files[$handle] . ' does not exist or is empty', '', __LINE__, __FILE__);
		}

		// compile required
		include_once($config->url('includes/class_template_compiler'));
		$tpl_compiler = new tpl_compiler();
		$this->compiled_code[$handle] = $tpl_compiler->compile(trim(@fread($fp, filesize($this->files[$handle]))));
		@fclose($fp);

		// output the template to the cache
		if ( !$config->data['cache_disabled_template'] )
		{
			$filename = ($this->mains[$handle] ? $this->alt_cacheprefix : $this->cacheprefix) . str_replace('/', '_', $this->filename[$handle]) . '.' . $config->ext;
			$tpl_compiler->compile_write($handle, $this->compiled_code[$handle], $filename);
		}
		unset($tpl_compiler);
	}

	// Assign key variable pairs from an array
	function assign_vars($vararray)
	{
		$this->_tpldata['.'][0] = array_merge(empty($this->_tpldata['.'][0]) ? array() : $this->_tpldata['.'][0], $vararray);
		return true;
	}

	// Assign key variable pairs from an array to a specified block
	function assign_block_vars($blockname, $vararray)
	{
		if (strstr($blockname, '.'))
		{
			// Nested block.
			$blocks = explode('.', $blockname);
			$blockcount = sizeof($blocks) - 1;

			$str = &$this->_tpldata; 
			for ($i = 0; $i < $blockcount; $i++) 
			{
				$str = &$str[$blocks[$i]]; 
				$str = &$str[sizeof($str) - 1]; 
			}
			$str[$blocks[$blockcount]][] = $vararray;
		}
		else
		{
			$this->_tpldata[$blockname][] = $vararray;
		}

		return true;
	}

	// Include a seperate template
	function _tpl_include($filename)
	{
		if ( !empty($filename) )
		{
			$this->set_filenames(array($filename => $filename));
			$this->pparse($filename);
		}
	}
}

?>