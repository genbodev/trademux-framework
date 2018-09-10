<?php
/**
 * Class for image manipulation
 *
 */
class Image
{
	protected $types = array(IMAGETYPE_GIF=>'gif', IMAGETYPE_JPEG=>'jpeg', IMAGETYPE_PNG=>'png');
	protected $width = 0;
	protected $height = 0;
	protected $type;
	protected $image;
	protected $file;
	
	public function __set($name, $val) {}
	
	public function __get($name)
	{
		return isset($this->$name) ? $this->$name : '';
	}
	
	public function __construct($file = '')
	{
		if (!empty($file)) $this->load($file);
	}
	
	public function load($file)
	{
		list($width, $height, $type) = getimagesize($file);
		if (empty($width) || empty($height) || empty($type)) return false;
		$this->width = $width;
		$this->height = $height;
		$this->type = $this->types[$type];
		$call = 'from'.$this->type;
		$this->image = $this->$call($file);
		$this->file = $file;
	}
	
	/**
	 * Outputs image to file
	 *
	 * @param string $type can be 'gif' or 'jpeg' or 'png'. By default source type
	 */
	public function write($file = '', $type = '')
	{
		if (empty($file)) $file = $this->file;
		if (empty($type)) $type = $this->type;
		$call = 'to'.$type;
		$this->$call($file);
	}
	
	public function tojpeg($file)
	{
		imagejpeg($this->image, $file);
	}
	
	public function togif($file)
	{
		imagegif($this->image, $file);
	}
	
	public function topng($file)
	{
		imagepng($this->image, $file);
	}

	protected function fromjpeg($file)
	{
		return imagecreatefromjpeg($file);
	}
	
	protected function fromgif($file)
	{
		return imagecreatefromgif($file);
	}
	
	protected function frompng($file)
	{
		return imagecreatefrompng($file);
	}
	
	public function fitWidth($max_width = 350)
	{
		$new_width = ($this->width > $max_width) ? $max_width : $this->width;
		$new_height = ($this->width > $max_width) ? round($new_width/$this->width*$this->height) : $this->height;
		$this->setSize($new_width, $new_height);
	}
	
	public function fitHeight($max_height = 350)
	{
		$new_height = ($this->height > $max_height) ? $max_height : $this->height;
		$new_width = ($this->height > $max_height) ? round($new_height/$this->height*$this->width) : $this->width;
		$this->setSize($new_width, $new_height);		
	}
	
	public function setSize($new_width, $new_height)
	{
		if ($new_height != $this->height || $new_width != $this->width)
		{
			$newim = imagecreatetruecolor($new_width, $new_height);
			imagecopyresampled($newim, $this->image, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
			$this->image = $newim;
		}
	}
}