<?php

class FeedbackManagerModel extends FormsModel 
{
	protected $table = '#_feedback';
	
	public function getRequests()
	{
		return $this->_db->loadAssoc("SELECT a.*, DATE_FORMAT(a.create_date, '%d.%m%.%Y %H:%i:%s') as created FROM $this->table a ORDER BY a.create_date DESC");
	}
}	
