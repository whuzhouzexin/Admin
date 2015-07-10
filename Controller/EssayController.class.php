<?php
namespace Admin\Controller;
use  \Think\Controller;

/**
* 
*/
class EssayController extends Controller
{
	
	public function index(){

		$essay=M('essays');
		$result=$essay->select();
		$this->assign('essays',$result);
		$this->display();

	}

	public function getessay(){


		$id=I('get.id');
		if(!empty($id)){
			$essay=M('essays');
			$result=$essay->where('id='.$id)->select();
			$this->assign('essays',$result);
			$this->display();
		}else{
			$this->ajaxReturn('','json');
		}

          

	}

	public function search(){


		$id=I('get.content');
        $data['title'] = array('like',"%$id%");
		if(!empty($id)){
			$essay=M('essays');
			$result=$essay->field('title,id')->where($data)->select();
			$this->ajaxReturn($result,'json');
		}else{
			$this->ajaxReturn('','json');
		}

	}


	public function onlysearch(){
        
		$this->display();

	}
}
?>