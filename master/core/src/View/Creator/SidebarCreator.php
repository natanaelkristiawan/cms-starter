<?php
namespace Master\Core\View\Creator;
use Master\Core\Sidebar\ConfigSidebar;
use Maatwebsite\Sidebar\Presentation\SidebarRenderer;
class SidebarCreator
{
	protected $sidebar;
	protected $renderer;

	public function __construct(ConfigSidebar $sidebar, SidebarRenderer $renderer)
	{
    $this->sidebar  = $sidebar;
    $this->renderer = $renderer;
	}

	public function create($view)
	{
    $view->sidebar = $this->renderer->render(
    	$this->sidebar
		);
	}
}