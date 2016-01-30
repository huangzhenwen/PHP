<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>完成全选、全不选、反选效果</title>
<style type="text/css">
*{margin:0;padding:0;}
table {margin:30px 0 0 20px;width:600px;;text-align:center; border-collapse:collapse}
table tr th,table tr td{border:4px solid #ccc;height:30px}

</style>
<script src='jquery.js'></script>
<script>
//拓展机制
$.fn.extend({
	all:function(){
		//用this接受jQuery对象，将所有checkbox的checked属性设为checked
		this.attr('checked',true);
	},
	allno:function(){
		//用this接受jQuery对象，将所有checked属性设为空
		this.attr('checked',false);
	},
	other:function(){
		//测试：
		//alert(this[0]);return;
		//返回结果：object HTMLInputElement。this[0]是一个dom对象，所以可以使用checked的boolean直接判断
		
		//通过this获取所有checkbox，this是一个数组，判断是否选定，再做出判断
		for(var i=0; i<this.length; i++){
			//判断每个checkbox的真假
			if(this[i].checked == true){
				//为真，设为false
				this[i].checked = false;
			}else{
				//为假，设为true
				this[i].checked = true;
			}
		}
	}
});


$(function(){
	//绑定事件
	$('#btnAll').bind('click',function(){
		//获取所有checkbox,调用拓展方法
		$(':checkbox').all();
	});

	$('#btnAllNo').bind('click', function(){
		//获取所有checkbox
		$(':checkbox').allno();
	});

	$('#btnOther').bind('click',function(){
		//获取选中的checkbox
		$(':checkbox').other();
	});

	
});
</script>
</head>
<body>

<table>
	<tr>
		<th>操作</th>
		<th>ID</th>
		<th>名称</th>
		<th>等级</th>
	<tr>
<?php
@mysql_connect('localhost','root','hzw');
mysql_query('use myblog');
mysql_query('set names utf8');
$sql = 'select c_id, c_name, c_sort from my_category limit 10';
$res = mysql_query($sql);
while($row = mysql_fetch_assoc($res)){
?>
	
	<tr>
		<td><input type='checkbox' value='<?php echo $row['c_id']?>' /></td>
		<td><?php echo $row['c_id']?></td>
		<td><?php echo $row['c_name']?> </td>
		<td><?php echo $row['c_sort']?> </td>
	</tr>

<?php
}
?>
	<tr>
		<td colspan='4'>
		<input type='button' id='btnAll' value='全选' />
		<input type='button' id='btnAllNo' value='全不选' />
		<input type='button' id='btnOther' value='反选' />
		</td>
	</tr>
</table>

</body>
</html>