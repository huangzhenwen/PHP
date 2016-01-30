<?php
////   处理页面 ///

header('content-type:text/html;charset=utf-8');

//接收action
$act = isset($_POST['act']) ? $_POST['act'] : '';


//判断act，执行不同代码

//查询功能
if($act == 'select'){
	//1.接收单词
	$word = isset($_POST['word']) ? strtolower(trim($_POST['word'])) : '';

	//2.解析xml , simplexml + xpath
	$xml = simplexml_load_file('dictionary.xml');
	//3.指定xpath
	$res = $xml->xpath('/words/word');

	//4.循环判断$word是否等于$res
	for ($i=0; $i<count($res); $i++) { 
		if($res[$i]->en == $word){
			echo $word . ' ： ' . $res[$i]->cn;	//输出对应中文
			echo '<br/>';
			echo "<a href='index.php'>回到首页</a>";
			exit;
		}
	}

	//5.如果没有找到，给出提示，并跳转
	echo "<script language='javascript'>alert('没有您要找的单词');window.history.back();</script>";


}elseif($act == 'add'){
//增加单词功能


	//1.接受
	$cn = isset($_POST['cn']) ? htmlspecialchars_decode(trim($_POST['cn'])) : '';
	$en = isset($_POST['en']) ? strtolower(trim($_POST['en'])) : '';
	//2.合理性判断
	if($cn=='' || $en==''){
		echo "<script language='javascript'>alert('不能缺少中文或者英文');window.history.back();</script>";
	}

	//再加一个判断，cn必须是中文，不能有英文，en必须是英文,不能有数字或者其符号等


	//3.解析xml，加载mxl
	$xml = simplexml_load_file('dictionary.xml');

	//4.指定xpath，判断是否存在相同中英文，若存在则不新增，直接提示用户已经存在
	$res = $xml->xpath('/words/word');

	//5.循环判断$word是否等于$res
	for ($i=0; $i<count($res); $i++) { 
		if( $res[$i]->en == $en || $res[0]->cn == $cn ){
			echo "<script language='javascript'>alert('单词已经存在');location.href='index.php';</script>";
			exit;
		}
	}
	
	//如果没有查找到，则新增
	//6.创建word节点
	$word = $xml->addChild('word');
	//7.创建en,cn
	$word->addChild('cn',$cn);
	$word->addChild('en',$en);

	//8.保存XML
	$xml->asXML('dictionary.xml');

	//9.提示用户新增成功
	echo "<script language='javascript'>alert('新增单词成功');location.href='index.php';</script>";
}
