<?php
/* Smarty version 3.1.29, created on 2016-09-30 23:27:37
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\admin\days\day.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eef4e9b365c5_93774588',
  'file_dependency' => 
  array (
    '528238521c6e30c4c42e66dc281714a83e00fd36' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\admin\\days\\day.tpl',
      1 => 1475277991,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57eef4e9b365c5_93774588 ($_smarty_tpl) {
?>
<h2>Day - <?php echo $_smarty_tpl->tpl_vars['day']->value->name;?>
</h2>

<p><?php echo $_smarty_tpl->tpl_vars['day']->value->description;?>
</p>

<h3>Cviky</h3>

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminCourse:default"),$_smarty_tpl);?>
>zpatky</a>
<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminExercise:showAdd",'dayId'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
>pridat cvik</a>
<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminDay:showEdit",'id'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
>editovat</a>
<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminDay:delete",'id'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
 onclick="return confirm('Opravdu smazat?');">smazat</a>

<hr />

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

<?php }
}
