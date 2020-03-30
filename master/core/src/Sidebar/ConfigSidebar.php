<?php

namespace Master\Core\Sidebar;

use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Sidebar;

class ConfigSidebar implements Sidebar
{
	protected $menu;

	public function __construct(Menu $menu)
	{
		$this->menu = $menu;
	}

	public function build()
	{
		$this->menu->group('Main Navigator');
		$this->extendMenu();
	}

	protected function extendMenu(){

		foreach (config('master.menuExtends') as $value) {
			$string = $value;
			$extender = new $string(); 
			$this->menu->add(
				$extender->extendWith($this->menu)
			);
		}
	}

	public function getMenu()
	{
		return $this->menu;
	}
}