<?php

class BaseAccessManagerView extends BaseView
{
	protected $type;
	protected $fields = array('module'=>'Module', 'r'=>'Read', 'w'=>'Write', 'a'=>'Advanced');
	
	/**
	 * Generates table of users/roles
	 *
	 * @param array $list
	 */
	public function generateTable($list)
	{
		$this->list = $list;
		$this->listtable = $this->render($this->type.'table');
		$this->display('list');
	}
	
	/**
	 * Returns role/user description part of form, must be overloaded
	 *
	 * @param array $desc
	 * @return text
	 */
	protected function descPartForm($desc)
	{
		return '';
	}
	
	/**
	 * Generate html form for edit role/user description and rights
	 *
	 * @param array $desc
	 * @param array $access
	 */
	public function generateForm($desc, $access)
	{
		$this->id = $desc['id'];
		$this->typeurl = $this->type;
		$this->desc = $this->descPartForm($desc);
		
		$head = '';
		foreach ($this->fields as $f) $head.= '<th>'.$f.'</th>'; // generate table head
		$this->head = $head;
		
		$s = '<tr><td></td>';
        for ($i=1; $i<count($this->fields); $i++) $s.='<td><input type="checkbox" class="selectall"></td>';
        $s .= '</tr>';
		foreach ($access as $m)  // $m - module access array
		{
			$s.= '<tr>';
			foreach ($this->fields as $k=>$f) // generate row
			{
				$s.= '<td>';
				if ($k == 'module') 
				{
					$s.= $m[$k];
					if (empty($m['access_id'])) $s.= '<input type="hidden" name="data[accessadd]['.$m['module_id'].']"/>';
					else $s.= '<input type="hidden" name="data[accessupd]['.$m['module_id'].']"/>'; // 'initialize'
				}
				else
				{
					if (empty($m['access_id'])) $name = 'data[accessadd]['.$m['module_id'].']['.$k.']';
					else $name = 'data[accessupd]['.$m['module_id'].']['.$k.']'; // data[access][module][field]
					
					$s.= '<input type="checkbox" value="1" name="'.$name.'" '.$this->chk($m, $k, 1).' />';
				} 
				$s.= '</td>';
			}
			$s.= '</tr>';
		}
		
		$this->permissionstable = $s;
		
		$form = $this->display('editform');
	}
}
