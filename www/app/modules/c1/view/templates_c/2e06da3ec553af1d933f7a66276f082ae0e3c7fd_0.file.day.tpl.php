<?php
/* Smarty version 3.1.29, created on 2016-04-29 09:01:32
  from "D:\Projects\chikung\www\app\modules\c1\view\day.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_572306ccb768d8_37021213',
  'file_dependency' => 
  array (
    '2e06da3ec553af1d933f7a66276f082ae0e3c7fd' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\c1\\view\\day.tpl',
      1 => 1461820961,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_572306ccb768d8_37021213 ($_smarty_tpl) {
?>
<h2>Day - <?php echo $_smarty_tpl->tpl_vars['day']->value->name;?>
</h2>

<p><?php echo $_smarty_tpl->tpl_vars['day']->value->description;?>
</p>

<h3>Cviky</h3>

<?php if (count($_smarty_tpl->tpl_vars['exercises']->value) > 0) {?>
<ul>
<?php
$_from = $_smarty_tpl->tpl_vars['exercises']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_exercise_0_saved_item = isset($_smarty_tpl->tpl_vars['exercise']) ? $_smarty_tpl->tpl_vars['exercise'] : false;
$_smarty_tpl->tpl_vars['exercise'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['exercise']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['exercise']->value) {
$_smarty_tpl->tpl_vars['exercise']->_loop = true;
$__foreach_exercise_0_saved_local_item = $_smarty_tpl->tpl_vars['exercise'];
?>
    <li><?php echo $_smarty_tpl->tpl_vars['exercise']->value->id;?>
 - <?php echo $_smarty_tpl->tpl_vars['exercise']->value->name;?>
</li>
<?php
$_smarty_tpl->tpl_vars['exercise'] = $__foreach_exercise_0_saved_local_item;
}
if ($__foreach_exercise_0_saved_item) {
$_smarty_tpl->tpl_vars['exercise'] = $__foreach_exercise_0_saved_item;
}
?>
</ul>
<?php }?>

<<?php echo FLink::printSmartyLink(array('href'=>"c1:course:completeDay",'day'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
>splnit den</a>

<?php }
}
