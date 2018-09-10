<?php

class BaseView
{
	protected $_path;
	protected $_buffer = array(); //input buffer
	protected $_output = ''; //output buffer
	protected $_tplcache = array(); //templates cache
	protected $_module = ''; // module name, usual for url() function
	protected $_wrapper = array();
	protected static $_lang = '';
	
	/**
	 * Require path to module
	 *
	 * @param string $path
	 */
	public function __construct($path)
	{
		$this->_path = $path;
		$this->_module = strtolower(substr(get_class($this), 0, -4)); // get $this class name and cut 'view'
	}
	
	/**
	 * Provides ability to set tpl variables as $viewobject->variable = 'text';
	 * Is not safe due class member presence
	 *
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value)
	{
		$this->_buffer[$name] = $value;
	}
	
	/**
	 * Provides ability to get templates variables as $viewobject->variable;
	 *
	 * @param string $name
	 */
	public function __get($name)
	{
		return $this->chk($this->_buffer, $name);
	}
	
	public function setLang($lang)
	{
		self::$_lang = preg_replace('/[^a-z0-9]/', '', $lang);
	}
	
	public function getLang()
	{
		return self::$_lang;
	}
	
	/**
	 * String Print - Adds text to output buffer
	 *
	 * @param text $text
	 */
	public function sprint($text)
	{
		$this->_output .= $text;
	}
	
	/**
	 * Allow template to be included to $tpl template from same module to position set by variable $var in $tpl.
	 * It's like $this->render() function but vice versa
	 *
	 * @param string $tpl - template name
	 * @param string $var - variable placeholder name
	 */
	protected function _includeThisToTpl($tpl, $var)
	{
		$this->_wrapper['tpl'] = $tpl;
		$this->_wrapper['var'] = $var;
	}
	
	/**
	 * Returns rendered specified template which must be placed in module_root/tpl/$tpl.tpl.php
	 *
	 * @param string $tpl
	 */
	public function render($tpl)
	{
		$this->_wrapper = array();
		
		foreach ($this->_buffer as $key=>$value) $$key = $value;
		
		ob_start();
		
		if (!isset($this->_tplcache[$tpl])) $this->_tplcache[$tpl] = $this->loadTemplate($tpl);

		eval($this->_tplcache[$tpl]);
		
		$__O_o__ = ob_get_clean();  // get evaled script. Maybe it's not good method but I don't know better and faster :(
		
		foreach ($this->_buffer as $key=>$value) unset($$key);  // clear used variables;
		
		if (!empty($this->_wrapper['tpl']) && !empty($this->_wrapper['var']))	// render wrapper tpl
		{
			$this->__set($this->_wrapper['var'], $__O_o__);
			$__O_o__ = $this->render($this->_wrapper['tpl']);
		}
		
		return $__O_o__;
	}
	
	/**
	 * Adds rendered template to output buffer.
	 * Template must be placed in module_root/tpl/$template_name.tpl.php
	 *
	 * @param string $tpl
	 */
	public function display($tpl)
	{
		$this->sprint($this->render($tpl));
	}
	
	/**
	 * Template loader function - alternative for "include" when use with eval()
	 *
	 * @param string $path - path to template file
	 */
	protected function loadTemplate($tpl)
	{
		$langtpl = '/tpl_'.self::$_lang;
		if (!file_exists(Conf::$document_root.$this->_path.$langtpl.'/'.$tpl.'.tpl.php')) $langtpl = '/tpl';
		$data = file_get_contents(Conf::$document_root.$this->_path.$langtpl.'/'.$tpl.'.tpl.php');
		if (file_exists(Conf::$document_root.$this->_path.'/js/'.$tpl.'.js'))
		{
			$data.= '<script type="text/javascript" src="'.Conf::$site.$this->_path.'/js/'.$tpl.'.js"></script>';
		}
		
		return '?>'.$data;
	}
	
