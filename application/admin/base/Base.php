<?php
namespace app\admin\base;
use think\Controller;

class Base extends Controller{
	//初始化
	public function _initialize(){
		session_start();

    	if(!empty($_SESSION['think']['name'])){
			return;
		}else{
			return $this->redirect('admin/login/login');
		}
	}       
}