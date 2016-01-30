<?php
///// 增加XML数据 //////////

header('content-type:text/html;charset=utf-8');

//1.接收id，即新编号
$id = $_GET['id'] ? $_GET['id'] : 0;
if($id){
	//由于id是有字母和数组组成的，需要分离数字与字母
	//$id=$id+1;
	$id = 'b'. ( (integer)substr($id, 1) + 1 );

}else{
	echo "<script language='javascript'>alert('参数错误');window.history.back();</script>";
}

?>


<form method="post" action='deal.php?act=add'>
	<table>
		
	<tr>
		<td style=''>编号：</td>
		<td><input  type='text' name='id' value="<?php echo $id;?>" readonly="readonly" /></td>
	</tr>
	<tr>
		<td style=''>分类：</td>
		<td><input type='text' value="" name='sort'/></td>
	</tr>
	<tr>
		<td style=''>封面：</td>
		<td><input type='text' value="" name='cover'/> </td>
	</tr>
	<tr>
		<td style=''>书名</td>
		<td><input type='text' value="" name='title'/> </td>
	</tr>
	<tr>
		<td style=''>作者</td>
		<td><input type='text' value="" name='author'/> </td>
	</tr>
	<tr>
		<td style=''>出版日期</td>
		<td><input type='text' value="" name='publication'/> </td>
	</tr>	
	<tr>
		<td style=''>ISBN</td>
		<td><input type='text' value="" name='isbn'/> </td>
	</tr>
	<tr>
		<td style=''>价格</td>
		<td><input type='text' value="" name='price'/> </td>
	</tr>
	<tr>
		<td><input type="submit" name="submit" value="添加书籍" /></td>
	</tr>

	</table>

</form>