	/**
	 * Returns cached output
	 *
	 * @return text
	 */
	public function output()
	{
		return $this->_output;
	}
	
	/**
	 * Returns buffer data in json
	 *
	 * @return text - json encoded array
	 */
	public function ajaxData()
	{
		return json_encode($this->_buffer);
	}
	
	/**
	 * Returns buffer data as text
	 *
	 * @return text - json encoded array
	 */
	public function rawData()
	{
		return implode('', $this->getBuffer());
	}
	
	/**
	 * Assigns property with name $varname and $value to templates buffer
	 * $model->var notation has such functionality but not safe due class member presence
	 *
	 * @param string $varname
	 * @param mixed $value
	 */
	public function assign($varname, $value)
	{
		$this->_buffer[$varname] = $value;
	}
	
	/**
	 * Replaces internal buffer data with specified array
	 *
	 * @param array $array
	 */
	public function setBuffer(array $array)
	{
		$this->_buffer = $array;
	}
	
	/**
	 * Returns internal buffer data array
	 *
	 * @return array
	 */
	public function getBuffer()
	{
		return $this->_buffer;
	}
	
	/**
	 * Merges internal buffer with specified array
	 *
	 * @param array $array
	 */
	public function addToBuffer(array $array)
	{
		$this->_buffer = $this->_buffer + $array;
	}
	
	/**
	 * Just clears internal buffer
	 *
	 */
	public function clearBuffer()
	{
		$this->_buffer = array();
	}
	
	/**
	 * Recursive htmlspecialchars with ENT_QUOTES
	 *
	 * @param mixed $item
	 * @return mixed
	 */
	public function quotespecialchars($item)
	{
		if (is_array($item))
		{
			foreach ($item as $key=>$val)
			{
				$item[$key] = $this->quotespecialchars($val);
			}
			return $item;
		}
		else return htmlspecialchars($item, ENT_QUOTES);
	}
	
	/**
	 * Checks value in array and compares it to $value or returns $array[$item] if no value specified
	 * (usually it used for inputs/selects/checkboxes)
	 * First parameter can be omited
	 *
	 * @param mixed $array - where search
	 * @param mixed $item - what search
	 * @param mixed $value - with what compare
	 * @param mixed $return - what return if equal
	 *
	 * @return mixed - value or $return or "selected checked" by default
	 */
	protected function chk(&$array, $item = null, $value = null, $return = 'selected checked')
	{
		if (!is_array($array) && isset($array))
		{
			if (isset($item))
			{
				if ($array == $item)
				{
					if (!isset($value)) return $return;
					else return $value;
				}
				else return '';
			}
			return $array;
		}
		else if (is_array($array))
		{
			if (!isset($array[$item])) return '';
			if (isset($value))
			{
				if ($array[$item] == $value) return $return;
			 	else return '';
			}
			else return $array[$item];
		}
		else return '';
	}
	
	/**
	 * Generates url link
	 *
	 * @param string $module
	 * @param string $task
	 * @param mixed $params - array(param1=>value1,param2=>value2 ...) or string param1=value1&param2=value2 ...
	 * @return string
	 */
	public function url($module='', $task='', $params='')
	{
		if ($module == 'content' && isset($params['alias']))
		{
			$add = empty(self::$_lang) ? '' : '/'.self::$_lang;
			if ($task == 'article') return Conf::$site.$add.'/'.$params['alias'].'.html';
			else if ($task == 'category') return Conf::$site.$add.'/'.$params['alias'].'/';
		}
		
		$url = '';
		if (!empty($module)) 
		{
			$url .= $module;
			if (!empty($task)) $url .= '/'.$task;
			if (!empty($params['id'])) {$url .= '/'.$params['id']; unset($params['id']);}
			$url .= '.shtml';
		}
		if (is_array($params)) $url .= '?'.http_build_query($params);
		else if (!empty($params)) $url .= '?'.$params;
		
		if (!empty(self::$_lang)) $url = self::$_lang.'/'.$url;
		
		$url = trim(Conf::$site.'/'.trim($url, '&'), '?');
		
		return $url;
	}

