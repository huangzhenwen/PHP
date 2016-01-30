<?php
/////// 查询表单页面  ///////

//echo $_SERVER['PHP_SELF']; ///JobLesson/2015/12-6/index.php

header('content-type:text/html;charset=utf-8');
?>

<form method="post" action="deal.php">
	<input type="hidden" name="act" value="select" />

	<label>
		请输入您要查询的英文单词：
		<input type="text" name="word" value="" />
	</label>
	
	<input name="submit" type="submit"  value="查询" />
	<br/>
	<a href="add.php">新增单词</a>
</form>