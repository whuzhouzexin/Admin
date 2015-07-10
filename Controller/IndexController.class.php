<?php
namespace Admin\Controller;

class IndexController extends BaseController {

    
        public function index(){

        	$this->display();
        }

        public function add(){

        	$this->display();

        }

        public function content(){

        	$m=M('essays');
        	$result=$m->select();
        	$this->assign('essays',$result);

        	$this->display();
        }

        public function update(){

        	$id=I('get.id');
        	if(!empty($id)){

               $m=M('essays');
               $result=$m->where('id='.$id)->find();
               $this->assign('essays',$result);
        	}else{

        		return false;
        	}

        	$this->display();

        }

        public function user(){
        	$m=M('user');
        	$result=$m->select();
        	$this->assign('users',$result);
        	$this->display();
        }

        public function editor(){
                if(session('authuser')){
                   
                   return false;

                }
                $editor=new \Org\Util\Ueditor();
                echo $editor->output();
        }


        public function dealadd(){

            $data['title']=I('post.title');
            $data['show']=I('post.show');
            $data['intro']=I('post.intro');
            $data['content']=I('post.content');
            $data['author']=I('post.username');
            $data['origin']=I('post.from');
            if($data['title']==''||$data['show']==''||$data['intro']==''|| $data['content']==''|| $data['author']==''||$data['origin']==''){
                $this->error('所填内容存在空值',U('Index/add'),1);
            }else{
                $m=M('essays');
                if($m->create()){
                    $m->add($data);
                     $this->success('添加成功',U('Index/add'),1);
                }else{
                    $this->error('非法操作',U('Index/add'),1);
                }
            }
        }

        public function dealupdate(){

            $data['title']=I('post.title');
            $data['show']=I('post.show');
            $data['intro']=I('post.intro');
            $data['content']=I('post.content');
            $data['author']=I('post.username');
            $data['origin']=I('post.from');
            $id=I('post.id');
            if($data['title']==''||$data['show']==''||$data['intro']==''|| $data['content']==''|| $data['author']==''||$data['origin']==''|| $id==''){
                $this->error('所填内容存在空值',U('Index/add'),1);
            }else{
                $m=M('essays');
                if($m->create()){
                    $m->where('id='.$id)->save($data);
                     $this->success('更新成功',U('Index/add'),1);
                }else{
                    $this->error('更新失败',U('Index/add'),1);
                }
            }


        }



}