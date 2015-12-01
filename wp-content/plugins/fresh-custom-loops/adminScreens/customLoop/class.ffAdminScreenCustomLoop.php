<?php

class ffAdminScreenCustomLoop extends ffAdminScreen implements ffIAdminScreen {
	public function getMenu() {
		$menu = $this->_getMenuObject();
		$menu->pageTitle = 'Custom Loops';
		$menu->menuTitle = 'Custom Loops';
		$menu->type = ffMenu::TYPE_SUB_LEVEL;
		$menu->capability = 'manage_options';
		$menu->parentSlug='themes.php';
		return $menu;
	}
}
