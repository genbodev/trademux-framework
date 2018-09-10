<?php

class SitemapView extends BaseView
{
	/**
	 * Draw menu with submenus
	 *
	 * @param array $data - categories array grouped(not sql group) by parent_id
	 * @param int $parent_id - id to start from, default 0, usually use in recurring call
	 * @param int $depth - var for recurring call and is initial menu level in class menulvl[x]
	 * @return string
	 */
	public function drawSitemap($data, $parent_id = 0, $depth = 0)
	{
		$list = '';
		
		if (isset($data[$parent_id]) && is_array($data[$parent_id])) 
		{
			foreach ($data[$parent_id] as $item)
			{
				if (in_array($item['type'], array('article','category')))
				{
					$a = json_decode($item['link'], true);
					$item['link'] = $this->url($a['m'], $a['t'], $a['p']);
				}
				$list .= '<li><a href="'.$item['link'].'">'.$item['title'].'</a></li>';
				$list .= $this->drawSitemap($data, $item['id'], $depth+1);
			}
		}
		
		return (empty($list)) ? '' : '<ul class="menu menulvl'.$depth.'">'.$list.'</ul>'."\n";
	}
}