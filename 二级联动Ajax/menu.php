<?php
//获取等级
$parentID = $_GET['parentID'];

//连接数据库
@mysql_connect('localhost','root','hzw');
mysql_query('use myblog');
mysql_query('set names utf8');

//获取父级分类目录
$sql = "select c_id,c_name from my_category where c_parent_id=".$parentID;
$res = mysql_query($sql);
$list = array();
while($row = mysql_fetch_assoc($res)){
	$list[] = $row;
}

//返回json数据
echo json_encode($list);
