<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function __construct(){
		parent::__construct();	
        $this -> uid = session('uid');	
		$this -> setting = D('tea_settings');
		$this -> config = $this -> setting -> showAll();       
	}
    public function index(){
		$list = D('tea_list');			
		$configs = $this ->config;
        $count = $list->count();// 查询满足要求的总记录数
        $Pages = new \Think\Page($count,$configs['index_page']);// 实例化分页类 传入总记录数和每页显示的记录数		
		$lists = $list->where('state=1')->order('id')->limit($Pages->firstRow.','.$Pages->listRows)->select();
		$page = $Pages -> show();	
		$Pages->setConfig('prev','上一页');
		$Pages->setConfig('next','下一页');	
		$this -> assign('page',$page );// 赋值分页显示输出			
		$this -> assign('config',$configs);
		$this ->assign("list",$lists);
        $this->display();
    }
	//博客列表
	public function blog(){
		$blog = D('tea_blog');
		$configs = $this ->config;
        $count = $blog->count();// 查询满足要求的总记录数
        $Pages = new \Think\Page($count,$configs['index_page']);// 实例化分页类 传入总记录数和每页显示的记录数		
		$blogs = $blog->order('id desc')->limit($Pages->firstRow.','.$Pages->listRows)->select();
		
		$Pages->setConfig('prev','上一页');
		$Pages->setConfig('next','下一页');		
		$page = $Pages -> show();
		
		$this -> assign('page',$page );// 赋值分页显示输出
		$this -> assign('config',$configs);
		$this ->assign('blog',$blogs);
		$this->display();
	}
	public function save(){
		$list = D('tea_list');
		if(IS_POST){
			$author = I('post.author');
			$content = I('post.content');
			$title = I('post.title');			
			$rule = array(
				array('title','require','请填写标题'),
				array('author','require','请填写作者信息'),
				array('content','require','请填写描述信息')				
			);
			$is = $list ->validate($rule)->create();
			if(!is){
				$this ->getError("发表失败");
			}
			$insert = array(
				'id' => 0,
				'author' => $author,
				'title' => $title,
				'content' => $content,
				'create_time'=>time()
			);
			$rid = $list->add($insert);
			$rid < 0 ? $this->error('操作失败'):$this->success('新增成功','/index.php/Home/Index/index');//判断操作结果
		}
		$this->display();
	}
	
	//阅读详细文章页面
    public function read(){
    	$id = I('get.id');
    	$blogs = D('tea_blog');
    	$blogs ->where(array('id' => $id ))->setInc('saw');    	
    	$blog = $blogs ->where(array('id' => $id ))->find();    	
    	$this -> assign('blogs',$blog);    	
    	$this -> display();
    }
    //订单主页
    public function order(){
    	$wfno = date('YmdHis');
		$ip = get_client_ip();
		$wfdate = date('Y-m-d H:i');
		$title = I('post.title');
		$prices = I('post.prices');
		$product = array(
			'title' =>$title,
			'prices' =>$prices,
		);	
		/*
		$status = I('get.lan');//判断状态
		if($status == 'love'){			
			$orders = D('tea_order');
			$wfproduct = I('post.wfproduct');//商品名
			$wfprice = I('post.wfprice');//单价
			$wfmun = I('post.wfmun');//数量
			$wfname = I('post.wfname');//姓名
			$wfmob = I('post.wfmob');//手机号码
			$wfadress = I('post.wfaddress');//详细地址
			$wfpost = I('post.wfpost');//邮政编码
			$wfpay = I('post.wfpay');//付款方式
			$wfmsg = I('post.wfguest');//留言
			$allprice = $wfmun*$wfprice;
			var_dump($allprice);
			$insert = array(
				'product' =>$wfproduct , 
				'price' =>$wfprice, 
				'mun' =>$wfmun , 
				'allprice' =>$allprice, 
				'name' =>$wfname , 
				'phone' =>$wfmob , 
				'adress' =>$wfadress , 
				'post' =>$wfpost , 
				'payways' =>$wfpay , 
				'msg' =>$wfmsg ,
				'wftime' =>time(),
				'ipadress'=>$ip,
			);
			$orders ->add($insert);
		
		}
		*/
		$this ->assign('product',$product);
    	$this ->display();
    }
}