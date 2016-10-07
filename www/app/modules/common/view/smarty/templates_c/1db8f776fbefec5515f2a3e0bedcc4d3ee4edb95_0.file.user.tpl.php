<?php
/* Smarty version 3.1.29, created on 2016-10-07 19:48:53
  from "C:\projects\Chikung\chikung\www\app\modules\common\view\admin\user\user.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f7fc250beea2_04813637',
  'file_dependency' => 
  array (
    '1db8f776fbefec5515f2a3e0bedcc4d3ee4edb95' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\common\\view\\admin\\user\\user.tpl',
      1 => 1475869731,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f7fc250beea2_04813637 ($_smarty_tpl) {
?>
<h1>Uzivatel</h1>

Id: <?php echo $_smarty_tpl->tpl_vars['targetUser']->value->id;?>
<br />
Uzivatelske jmeno: <?php echo $_smarty_tpl->tpl_vars['targetUser']->value->username;?>
<br />
Email: <?php echo $_smarty_tpl->tpl_vars['targetUser']->value->email;?>
<br />
Role: <?php echo $_smarty_tpl->tpl_vars['targetUser']->value->role;?>
 [0 - default, 1 - admin]<br />

<hr />

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"common:admin:AdminUser:default"),$_smarty_tpl);?>
 class="btn-grey">zpatky</a>
<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"common:admin:AdminUser:showEdit",'id'=>$_smarty_tpl->tpl_vars['targetUser']->value->id),$_smarty_tpl);?>
 class="btn-grey">editovat</a><?php }
}
