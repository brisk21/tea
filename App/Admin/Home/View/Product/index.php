<!DOCTYPE HTML>
<html lang="zh-CN">
	<?php include(THEME_PATH.'Common/head.php');?>
	<style>
		.pagination a,.pagination span{
			padding: 5px;
			margin: 5px;
			font-size: 14px;
			background: rgba(7, 255, 139, 0.31);
		}
		.pagination span{
			background: rgba(232, 146, 59, 0.57);
			color: red;
		}
	</style>
<body>
	<div class="container-fluid">
		<div class="col-md-12">
			<?php include(THEME_PATH.'Common/nav.php');?>
		</div>
		<div class="col-md-12">
				<div class="page-header">
					<h1>商品管理 
						<small style='float:right;margin-right:30px;'>		
							<a href="<?php echo U('/Home/Product/add');?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> 添加</a>
						</small>
					</h1>
				</div>
				<div class="table-responsive ">
					<table class="table">
						<thead>
							<tr>
								<th>id</th>
								<th>商品标题</th>
								<th>商品价格</th>
								<th>发布者</th>
								<th>状态</th>								
								<th>管理</th>
							</tr>
						</thead>						
						<tbody>						
							 <?php foreach($lists as $list): ?>
							<tr>
								<td><?php echo $list['id'];?></td>
								<td><?php echo $list['title'];?></td>
								<td><?php echo $list['prices'];?></td>								
								<td><?php echo $list['author'];?></td>
								<td><?php if($list['state'] == 1){echo "已上架";}else{echo "待展示";};?></td>
								<td>
								<a href="<?php echo U('/Home/Product/save');?>?id=<?php echo $list['id']; ?>" class="btn btn-primary btn-xs">修改</a>
								<a href="<?php echo U('/Home/Product/up');?>?id=<?php echo $list['id']; ?>" class="btn btn-success btn-xs">上架</a>
								<a href="<?php echo U('/Home/Product/down');?>?id=<?php echo $list['id']; ?>" class="btn btn-primary btn-xs">下架</a>	
								<a href="<?php echo U('/Home/Product/delete');?>?id=<?php echo $list['id']; ?>" onclick="return confirm('确定删除该商品吗？不可恢复哦')" class="btn btn-danger btn-xs">删除</a>						
								</td>
							</tr>
							 <?php endforeach ; ?>
						</tbody>
					</table>
				</div>				
			</div>
		</div>
		<div class="col-md-4 col-md-offset-4">
			<nav class="pull-right">
				<ul class="pagination">
						<?php echo $show;?>	
				</ul>
			</nav>
		</div>		
	</div>
</body>
</html>