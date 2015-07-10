<?php
namespace Admin\Controller;
use \Think\Controller;
class BaseController extends Controller{

  
         private $sesion='';
	public function _initialize(){

         $this->sesion=session('lqb_user');
       
        
          if(!($this->sesion)){
            
             	 $this->error('非法访问',U('Login/login'),100);

          }





          }

	

}
?>