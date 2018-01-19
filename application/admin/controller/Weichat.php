<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\base\Base;

class Weichat extends Base{
    public function show(){
    	$data=db('perform_shower')->alias('a')->join('perform b','a.show_id=b.show_id')->join('shower c','a.shower_id=c.shower_id')->field('a.id,b.show_id,c.shower_id,b.show_describe,a.show_id,b.show_title,b.show_time,b.show_img_path,group_concat(c.shower_name) as shower_name')->group('a.show_id,b.show_title,b.show_time,b.show_img_path')->select();

    	$this->assign('data',$data); 
        return $this->fetch();
    }

    public function show_add(){
        $data=db('shower')->select();

        $this->assign('data',$data);
        return $this->fetch();
    }

    public function show_add_data(){
        $dir = ".\public\static\lib\webuploader\\0.1.5\server\upload";
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                $time_str=time().mt_rand();
                $img_path='';
                $a='100';
                mkdir('.\public\static\upload\\'.$time_str.'\\',0777);
                while (($file = readdir($dh))!= false){
                    $filePath = $dir."\\".$file;

                    if($filePath == '.\public\static\lib\webuploader\\0.1.5\server\upload\.' or $filePath == '.\public\static\lib\webuploader\\0.1.5\server\upload\..'){
                                continue;
                    }
                    $str=substr(strrchr($file,'.'), 1);
                    $file=time().$a.mt_rand().'.'.$str;
                    rename($filePath,'.\public\static\upload\\'.$time_str.'\\'.$file);
                    $img_path=$img_path.'\public\static\upload\\'.$time_str.'\\'.$file.'|';
                    $a++;
                }
                closedir($dh);
            }
        }

        $re=['show_title'=>input('show_title'),'show_time'=>input('show_time'),'show_describe'=>input('show_describe'),'show_img_path'=>$img_path];
        $preform=db('perform')->insert($re);
        $show_id=db('perform')->getLastInsID();

        $str=input('shower_name');
        $str=str_replace('选择演员','',$str);
        $str=trim($str);
        $arr=explode('.',$str);
        $arr=array_filter($arr);

        foreach($arr as $v){
            $re=['shower_name'=>$v];
            $shower_id=db('shower')->where($re)->value('shower_id');

            $re=['show_id'=>$show_id,'shower_id'=>$shower_id];
            $perform_shower=db('perform_shower')->insert($re);
        }

        return 1;
    }

    public function show_del_data(){
        $re=['show_id'=>input('show_id')];
        $show_img_path=db('perform')->where($re)->value('show_img_path');
        $arr=explode('|',$show_img_path);
        $arr2=explode('\\',$arr[0]);

        $dir = ".\public\static\upload\\".$arr2[4];
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($file = readdir($dh))!= false){
                    $filePath = $dir."\\".$file;

                    if($filePath == $dir.'\.' or $filePath == $dir.'\..'){
                                continue;
                    }
                    unlink($filePath);
                }
                rmdir($dir);
                closedir($dh);
            }
        }

        $preform=db('perform_shower')->where($re)->delete();

        $preform=db('perform')->delete($re);

        return 1;
    }

    public function shower(){
    	$m=db('shower');
    	$data=$m->alias('a')->join('img b','a.shower_id=b.shower_id')->select();

    	$this->assign('data',$data);
        return $this->fetch();
    }

    public function shower_add(){
        return $this->fetch();
    }

    public function shower_add_data(){
        $dir = ".\public\static\lib\webuploader\\0.1.5\server\upload";
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                $time_str=time().mt_rand();
                $img_path='';
                $a='100';
                mkdir('.\public\static\upload\\'.$time_str.'\\',0777);
                while (($file = readdir($dh))!= false){
                    $filePath = $dir."\\".$file;

                    if($filePath == '.\public\static\lib\webuploader\\0.1.5\server\upload\.' or $filePath == '.\public\static\lib\webuploader\\0.1.5\server\upload\..'){
                                continue;
                    }
                    $str=substr(strrchr($file,'.'), 1);
                    $file=time().$a.mt_rand().'.'.$str;
                    rename($filePath,'.\public\static\upload\\'.$time_str.'\\'.$file);
                    $img_path=$img_path.'\public\static\upload\\'.$time_str.'\\'.$file.'|';
                    $a++;
                }
                closedir($dh);
            }
        }

        $re=['shower_name'=>input('shower_name'),'shower_sex'=>input('shower_sex'),'shower_sign'=>input('shower_sign'),'shower_birthday'=>input('shower_birthday'),'shower_birthcity'=>input('shower_birthcity'),'shower_describe'=>input('shower_describe')];
        $shower=db('shower')->insert($re);
        $shower_id=db('shower')->getLastInsID();

        $re=['img_path'=>$img_path,'shower_id'=>$shower_id];
        $shower=db('img')->insert($re);

        return 1;
    }

    public function shower_del_data(){
        $re=['shower_id'=>input('shower_id')];
        $shower_id=db('perform_shower')->where($re)->value('shower_id');
        if($shower_id !== NULL){
            return 0;
        }
        $img_path=db('img')->where($re)->value('img_path');
        $arr=explode('|',$img_path);
        $arr2=explode('\\',$arr[0]);

        $dir = ".\public\static\upload\\".$arr2[4];
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($file = readdir($dh))!= false){
                    $filePath = $dir."\\".$file;

                    if($filePath == $dir.'\.' or $filePath == $dir.'\..'){
                                continue;
                    }
                    unlink($filePath);
                }
                rmdir($dir);
                closedir($dh);
            }
        }

        $img=db('img')->where($re)->delete();
        $shower=db('shower')->delete($re);

        return 1;
    }

    public function user(){
        $data=db('user')->select();

        $this->assign('data',$data);
        return $this->fetch();
    }

    public function user_del_data(){
        $re=['user_id'=>input('user_id')];
        $user_img_path=db('user')->where($re)->value('user_img_path');
        $arr=explode('|',$user_img_path);
        $arr2=explode('\\',$arr[0]);

        $dir = ".\public\static\upload\\".$arr2[4];
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($file = readdir($dh))!= false){
                    $filePath = $dir."\\".$file;

                    if($filePath == $dir.'\.' or $filePath == $dir.'\..'){
                                continue;
                    }
                    unlink($filePath);
                }
                rmdir($dir);
                closedir($dh);
            }
        }

        $user=db('user')->delete($re);

        return 1;
    }

    public function user_say(){
        $sql="select a.say_id,a.show_id,a.say_content,a.say_time,b.*,c.show_title from user_say a,user b,perform c where a.user_id = b.user_id and c.show_id = a.show_id";
        $data=db()->query($sql);

    	$this->assign('data',$data);
        return $this->fetch();
    }

    public function user_say_add(){
        $data=db('perform')->select();

        $this->assign('data',$data);
        return $this->fetch();
    }

    public function user_say_add_data(){
        $dir = ".\public\static\lib\webuploader\\0.1.5\server\upload";
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                $time_str=time().mt_rand();
                $img_path='';
                $a='100';
                mkdir('.\public\static\upload\\'.$time_str.'\\',0777);
                while (($file = readdir($dh))!= false){
                    $filePath = $dir."\\".$file;

                    if($filePath == '.\public\static\lib\webuploader\\0.1.5\server\upload\.' or $filePath == '.\public\static\lib\webuploader\\0.1.5\server\upload\..'){
                                continue;
                    }
                    $str=substr(strrchr($file,'.'), 1);
                    $file=time().$a.mt_rand().'.'.$str;
                    rename($filePath,'.\public\static\upload\\'.$time_str.'\\'.$file);
                    $img_path=$img_path.'\public\static\upload\\'.$time_str.'\\'.$file.'|';
                    $a++;
                }
                closedir($dh);
            }
        }

        $re=['user_name'=>input('user_name'),'user_img_path'=>$img_path];
        $user=db('user')->insert($re);
        $user_id=db('user')->getLastInsID();

        $show_id=db('perform')->where(['show_title'=>input('show_title')])->value('show_id');

        $re=['user_id'=>$user_id,'say_content'=>input('say_content'),'show_id'=>$show_id,'say_time'=>input('say_time')];
        $user_say=db('user_say')->insert($re);

        return 1;
    }

    public function user_say_del_data(){
        $re=['say_id'=>input('say_id')];
        $user_say=db('user_say')->delete($re);

        return 1;
    }

    public function transaction(){
    	$m=db('transaction');
    	$data=$m->alias('a')->join('perform b','a.show_id=b.show_id')->select();

    	$this->assign('data',$data);
        return $this->fetch();
    }

    public function transaction_del_data(){
        $re=['order_number'=>input('order_number')];
        $data=db('transaction')->where($re)->delete();

        return 1;
    }
}
