<?php

class MenuManagerView extends BaseView
{
	public function drawArticlesSelect($data)
	{
		$default = '<option value=""> </option>';
		$this->sprint($default);
		$this->sprint($this->drawOptions($data, 'alias', 'title'));
	}
}