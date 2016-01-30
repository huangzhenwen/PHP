<?php /* Smarty version 3.1.24, created on 2015-12-23 19:17:34
         compiled from "D:/server/apache/htdocs/LessonTest/JobLesson/2015/12-23/fenye/discuss.html" */ ?>
<?php
/*%%SmartyHeaderCode:22035567a82ce8c3f03_61929352%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45a6f0545f4a5bbd6d388c82bd0b60b11bb3bc5c' => 
    array (
      0 => 'D:/server/apache/htdocs/LessonTest/JobLesson/2015/12-23/fenye/discuss.html',
      1 => 1450869452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22035567a82ce8c3f03_61929352',
  'variables' => 
  array (
    'perv' => 0,
    'next' => 0,
    'last' => 0,
    'data' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_567a82ce93fe59_00271931',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_567a82ce93fe59_00271931')) {
function content_567a82ce93fe59_00271931 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:/server/apache/htdocs/LessonTest/JobLesson/2015/12-23/fenye/smarty/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '22035567a82ce8c3f03_61929352';
?>
<table id='talk'>
	
	<tr  style='text-align:right;'>
		<td colspan='3'>
			<a onclick='display(1);'>首页</a>
			<a onclick='display(<?php echo $_smarty_tpl->tpl_vars['perv']->value;?>
);' >上一页</a>
			<a onclick='display(<?php echo $_smarty_tpl->tpl_vars['next']->value;?>
);' >下一页</a>
			<a onclick='display(<?php echo $_smarty_tpl->tpl_vars['last']->value;?>
);'>末页</a>
		</td>
	</tr>
	
	<tr>
		<th>ID</th>
		<th>标题</th>
		<th>评论</th>
	</tr>

<?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['row']->value['art_id'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['row']->value['art_name'];?>
</td>
		<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['art_time'],'%Y-%m-%d %H:%M:%S');?>
</td>
	</tr>
<?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
	
</table><?php }
}
?>