	/**
	 * Returns HTML string with generated <options> items
	 *
	 * @param array $array
	 * @param string $okey - item from $array to set as option value (by default array key)
	 * @param string $ovalue - item from $array to set as option title (by default array value)
	 * @param string $default - what key from array must be selected by default
	 * @param string $attributes - all attributes for options tags
	 * @return string
	 */
	protected function drawOptions(&$array, $okey, $ovalue, $default = null, $attributes = '')
	{
		$s = '';
		
		foreach ($array as $key=>$value)
		{
			if (!is_null($okey)) $key = $value[$okey];
			if (!is_null($ovalue)) $value = $value[$ovalue];
			
			$selected = (!is_null($default)) ? $this->chk($key, $default, 'selected') : '';
			$s .= '<option value="'.$key.'" '.$attributes.' '.$selected.'>'.$value.'</option>';
		}
		
		return $s;
	}
	
	/**
	 * Returns HTML string with generated <select> item
	 *
	 * @param array $array
	 * @param string $key - item from $array to set as option value (by default array key)
	 * @param string $value - item from $array to set as option title (by default array value)
	 * @param string $attr - all attributes for tag
	 * @param bool or string $first_empty - if true adds <option></option> item, if string - adds this string
	 * @param string $default - what key from array must be selected by default
	 * @param string $options_attr - all attributes for options tags
	 * @return string
	 */
	protected function drawSelect(&$array, $key = null, $value = null, $attr = '', $first_empty = false, $default = null, $options_attr = '')
	{
		$s = '<select '.$attr.'>';
		if ($first_empty === true) $s .= '<option> </option>';
		else if ($first_empty !== false) $s .= $first_empty;
		$s .= $this->drawOptions($array, $key, $value, $default, $options_attr);
		$s .= '</select>';
		
		return $s;
	}
	
	/**
	 * Returns HTML string with generated radio buttons set
	 *
	 * @param array $array
	 * @param string $okey - item from $array to set as option value (by default array key)
	 * @param string $ovalue - item from $array to set as option title (by default array value)
	 * @param string $default - what key from array must be selected by default
	 * @param string $attributes - all attributes for options tags
	 * @param string $delimeter - delimiter between radio inputs '<br />' by default
	 * @return string
	 */
	protected function drawRadio(&$array, $okey, $ovalue, $attributes = '', $default = null, $delimiter = '<br />')
	{
		$s = '';
		
		foreach ($array as $key=>$value)
		{
			if (!is_null($okey)) $key = $value[$okey];
			if (!is_null($ovalue)) $value = $value[$ovalue];
			
			$selected = (!is_null($default)) ? $this->chk($key, $default, 'checked') : '';
			$s .= '<label><input type="radio" value="'.$key.'" '.$attributes.' '.$selected.' /> '.$value.'</label>'.$delimiter;
		}
		
		return $s;
	}
	
	/**
	 * Ouputs file for download
	 *
	 * @param string $filename
	 * @param string $content
	 * @param string $type - Content-Type header
	 * @param string $disposition - Content-Disposition header
	 */
	public function echoFile($filename, $content, $type, $disposition = 'attachment')
	{
		header('Content-Type: '.$type);
		header('Content-Length: '.strlen($content));
		header('Content-Disposition: '.$disposition.'; filename="'.$filename.'"');
		
		die($content);
	}
	
	/**
	 * Outputs CSV for Download
	 *
	 * @param string $filename
	 * @param string or array of arrays $content
	 */
	public function echoCSV($filename, $content, $header = array())
	{
		if (is_array($content))
		{
			$buff = array();
			if (!empty($header)) $buff[] = implode(',', $header);
			foreach ($content as $val) $buff[] = implode(',', $val);
			$content = implode("\n",$buff);
		}
		
		$this->echoFile($filename, $content, 'text/csv');
	}
}