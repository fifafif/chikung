<?php
/* Smarty version 3.1.29, created on 2016-03-15 19:58:36
  from "D:\Projects\chikung\www\app\apps\modules\main\view\templates\admin\exercise\exercise-all.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56e85b5c3149e7_22934786',
  'file_dependency' => 
  array (
    '241e993dc3d4eae158022ad7ab90d7be3330b11e' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\apps\\modules\\main\\view\\templates\\admin\\exercise\\exercise-all.tpl',
      1 => 1458068313,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56e85b5c3149e7_22934786 ($_smarty_tpl) {
?>

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
    <?php }
}
}
