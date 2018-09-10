<?php

/**
 * Extended access class for roles
 *
 */
class RoleAccessManagerModel extends BaseAccessManagerModel 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->t_type = '#_roles';
		$this->t_access = '#_roleaccess';
		$this->k_name = 'role';
		$this->fk_id = 'role_id';
	}
}

