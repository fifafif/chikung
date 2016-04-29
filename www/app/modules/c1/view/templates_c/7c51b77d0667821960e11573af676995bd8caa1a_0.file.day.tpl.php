<?php
/* Smarty version 3.1.29, created on 2016-04-29 09:32:22
  from "D:\Projects\chikung\www\app\modules\c1\view\admin\day.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57230e0658ec08_62337268',
  'file_dependency' => 
  array (
    '7c51b77d0667821960e11573af676995bd8caa1a' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\c1\\view\\admin\\day.tpl',
      1 => 1461915062,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57230e0658ec08_62337268 ($_smarty_tpl) {
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

<?php }
}
