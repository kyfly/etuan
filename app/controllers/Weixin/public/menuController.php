<?php
class menuController extends BaseController
{
	private $menu;
	public function __construct(menuService $menu){
		$this->meanu = $menu;
	}
	public function postCreate(){
		$json = file_get_contents('php://input');
		$arr = json_decode($json,true);
		$result = $this->menu->create($arr);
	}
}