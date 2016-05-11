<?php
/* Smarty version 3.1.29, created on 2016-05-11 06:43:27
  from "D:\Projects\chikung\www\app\modules\c1\view\admin\days\day-edit.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5732b86f3aa6f6_11336197',
  'file_dependency' => 
  array (
    '8de311c8d0066cc0108ba7618a99a16200fac54e' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\c1\\view\\admin\\days\\day-edit.tpl',
      1 => 1462941802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5732b86f3aa6f6_11336197 ($_smarty_tpl) {
?>
<h2>Edit day</h2>

<<?php echo SmartyBinder::printSmartyForm(array('action'=>"c1:admin:AdminDay:edit",'day'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
 method="post">
    Nazev: <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['day']->value->name;?>
"><br>
    Poradi: <input type="number" name="order" value="<?php echo $_smarty_tpl->tpl_vars['day']->value->order;?>
"><br>
    Popis: <input type="text" name="description" value="<?php echo $_smarty_tpl->tpl_vars['day']->value->description;?>
"><br>
    <input type="submit" name="submit">
</form><?php }
}
