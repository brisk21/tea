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
					<h1>添加商品 
						<small style='float:right;margin-right:30px;'>		
							<a href="<?php echo U('/Home/Product/');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> 返回</a>
						</small>
					</h1>
				</div>		
					
				<div class="col-md-10">
					<div class="panel-body">
						<form action="<?php echo U('/Home/Product/add');?>"  enctype="multipart/form-data" method="post">						
							<div class="form-group">
								<label for="title">标题：</label>
								<input type="text" class="form-control" name="title" id="title" placeholder="请输入商品标题" >
							</div>
							<div class="form-group">
								<label for="title">商品价格（元）：</label>
								<input type="text" class="form-control" name="prices" id="title" placeholder="请输入商品价格" >
							</div>
							<div class="form-group">
								<label for="author">发布者：</label>								
								<input type="text" class="form-control" name="author"  id="author" placeholder="请输入发布者" >
							</div>							
							<div class="form-group">
								<label for="file">选择一张图片</label>
								<input type="file" name="photo" value="图片">
								<img src="<?php echo $filepath; ?>" alt=""><br>
								<label for="intro">图片描述（便于收录）:</label>
								<input type="text" name="intro" class="form-control" /><br>
								<label for="content">商品描述内容：</label>
								<textarea name="content" class="form-control" rows="10"  placeholder="这里输入商品描述（100字）" ></textarea>								
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
</body>