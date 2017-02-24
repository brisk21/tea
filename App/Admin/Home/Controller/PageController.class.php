<?php
namespace Home\Controller;
use Think\Controller;
class PageController extends AdminController {
	public function __construct($name){
		$setting = D('tea_settings');//实例化配置表
		$configs = $setting -> showAll();//获取配置的全部数据
		
		
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$list = $name->order('id')->select();
		$this->assign('list',$list);// 赋值数据集
		$count = $name->count();// 查询满足要求的总记录数
		$page = new \Think\Page($count,$configs['admin_count']);// 实例化分页类 传入总记录数和每页显示的记录数		
		$show = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
	}
	
}