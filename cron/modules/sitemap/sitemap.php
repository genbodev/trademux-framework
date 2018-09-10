<?php
class Sitemap extends CronController
{
	public function index()
	{
		$map = new GoogleSiteMap(Conf::$document_root, 'sitemap.xml', Conf::$site);

		$cats = $this->m->getCategories();
		$articles = $this->m->getArticles();
		
		$map->addURL('', '', 'daily', 1);
		
		foreach ($cats as $i)
		{
			$map->addURL($this->_url('content', 'category', array('alias'=>$i['alias'])), '', 'daily', 0.8);
		}
		foreach ($articles as $i)
		{
			$map->addURL($this->_url('content', 'article', array('alias'=>$i['alias'])), $i['modify_date'], 'monthly', 0.6);
		}
		
		$map->generateAndSubmit();
	}
}