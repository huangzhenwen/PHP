<?php
////   新增页面 ////
header('content-type:text/html;charset=utf-8');
?>
<form method="post" action="deal.php">
	<input type="hidden" name="act" value="add" />
	
	<label>中文：<input type="text" name="cn" value="" />	</label>
	<label>英文：<input type="text" name="en" value="" />	</label>
	
	<input type="submit" name="submit" value="提交" />
	<br/>
	<a href="index.php">回到首页</a>
</form>