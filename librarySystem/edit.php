<?php
//// 修改XML图书信息 ///

//接受需要修改的图书的id
$id = $_GET['id'] ? $_GET['id'] : 0;
if (!$id) { //判断是否接受到id
	echo "<script language='javascript'>alert('参数错误');window.history.back();</script>";
}

//1.解析xml,回显数据
$xml = simplexml_load_file('libray.xml');
//2.使用xpath，根据对应id获取对应数据
$book = $xml->xpath("/libray/book[@id='$id']");
//3.获取相关数据
$sort = $book[0]->sort;
$cover = $book[0]->cover;	//<cover>节点
$author = $book[0]->author;	//<author>节点
$title =$book[0]->title;	//<title>节点
$publication =$book[0]->publication;	//<publication>节点
$isbn = $book[0]->isbn;
$price = $book[0]->price;



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>

</head>
<body>

<form method="post" action='deal.php?act=edit'>
	<table>
		
	<tr>
		<td style=''>编号：</td>
		<td><input  type='text' name='id' value="<?php echo $id;?>" readonly="readonly" /></td>
	</tr>
	<tr>
		<td style=''>分类：</td>
		<td><input type='text' value="<?php echo $sort;?>" name='sort'/></td>
	</tr>
	<tr>
		<td style=''>封面：</td>
		<td><input type='text' value="<?php echo $cover;?>" name='cover'/> </td>
	</tr>
	<tr>
		<td style=''>书名</td>
		<td><input type='text' value="<?php echo $title;?>" name='title'/> </td>
	</tr>
	<tr>
		<td style=''>作者</td>
		<td><input type='text' value="<?php echo $author;?>" name='author'/> </td>
	</tr>
	<tr>
		<td style=''>出版日期</td>
		<td><input type='text' value="<?php echo $publication;?>" name='publication'/></td>
	</tr>	
	<tr>
		<td style=''>ISBN</td>
		<td><input type='text' value="<?php echo $isbn;?>" name='isbn'/>
	<tr>
		<td style=''>价格￥</td>
		<td><input type='text' value="<?php echo $price;?>" name='price'/> </td>
	</tr>
	<tr>
		<td><input type="submit" name="submit" value="修改书籍信息" /></td>
	</tr>

	</table>

</form>

</body>
</html>