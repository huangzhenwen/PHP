<?php
//根据keyword，获取相似数据
$keyword = $_POST['keyword'];

//连接数据库
@mysql_connect('localhost','root','hzw');
mysql_query('use myblog');
mysql_query('set names utf8');

//SQL语句
$sql = "select c_name from my_category where c_name like '{$keyword}%' limit 10";
$res = mysql_query($sql);

//取出每条数据，存入数组
$list = array();
while($row = mysql_fetch_assoc($res)){
	$list[] = $row;
}

//返回json格式数据
echo json_encode($list);
