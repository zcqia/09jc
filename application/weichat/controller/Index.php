<?php
namespace app\weichat\controller;
use think\Controller;
use app\weichat\controller\Common;

class Index extends Common{
    public function index(){
    	$data=db('perform_shower')->alias('a')->join('perform b','a.show_id=b.show_id')->join('shower c','a.shower_id=c.shower_id')->field('a.show_id,b.show_title,b.show_time,b.show_img_path,group_concat(c.shower_name) as shower_name')->group('a.show_id,b.show_title,b.show_time,b.show_img_path')->select();

    	$this->assign('data',$data);
        return $this->fetch();
    }

    public function shop_cart(){
    	$show_id=intval(input('show_id'));
    	$shower_name=input('shower_name');
    	$data=['show_id'=>$show_id,'shower_name'=>$shower_name,'add_time'=>date('Y-m-d H:i:s',time())];
    	$res=db('shop_cart')->insert($data);
        return $this->redirect('weichat/index/shop_cart_my');
    }

    public function shop_cart_my(){
        $data=db('shop_cart')->alias('a')->join('perform b','a.show_id=b.show_id')->field('b.show_title,b.show_time,b.show_img_path,a.shower_name,a.show_id')->group('a.show_id,b.show_title,b.show_time,b.show_img_path')->order('a.add_time desc')->select();

        $count=db('shop_cart')->alias('a')->join('perform b','a.show_id=b.show_id')->group('b.show_title,b.show_time')->field('count(*) as num')->order('a.add_time desc')->select();

    	$this->assign('data',$data);
    	$this->assign('count',$count);
        return $this->fetch('shop_cart');
    }

    public function shop_cart_del(){
    	$show_id=input('show_id');
    	$data=['show_id'=>$show_id];
    	$res=db('shop_cart')->where($data)->delete();

    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    public function shop_cart_min(){
    	$show_id=input('show_id');

    	$sql="select min(id) as id from shop_cart where show_id='".$show_id."' group by show_id order by id";
    	$id=db()->query($sql);

    	$sql="delete from shop_cart where id=".$id[0]['id'];
    	$res=db()->execute($sql);

    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    public function shop_cart_max(){
    	$show_id=input('show_id');

    	$shower_name=input('shower_name');
    	$data=['show_id'=>$show_id,'shower_name'=>$shower_name,'add_time'=>date('Y-m-d H:i:s',time())];
    	$res=db('shop_cart')->insert($data);

    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    public function buytail(){
    	$show_id=intval(input('show_id'));
    	$shower_name=input('shower_name');

    	$data=db('perform_shower')->alias('a')->join('perform b','a.show_id=b.show_id')->field('b.show_title,b.show_time,b.show_img_path,b.show_describe,a.show_id')->group('a.show_id,b.show_title,b.show_time,b.show_img_path,b.show_describe')->where(['a.show_id'=>$show_id])->select();
        $shower=db('shower')->alias('a')->join('perform_shower b','a.shower_id=b.shower_id')->join('img c','a.shower_id=c.shower_id')->field('a.shower_name,c.img_path')->where(['b.show_id'=>$show_id])->select();
        $user=db('user')->alias('a')->join('user_say b','a.user_id=b.user_id')->field('a.user_name,a.user_img_path,b.say_content,b.say_time')->where(['b.show_id'=>$show_id])->select();

    	$this->assign('data',$data);
    	$this->assign('shower_name',$shower_name);
        $this->assign('shower',$shower);
        $this->assign('user',$user);
        return $this->fetch();
    }

    public function transaction(){
    	$data=db('shop_cart')->select();

    	foreach($data as $v){
    		$number=rand(11,99).rand(1001,9999);

    		$re=['order_number'=>$number,'show_id'=>$v['show_id'],'shower_name'=>$v['shower_name'],'order_time'=>date('Y-m-d H:i:s',time())];
    		$res=db('transaction')->insert($re);
    	}

    	$re=db('shop_cart')->where('1=1')->delete();

    	$data=db('transaction')->alias('a')->join('perform b','a.show_id=b.show_id')->field('b.show_title,b.show_time,b.show_img_path,a.show_id,a.shower_name,a.order_number,a.order_time')->order('order_time desc')->select();

    	$this->assign('data',$data);
    	return $this->fetch();
    }

    public function transaction_del(){
        $order_number=input('order_number');

        $sql="delete from transaction where order_number=".$order_number;
        $res=db()->execute($sql);

        if($res){
            return 1;
        }else{
            return 0;
        }
    }
}
