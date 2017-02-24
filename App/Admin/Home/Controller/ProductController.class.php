<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends AdminController {
	public function index(){
		$list = D('tea_list');
		
		$setting = D('tea_settings');//实例化配置表
        $configs = $setting -> showAll();//获取配置的全部数据
    	$count = $list->count();// 查询满足要求的总记录数
    	$page = new \Think\Page($count,$configs['admin_count']);// 实例化分页类 传入总记录数和每页显示的记录数
		
    	$lists = $list ->order('id desc') -> limit($page->firstRow.','.$page->listRows)-> select();  //查询数据表  	
 		

    	$this->assign('show',$page -> show());// 赋值分页显示输出
		$this ->assign('lists',$lists);
		$this ->display();
	}
	//修改商品
	public  function save(){
    	$list = D('tea_list');
		$id = I('get.id');	
		$lists = $list ->where(array( 'id'=>$id )) ->find();
    	if(IS_POST){
    		$title = I('post.title');
    		$author = I('post.author');
    		$prices = I('post.prices');
			$content = I('post.content');	
			$imgurls = I('post.imgurl');				
			$intro = I('post.intro');				
			
			$upload = new \Think\Upload();// 实例化上传类 
	 		$upload->maxSize = 3145728 ;// 设置附件上传大小 	 		
	 		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型 
	 		$upload->rootPath = './Uploads/'; // 设置附件上传根目录 
	 		$upload->savePath = 'Pimgs/'; // 设置附件上传（子）目录 // 上传文件 
	 		$info = $upload->uploadOne($_FILES['photo']);

	 		
	 		$date = date('Y-m-d');
	 		//设置上传后的路径
	 		
	 		$imgurl ='/'.$upload->rootPath.$upload->savePath.$date.'/'.$info['savename'];
	 		//var_dump($info['savename']);exit;
			if($info['savename'] == null){
				$imgurl = $imgurls;
			}
			$files = ".".$imgurls;//$imgs是数据库中保存的图片链接
			$oldimg = unlink($files);//对原来的图片执行删除	

			$insert = array(
				'title' => $title,
				'prices' => $prices,
				'author' => $author,				
				'content'=>$content,
				'imgurl' => $imgurl,
				'intro' => $intro,
				'update_time' => time()				
			);								
			$result = $list -> where( array('id' => $id )) -> save($insert);			
			if($result){
				return $this -> success('修改成功','/Admin.php/Home/Product/index');	
			}else{
				return $this -> error('修改失败');
			}
    	}		
		$this ->assign('list',$lists);
		$this ->display();
    }
	//新增商品
	public function add(){		
		$list = D('tea_list');
		$lists = $list ->select();
		if(IS_POST){
			
			$title = I('post.title');
    		$author = I('post.author');
    		$prices = I('post.prices');
    		$intro = I('post.intro');
			$content = I('post.content','htmlspecialchars');
			$rule = array(
				array('title','require','忘记输入商品标题咯'),
				array('prices','require','请输入商品价格'),
				array('author','require','作者不能为空'),				
				array('content','require','描述内容不能为空'),
			);           
			if(!$list -> validate($rule) -> create()){
				return $this -> error($list -> getError());
			}


			$upload = new \Think\Upload();// 实例化上传类 
	 		$upload->maxSize = 3145728 ;// 设置附件上传大小 	 		
	 		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型 
	 		$upload->rootPath = './Uploads/'; // 设置附件上传根目录 
	 		$upload->savePath = 'Pimgs/'; // 设置附件上传（子）目录 // 上传文件 
	 		$info = $upload->uploadOne($_FILES['photo']);

	 		if(!$info) {
	 		// 上传错误提示错误信息 
	 		$this->error($upload->getError()); 
	 		}
	 		$date = date('Y-m-d');
	 		//设置上传后的路径
	 		$imgurl ='/'.$upload->rootPath.$upload->savePath.$date.'/'.$info['savename'];
	 	
	 		 
			$insert = array(
				'title' => $title,
				'prices' => $prices,
				'author' => $author,				
				'content' => $content,
				'imgurl' => $imgurl,
				'intro' => $intro,
				'update_time' => time()				
			);
			$result = $list -> add($insert);
			if($result){
				return	$this ->success("商品发布成功",'/Admin.php/Home/Product/index');
			}
		}  	
    	$this -> assign('list',$lists);
    	$this -> display();
    	//选择了你，我没有后悔，几年都在坚持我的想法，小宝自足了
    }

    //删除   
    public function delete(){
    	$id = I('get.id');
    	D('tea_list') -> where( array( 'id'=>$id ) ) -> delete();
    	return $this -> redirect("/Home/Product/index");
    }
	//上架商品
	public function up(){
		$id = I('get.id');		
		$state['state'] = 1;
		$is = D('tea_list') -> where( array( 'id'=>$id) ) ->save($state);
		return $this -> redirect("/Home/Product/index");
		//我只是向你了，所有偶尔注释里面放你的名字
		
	}
	//下架商品
	public function down(){
		$id = I('get.id');
		$state['state'] = 0;
		D('tea_list') -> where( array( 'id'=>$id) ) ->save($state);
		return $this -> redirect("/Home/Product/index");
		
	}
}