<?php
/***************************************************************************
 *							class_template_compiler.php
 *							---------------------------
 *	begin		: 16/01/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.5 - 23/10/2005
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

class tpl_compiler
{
	// Various counters and storage arrays
	var $block_names;
	var $block_else_level;
	var $block_nesting_level;

	function tpl_compiler()
	{
		$this->block_names = array();
		$this->block_else_level = array();
		$this->block_nesting_level = 0;
	}

	function compile($code)
	{
		global $config;

		// Remove any "loose" php ... we want to give admins the ability
		// to switch on/off PHP for a given template. Allowing unchecked
		// php is a no-no. There is a potential issue here in that non-php
		// content may be removed ... however designers should use entities 
		// if they wish to display < and >
		// remove also tabulations
		$match_php_tags = array('#\<\?php .*?\?\>#is', '#\<\script language="php"\>.*?\<\/script\>#is', '#\<\?.*?\?\>#s', '#\<%.*?%\>#s');
		$code = preg_replace($match_php_tags, '', $code);
		$code = preg_replace("/([\n\r])([ \t]*)/", '\1', $code);

		preg_match_all('#<!-- (.*?) (.*?)?[ ]?-->#s', $code, $blocks);
		$text_blocks = preg_split('#<!-- (.*?) (.*?)?[ ]?-->#s', $code);
		for ( $i = 0; $i < count($text_blocks); $i++ )
		{
			$this->compile_var_tags($text_blocks[$i]);
		}

		$compile_blocks = array();
		$count_text_blocks = count($text_blocks);
		for ( $i = 0; $i < $count_text_blocks; $i++ )
		{
			switch ( $blocks[1][$i] )
			{
				case 'BEGIN':
					$this->block_else_level[] = false;
					$compile_blocks[] = '<?php ' . $this->compile_tag_block($blocks[2][$i]) . ' ?>';
					break;

				case 'BEGINELSE':
					$this->block_else_level[ sizeof($this->block_else_level) - 1 ] = true;
					$compile_blocks[] = '<?php }} else { ?>';
					break;

				case 'END':
					array_pop($this->block_names);
					$compile_blocks[] = '<?php ' . ((array_pop($this->block_else_level)) ? '}' : '}}') . ' ?>';
					break;

				case 'INCLUDE':
					$compile_blocks[] = '<?php $this->_tpl_include(\'' . trim($blocks[2][$i]) . '\'); ?>';
					break;

				default:
					$compile_blocks[] = $this->compile_var_tags($blocks[0][$i]);
					break;
			}
		}

		$template_php = '';
		$count_text_blocks = count($text_blocks);
		for ( $i = 0; $i < $count_text_blocks; $i++ )
		{
			// remove orphean lines when appropriate
			$text_block[$i] = preg_replace("/^([\n\r]{2,})/", '', $text_blocks[$i]);
			$template_php .= (trim($text_blocks[$i]) == '' ? '' : $text_blocks[$i]) . trim($compile_blocks[$i]);
		}

		// There will be a number of occassions where we switch into and out of
		// PHP mode instantaneously. Rather than "burden" the parser with this
		// we'll strip out such occurences, minimising such switching
		// also remove orphean lines
		return str_replace(' ?><?php ', '', $template_php);
	}

	function compile_var_tags(&$text_blocks)
	{
		// change template varrefs into PHP varrefs
		$varrefs = array();

		// This one will handle varrefs WITH namespaces
		preg_match_all('#\{(([a-z0-9\-_]+?\.)+?)([a-z0-9\-_]+?)\}#is', $text_blocks, $varrefs);

		$count_varrefs_1 = count($varrefs[1]);
		for ($j = 0; $j < $count_varrefs_1; $j++)
		{
			$namespace = $varrefs[1][$j];
			$varname = $varrefs[3][$j];
			$new = $this->generate_block_varref($namespace, $varname);

			$text_blocks = str_replace($varrefs[0][$j], $new, $text_blocks);
		}

		// This will handle the remaining root-level varrefs
		$text_blocks = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "<?php echo \$this->_tpldata['.'][0]['\\1']; ?>", $text_blocks);

		return $text_blocks;
	}

	function compile_tag_block($tag_args)
	{
		// Allow for control of looping (indexes start from zero):
		// foo(2)    : Will start the loop on the 3rd entry
		// foo(-2)   : Will start the loop two entries from the end
		// foo(3,4)  : Will start the loop on the fourth entry and end it on the fourth
		// foo(3,-4) : Will start the loop on the fourth entry and end it four from last
		if (preg_match('#^(.*?)\(([\-0-9]+)(,([\-0-9]+))?\)$#', $tag_args, $match))
		{
			$tag_args = $match[1];
			$loop_start = ($match[2] < 0) ? '$_' . $tag_args . '_count ' . ($match[2] - 1) : $match[2];
			$loop_end = ($match[4]) ? (($match[4] < 0) ? '$_' . $tag_args . '_count ' . $match[4] : ($match[4] + 1)) : '$_' . $tag_args . '_count';
		}
		else
		{
			$loop_start = 0;
			$loop_end = '$_' . $tag_args . '_count';
		}

		$tag_template_php = '';
		array_push($this->block_names, $tag_args);

		if (sizeof($this->block_names) < 2)
		{
			// Block is not nested.
			$tag_template_php = '$_' . $tag_args . "_count = (isset(\$this->_tpldata['$tag_args'])) ?  sizeof(\$this->_tpldata['$tag_args']) : 0;";
		}
		else
		{
			// This block is nested.

			// Generate a namespace string for this block.
			$namespace = implode('.', $this->block_names);

			// Get a reference to the data array for this block that depends on the
			// current indices of all parent blocks.
			$varref = $this->generate_block_data_ref($namespace, false);

			// Create the for loop code to iterate over this block.
			$tag_template_php = '$_' . $tag_args . '_count = (isset(' . $varref . ')) ? sizeof(' . $varref . ') : 0;';
		}

		$tag_template_php .= 'if ($_' . $tag_args . '_count) {';
		$tag_template_php .= 'for ($_' . $tag_args . '_i = ' . $loop_start . '; $_' . $tag_args . '_i < ' . $loop_end . '; $_' . $tag_args . '_i++){';

		return $tag_template_php;
	}

	/**
	 * Generates a reference to the given variable inside the given (possibly nested)
	 * block namespace. This is a string of the form:
	 * ' . $this->_tpldata['parent'][$_parent_i]['$child1'][$_child1_i]['$child2'][$_child2_i]...['varname'] . '
	 * It's ready to be inserted into an "echo" line in one of the templates.
	 * NOTE: expects a trailing "." on the namespace.
	 */
	function generate_block_varref($namespace, $varname)
	{
		// Strip the trailing period.
		$namespace = substr($namespace, 0, strlen($namespace) - 1);

		// Get a reference to the data block for this namespace.
		$varref = $this->generate_block_data_ref($namespace, true);
		// Prepend the necessary code to stick this in an echo line.

		// Append the variable reference.
		$varref .= "['$varname']";
		$varref = "<?php echo $varref; ?>";

		return $varref;

	}

	/**
	 * Generates a reference to the array of data values for the given
	 * (possibly nested) block namespace. This is a string of the form:
	 * $this->_tpldata['parent'][$_parent_i]['$child1'][$_child1_i]['$child2'][$_child2_i]...['$childN']
	 *
	 * If $include_last_iterator is true, then [$_childN_i] will be appended to the form shown above.
	 * NOTE: does not expect a trailing "." on the blockname.
	 */
	function generate_block_data_ref($blockname, $include_last_iterator)
	{
		// Get an array of the blocks involved.
		$blocks = explode('.', $blockname);
		$blockcount = sizeof($blocks) - 1;
		$varref = '$this->_tpldata';

		// Build up the string with everything but the last child.
		for ($i = 0; $i < $blockcount; $i++)
		{
			$varref .= "['" . $blocks[$i] . "'][\$_" . $blocks[$i] . '_i]';
		}

		// Add the block reference for the last child.
		$varref .= "['" . $blocks[$blockcount] . "']";

		// Add the iterator for the last child if requried.
		if ($include_last_iterator)
		{
			$varref .= '[$_' . $blocks[$blockcount] . '_i]';
		}

		return $varref;
	}
	

	// output the template to the cache
	function compile_write(&$handle, $data, $filename)
	{
		if ($fp = @fopen($filename, 'wb'))
		{
			@flock($fp, LOCK_EX);
			@fwrite ($fp, $data);
			@flock($fp, LOCK_UN);
			@fclose($fp);

			@umask(0);
			@chmod($filename, 0644);
		}

		return;
	}
}

?>