<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{

	

	public function login(){

		

	    $this->display();

	}

	public function loginok(){

		$this->success('',U('Index/index'),1);
	}

	public function vertify(){

		$config =    array(
		    'fontSize'    =>    14,    // 验证码字体大小
		    'length'      =>    5,     // 验证码位数
		    'useNoise'    =>    false,
		    'imageW'=>120,
		    'imageH'=>36 // 关闭验证码杂点
		);
	    $Verify = new \Think\Verify($config);
	    $Verify->entry();
	}
    
    public function dologin(){

    	
    	$vertify=I('post.vertify');
    	$user=M('user');
    	if(!empty($vertify)){
    		$Verif = new \Think\Verify();
    		if($Verif->check($vertify)){

    			$username=I('post.username');
    			$pass=I('post.pass');
    			if($username==''||$pass==''){
    				$data="203";
    				$this->ajaxReturn($data,'json');

    			}else{
    				$user=M('user');
    				$pass=md5($pass);
    				$result=$user->field('username')->where(" username='%s' and password='%s'",array($username,$pass))->select();
    				if($result){
    					$data="250";
    					session('lqb_user',$result);
    		            $this->ajaxReturn($data,'json');
    				}else{
    					$data="203";
    					$this->ajaxReturn($data,'json');
    				}
    			}
    		}else{
    			$data="202";
    		    $this->ajaxReturn($data,'json');
    		}


    	}else{
    		$data="202";
    		$this->ajaxReturn($data,'json');
    	}
    }
	

	public function checkout(){

		session('lqb_user',null);
		
		$this->success('欢迎下次再来,我的主人',U('Login/login'),'1');
              

	}


}

?>