<?php
/* Smarty version 3.1.29, created on 2016-09-30 23:27:44
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\admin\days\day-edit.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eef4f014bb38_43852992',
  'file_dependency' => 
  array (
    'adbb6ebacaf7e02eaa636011b8d5496d99ed1482' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\admin\\days\\day-edit.tpl',
      1 => 1475277992,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57eef4f014bb38_43852992 ($_smarty_tpl) {
?>
<h2>Edit day</h2>

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminDay:showDay",'id'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
>zpatky</a>

<<?php echo SmartyBinder::printSmartyForm(array('action'=>"c1:admin:AdminDay:edit",'id'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
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
