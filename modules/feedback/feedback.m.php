<?php

class FeedbackModel extends FormsModel 
{
	protected $table = '#_feedback';
	

	public function saveItem($data)
	{
		$fields = array('type'=>new dbString(trim($data['type'])), 'user_id'=>new dbInt($data['user_id']),
					 	'name'=>new dbString(trim($data['name'])), 'email'=>new dbString(trim($data['email'])),
					  	'skype'=>new dbString(trim($data['skype'])), 'comment'=>new dbString(trim($data['comment'])));
		$this->saveItemData(-1, $fields);
	}
	
	public function getUserData($id)
	{
		$id = new dbInt($id);
		$data = $this->_db->loadRow("SELECT * FROM users WHERE id=$id");
		$data['name'] = $data['name'].' '.$data['lastname'];
		return $data;
	}
}	
