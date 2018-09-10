<?php
/**
 * Users view
 *
 */
class UserAccessManagerView extends BaseAccessManagerView
{
	protected $type = 'users';
	
	/**
	 * Returns user description part of form
	 *
	 * @param array $desc
	 * @return text
	 */
	protected function descPartForm($desc)
	{
		$this->addToBuffer($desc); //all fileds to view
		$this->roleselect = $this->drawSelect($desc['roles'], 'id', 'role', 'name="data[desc][role_id]"', false, $desc['role_id']);

		return $this->render('userdesc');
	}
}