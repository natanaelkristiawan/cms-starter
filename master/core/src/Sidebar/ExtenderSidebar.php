<?php

namespace Master\Core\Sidebar;

use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Sidebar;
use Maatwebsite\Sidebar\SidebarExtender;


class ExtenderSidebar implements SidebarExtender 
{
	public function extendWith(Menu $menu)
	{
		$menu->group('Main Navigator', function(Group $group) {
			$group->item('Dashboard', function(Item $item){
				$item->url(route('admin.dashboard'));
				$item->icon('fa fa-dashboard');
			});
		});
		return $menu;
	}
}