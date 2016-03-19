<?php
/* Smarty version 3.1.29, created on 2016-03-15 19:16:06
  from "D:\Projects\chikung\www\app\apps\modules\main\view\templates\admin\exercise-all.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56e85166d0ca52_36917747',
  'file_dependency' => 
  array (
    '8179e20f2cd2749837e150d169ca36000dc7781b' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\apps\\modules\\main\\view\\templates\\admin\\exercise-all.tpl',
      1 => 1458065274,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56e85166d0ca52_36917747 ($_smarty_tpl) {
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
0</li>
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
