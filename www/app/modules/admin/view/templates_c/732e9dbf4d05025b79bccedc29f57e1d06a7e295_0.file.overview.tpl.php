<?php
/* Smarty version 3.1.29, created on 2016-03-21 00:56:09
  from "D:\Projects\chikung\www\app\modules\admin\view\templates\users\overview.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56ef3899070024_47409507',
  'file_dependency' => 
  array (
    '732e9dbf4d05025b79bccedc29f57e1d06a7e295' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\admin\\view\\templates\\users\\overview.tpl',
      1 => 1458518165,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56ef3899070024_47409507 ($_smarty_tpl) {
?>
<h2>Users overview</h2>


<?php if (count($_smarty_tpl->tpl_vars['users']->value) > 0) {?>
<ul>
<?php
$_from = $_smarty_tpl->tpl_vars['users']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_user_0_saved_item = isset($_smarty_tpl->tpl_vars['user']) ? $_smarty_tpl->tpl_vars['user'] : false;
$_smarty_tpl->tpl_vars['user'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['user']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
$__foreach_user_0_saved_local_item = $_smarty_tpl->tpl_vars['user'];
?>
    <li><?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
 - <?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
</li>
<?php
$_smarty_tpl->tpl_vars['user'] = $__foreach_user_0_saved_local_item;
}
if ($__foreach_user_0_saved_item) {
$_smarty_tpl->tpl_vars['user'] = $__foreach_user_0_saved_item;
}
?>
</ul>
<?php } else { ?>
no users
<?php }?>


<?php if (count($_smarty_tpl->tpl_vars['userData']->value) > 0) {?>
<ul>
<?php
$_from = $_smarty_tpl->tpl_vars['userData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_user_1_saved_item = isset($_smarty_tpl->tpl_vars['user']) ? $_smarty_tpl->tpl_vars['user'] : false;
$_smarty_tpl->tpl_vars['user'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['user']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
$__foreach_user_1_saved_local_item = $_smarty_tpl->tpl_vars['user'];
?>
    <li><?php echo $_smarty_tpl->tpl_vars['user']->value['user']->id;?>
 - <?php echo $_smarty_tpl->tpl_vars['user']->value['courses']->id;?>
</li>
<?php
$_smarty_tpl->tpl_vars['user'] = $__foreach_user_1_saved_local_item;
}
if ($__foreach_user_1_saved_item) {
$_smarty_tpl->tpl_vars['user'] = $__foreach_user_1_saved_item;
}
?>
</ul>
<?php } else { ?>
no users
<?php }
}
}
