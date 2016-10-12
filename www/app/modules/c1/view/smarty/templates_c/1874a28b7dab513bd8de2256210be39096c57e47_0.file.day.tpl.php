<?php
/* Smarty version 3.1.29, created on 2016-10-12 04:53:35
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\day.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57fdc1cfdc94d3_80830075',
  'file_dependency' => 
  array (
    '1874a28b7dab513bd8de2256210be39096c57e47' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\day.tpl',
      1 => 1476248014,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57fdc1cfdc94d3_80830075 ($_smarty_tpl) {
?>
<h2>Den - <?php echo $_smarty_tpl->tpl_vars['day']->value->name;?>
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
    <li><a href=<?php ob_start();
echo $_smarty_tpl->tpl_vars['exercise']->value->id;
$_tmp1=ob_get_clean();
echo SmartyBinder::printSmartyLink(array('a'=>"c1:Course:showExercise",'id'=>$_tmp1),$_smarty_tpl);?>
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

<?php if ($_smarty_tpl->tpl_vars['prevDayId']->value != -1) {?>
    <a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:Course:showDay",'id'=>$_smarty_tpl->tpl_vars['prevDayId']->value),$_smarty_tpl);?>
 class="btn info">&Lt; Predchozi den</a>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['nextDayId']->value != -1) {?>
    <a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:Course:showDay",'id'=>$_smarty_tpl->tpl_vars['nextDayId']->value),$_smarty_tpl);?>
 class="btn info">Dalsi den &Gt;</a>
<?php }?>

<hr />

<?php if ($_smarty_tpl->tpl_vars['isCompleted']->value) {?>
    <a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:Course:uncompleteDay",'id'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
 class="btn danger" onclick="return confirm('Nepslnili jste?');">oznacit jako nesplneny</a>
<?php } else { ?>
    <a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:Course:completeDay",'id'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
 class="btn success" onclick="return confirm('Opravdu jste splnili?');">splnit den</a>
<?php }?>

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1::Course:showAllDays"),$_smarty_tpl);?>
 class="btn info">zpatky</a>


<?php }
}
