<?php
/* Smarty version 3.1.29, created on 2016-10-05 04:40:32
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\admin\exercise\exercise-all.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f48440805619_40726455',
  'file_dependency' => 
  array (
    '6121df258b3ba52ecd805e41cf45a290957638f5' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\admin\\exercise\\exercise-all.tpl',
      1 => 1475642336,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f48440805619_40726455 ($_smarty_tpl) {
?>
<h2>Vsechny cviky</h2>

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
    <li><a href=<?php ob_start();
echo $_smarty_tpl->tpl_vars['exercise']->value->id;
$_tmp1=ob_get_clean();
echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminExercise:show",'id'=>$_tmp1),$_smarty_tpl);?>
><?php echo $_smarty_tpl->tpl_vars['exercise']->value->name;?>
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

<hr />

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminCourse:default"),$_smarty_tpl);?>
 class="btn info">zpatky</a><?php }
}
