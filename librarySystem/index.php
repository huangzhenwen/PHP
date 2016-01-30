
<?php
//////  图书系统首页 ////
header('content-type:text/html;charset=utf-8');

//1.解析XML
$xml = simplexml_load_file('libray.xml');
//echo $xml->book[0]->title;//测试输出第一本数的标题
//count($xml->book)
//echo '<pre>';
//var_dump($xml->book[1]);exit;//测试count，计算数量


//2.组织html表格
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<style type="text/css">
		*{
			margin:0px;padding: 0px;
		}
		table{
			
			border: 1px solid;
			text-align: center;
		}
		th,td{
			border: 1px solid;
		}
		img{
			width: 100px;
			height: 200px;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<th>封面</th>
			<th>属性</th>
			<th>操作</th>
		</tr>

	<?php foreach($xml->book as $v) :?>
		<tr>
			<td><img src="<?php echo $v->cover ;?>" /></td>
			<td style="text-align: left;">
				编号：<?php echo $id=$v->attributes();?><br/>
				分类：<?php echo $v->sort;?><br/>
				书名：<?php echo $v->title?><br/>
				作者: <?php echo $v->author?><br/>
				价格￥: <?php echo $v->price?><br/>
				出版日期：<?php echo $v->publication?><br/>
				ISBN：<?php echo $v->isbn;?>
			</td>
			<td>
				<a href="edit.php?id=<?php echo $id;?>">修改</a>
				<a href="deal.php?act=delete&id=<?php echo $id;?>">删除</a>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	<a href="add.php?id=<?php echo $id;?>">添加数据</a>
</body>
</html>