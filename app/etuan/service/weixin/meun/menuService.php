<?php
class menuService
{
	public function create($arr){
		$arr = [['type'=>'view','key'=>'menu','event'=>'www.cccc.vv'],
		['type'=>'view','key'=>'menu','event'=>'www.cccc.vv']];
		$result = menuHandle::create($arr);
		return $result;
	}
}