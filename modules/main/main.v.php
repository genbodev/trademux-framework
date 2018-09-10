<?php

class MainView extends BaseView
{
	public function drawBreadcrumbs(&$data)
	{
		$url = trim(Conf::$site.$_SERVER['REQUEST_URI'], '/?');
		$current = array();
		
		//find current link in menu
		foreach ($data as $item)
		{
			if (in_array($item['type'], array('article','category')))
			{
				$a = json_decode($item['link'], true);
				$item['link'] = $this->url($a['m'], $a['t'], $a['p']);
			}
			if ($url == trim($item['link'], '/?')) $current = $item; // find last matching
		}
		
		if (empty($current)) return array('left_id'=>-1, 'top_id'=>-1, 'title'=>'', 'crumbs'=>'');
		
		$leftmenu_id = $current['id'];
		$crumbs = array($current['title']);
		
		while ($current['parent_id'] > 1) 
		{
			$current = $data[$current['parent_id']];
			$crumbs[] = $current['title'];
		}
		
		$crumbs = array_reverse($crumbs);
		
		return array('left_id'=>$leftmenu_id, 'top_id'=>$current['id'], 'title'=>$crumbs[0], 'crumbs'=>$crumbs);
	}
	
	/**
	 * Draw menu
	 *
	 * @param array $data - menu array
	 * @return array
	 */
	public function drawTopMenu($data, $selected)
	{
		$url = trim(Conf::$site.$_SERVER['REQUEST_URI'], '/?');
		$active = ($url == Conf::$site) ? ' class="active"' : '';
		$list = '<li'.$active.'><a href="'.Conf::$site.'/"><img src="'.Conf::$site.'/images/home.png" alt="" /> Home</a></li>';
		
		foreach ($data as $item)
		{
			if (in_array($item['type'], array('article','category')))
			{
				$a = json_decode($item['link'], true);
				$item['link'] = $this->url($a['m'], $a['t'], $a['p']);
			}
			$active = ($item['id'] == $selected) ? $active = ' class="active"' : '';
			$href = ($item['type']=='none') ? '' : 'href="'.$item['link'].'"';
			$list .= '<li class="brd"></li>';
			$list .= '<li'.$active.'><a '.$href.'>'.$item['title'].'</a></li>';
		}
		
		return '<ul class="menulvl0">'.$list.'</ul>'."\n";
	}
	
	/**
	 * Draw menu with submenus
	 *
	 * @param array $data - categories array grouped(not sql group) by parent_id
	 * @param int $parent_id - id to start from, default 0, usually use in recurring call
	 * @param int $depth - var for recurring call and is initial menu level in class menulvl[x]
	 * @return string
	 */
	public function drawLeftMenu($data, $parent_id = 0, $selected = 0, $depth = 0)
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
				$sub = $this->drawLeftMenu($data, $item['id'], $selected, $depth+1);
				$active = ($item['id'] == $selected) ? ' root active' : '';
				$liclass = $depth == 0 ? 'class="root'.$active.'"' : '';
				$aclass = 'class="item"';
				$href = ($item['type'] == 'none') ? '' : ' href="'.$item['link'].'"';
				$list .= '<li '.$liclass.'><a '.$aclass.$href.'><span>'.$item['title'].'</span></a>';

				$list .= $sub.'</li>';
			}
		}
		
		if (empty($list)) return '';
		else if ($depth == 0) 
		{
			$active = ($selected == -1) ? ' class="root active"' : 'class="root"';
			$list = '<li '.$active.'><a href="'.Conf::$site.'/'.$this->getLang().'" class="item"><span>'.($this->getLang() == 'ru' ? 'Главная' : 'Home').'</span></a></li>'.$list;
			return '<ul class="menutop level'.$depth.'">'.$list.'</ul>'."\n";
		}
		else return '<div class="fusion-submenu-wrapper level'.$depth.'" >
						<ul class="level'.$depth.'">'.$list.'</ul>
					</div>';
	}
	
	/**
	 * Draws previews footer menu
	 *
	 * @param array $data - categories array grouped(not sql group) by parent_id
	 * @return string
	 */
	public function drawPreviews($data)
	{
		$s = '<div id="previewsline">';
		foreach ($data as $item)
		{
			if (in_array($item['type'], array('article','category')))
			{
				$a = json_decode($item['link'], true);
				$item['link'] = $this->url($a['m'], $a['t'], $a['p']);
			}
			$s .= '<div class="preview">';
			$s .= '<a href="'.$item['link'].'"><h3>'.$item['title'].'</h3></a>'.$item['preview'];
			$s .= '</div>';
		}
		$s .= '<div style="clear:both;"></div></div>';
		
		return $s;
	}
}