<?php
namespace app\admin\controller;
use think\Controller;

class Login extends Controller{
    public function login(){
        return $this->fetch();
    }

    public function login_data(){
    	$re=['name'=>input('name'),'password'=>md5(input('password'))];
    	$admin_id=db('admin')->where($re)->value('admin_id');

    	if($admin_id == NULL){
    		return 0;
    	}else{
            session('name',input('name'));
    		return 1;
    	}
    }

    public function quit(){
        session_start();
        session_unset();
        session_destroy();
        //return $this->redirect('index/login/index');
        return $this->redirect('admin/login/login');
    }
}
