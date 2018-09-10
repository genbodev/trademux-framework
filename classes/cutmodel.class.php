<?php

class CutModel extends BaseModel
{
	protected function _cut($str, $cutlength)
	{
		$str = strip_tags($str);
		if (strlen($str) > $cutlength)
		{  
			$str = substr($str, 0, $cutlength);
			$pos = strrpos($str, " ");  
			if($pos) $str = substr($str, 0, $pos);
			$str .= '...';
		}
		
		return $str;
	}
}