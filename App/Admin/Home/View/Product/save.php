<!DOCTYPE HTML>
<html lang="zh-CN">
	<?php include(THEME_PATH.'Common/head.php');?>		
<body>
	<div class="container-fluid">
		<div class="col-md-12">
			<?php include(THEME_PATH.'Common/nav.php');?>
		</div>
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-12">
				<div class="page-header">
					<h1>修改商品信息 
						<small style='float:right;margin-right:30px;'>		
							<a href="<?php echo U('/Home/Product/');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> 返回</a>
						</small>
					</h1>
				</div>		
					
				<div class="col-md-10">
					<div class="panel-body">
						<form action="<?php echo U('/Home/Product/save');?>?id=<?php echo $list['id'];?>" enctype="multipart/form-data" method="post">						
							<div class="form-group">
								<label for="title">商品名称：</label>
								<input type="text" class="form-control" name="title" id="title"  value="{$list.title}">
							</div>
							<div class="form-group">
								<label for="title">商品价格（元）：</label>
								<input type="text" class="form-control" name="prices" id="title" value="{$list.prices}">
							</div>
							<div class="form-group">
								<label for="author">作者：</label>								
								<input type="text" class="form-control" name="author"  id="author" value="<?php echo $list['author']; ?>" >
							</div>							
							<input type="hidden" name="imgurl" value="{$list.imgurl}">
							<label for="changeimg">更换图片(展示图片)</label>
							<input type="file" name="photo" value="图片">	
							<img src="{$list.imgurl}" style="width: 200px;height: 200px;" alt=""><br>
							<label for="intro">图片描述（便于收录）:</label>
								<input type="text" name="intro" class="form-control" value="{$list.intro}"/><br>
							<div class="form-group">
								<label for="content">商品描述内容：</label>
								<textarea name="content" class="form-control" style="width:100%;height:300px;">{$list.content}</textarea>							
							</div>
									  
								<button type="submit" class="btn btn-default">提交</button>	
						</form>						
					</div>
				</div>			
			 <div class="col-md-2"></div>
		</div>
		<div class="col-md-2"></div>
		</div>
	</div>		
	<js href="/Public/kindeditor/kindeditor-min.js" />
	<js href="/Public/kindeditor/lang/zh_CN.js" />	
	<script src="http://weibingsheng.cn/Public/kindeditor/kindeditor-min.js"></script>
	<script src="http://weibingsheng.cn/Public/kindeditor/lang/zh_CN.js"></script>
	<script>
		//富文本编辑器
		KindEditor.ready(function(K) {
			window.editor = K.create('#editor_id');
			// 取得HTML内容
			html = editor.html();
			// 同步数据后可以直接取得textarea的value
			editor.sync();
			//html = document.getElementById('editor_id').value; // 原生API
			//html = K('#editor_id').val(); // KindEditor Node API
			html = $('#editor_id').val(); // jQuery
			// 设置HTML内容
			//editor.html('HTML内容');
			// 关闭过滤模式，保留所有标签
			 K.create('#editor_id');
			 KindEditor.options.filterMode = false;				
		});							
		</script>
</body>