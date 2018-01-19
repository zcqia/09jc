<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\base\Base;

class Index extends Base{
    public function index(){
        return $this->fetch();
    }
}
