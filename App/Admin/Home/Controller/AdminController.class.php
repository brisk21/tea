<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller{
	function __construct(){
		parent::__construct();				
		//判读session中aid是否存在
		$this ->aid = cookie('aid');
		$this -> user = D('tea_user') -> where(array('aid' => $this ->aid)) -> find();
		if($this ->aid < 1 || !$this ->user){
	  		redirect('/Admin.php/Home/Login/index');
	    }		
	}
}


