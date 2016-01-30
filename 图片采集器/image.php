<?php
//采集百度图片上的图片

//1、定义地址
$url = 'http://image.baidu.com';	

//2、获取网页源代码
$str = file_get_contents($url);		

//3、定义正则
preg_match_all('/<img.+>/', $str,$match) ;

//4、必须现将$match转为字符串
preg_match_all('/http:\/\/.{0,300}?\.(gif|png|jpg)/', implode('',$match[0]), $src);

//5、当前时间的目录
$folder = date('Ymd',time());

//6、判断是否存在目录
if(!file_exists('images/'.$folder)){
	mkdir('images/'.$folder);
}

//7、变量数组$src，将地址中的图片保存到对应文件中
foreach ($src[0] as $k=>$v){
	copy($v, 'images/'.$folder.'/'.$k.'.png');
}
