<?php

/**
 * Roles view
 *
 */
class RoleAccessManagerView extends BaseAccessManagerView
{
	protected $type = 'roles';
	
	/**
	 * Returns role description part of form
	 *
	 * @param array $desc
	 * @return text
	 */
	protected function descPartForm($desc)
	{
		$this->title = $desc['title'];
		return $this->render('roledesc');
	}
}
