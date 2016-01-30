<?php 
//1.加载Smarty引擎
include_once 'Smarty/Smarty.class.php';

//2.实例化对象
$smarty = new Smarty();

//3.1 连接数据库
mysql_connect('localhost','root','hzw');
//3.2 设置字符集
mysql_set_charset('UTF-8');
//3.3 选择数据库
mysql_query('use myblog');

//4.1 分页数据($allcount:总数| $page:页码| $offset,$limit，limit子句| $num:每页显示数量 | $pageCount:总页数)
$num = 5;	//每页显示的数量
$allcount = mysql_fetch_assoc(mysql_query('select count(*) as count from my_article'))['count'] ; //获取文章总数
$pageCount = ceil($allcount/$num); //总页数

//4.2 接受页码$page
if ( isset($_GET['page']) ){
	$page = $_GET['page'];	//赋值
}else{
	$page = 1;
}

//4.3 使用limit子句获取相应数据，$offset,$limit
$offset = ($page-1) * $num;	//计算偏移量，每次增加5
$data = array();			//文章数据
$res = mysql_query("select art_id,art_name,art_nickname,art_author,art_status from my_article limit {$offset},{$num}");	//获取数据中的数据
while($row = mysql_fetch_assoc($res)){
	$data[] = $row;	//通过循环提取$res中的每条数据，放入$data中
}

//4.4 指定上一页与下一页， $next,$perv
$next = $page < $pageCount ? $page+1  : $pageCount; //下一页
$perv = $page > 1 ?  $page-1: 1;  //上一页

//5 分配数据
$smarty->assign('data',$data);	//分配文章,二维数组
$smarty->assign('next',$next);	//分配下一页
$smarty->assign('perv',$perv);	//分配上一页
$smarty->assign('last',$pageCount);//分配总页数
$smarty->assign('page',$page);	//当前页码
$smarty->assign('all',$allcount);//分配总文章数量
//6 显示模版
$smarty->display('articles.html');
