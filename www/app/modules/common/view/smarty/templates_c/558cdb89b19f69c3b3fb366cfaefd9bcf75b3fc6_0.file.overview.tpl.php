<?php
/* Smarty version 3.1.29, created on 2016-10-07 18:57:52
  from "C:\projects\Chikung\chikung\www\app\modules\common\view\admin\user\overview.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f7f03009be55_67473332',
  'file_dependency' => 
  array (
    '558cdb89b19f69c3b3fb366cfaefd9bcf75b3fc6' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\common\\view\\admin\\user\\overview.tpl',
      1 => 1475866669,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f7f03009be55_67473332 ($_smarty_tpl) {
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
    <li><a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"common:admin:AdminUser:show",'id'=>$_smarty_tpl->tpl_vars['user']->value->id),$_smarty_tpl);?>
><?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
 - <?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
</a></li>
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

<?php }
}
