<?php
/* Smarty version 3.1.29, created on 2016-10-05 05:05:12
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\days.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f48a0856ccc1_78424976',
  'file_dependency' => 
  array (
    'dd52e68dc9e9481783e30ca24a7f10993a71d252' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\days.tpl',
      1 => 1475643905,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f48a0856ccc1_78424976 ($_smarty_tpl) {
?>
<h2>Seznam dnu</h2>


<?php if (count($_smarty_tpl->tpl_vars['days']->value) > 0) {?>
<ul>
<?php
$_from = $_smarty_tpl->tpl_vars['days']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_day_0_saved_item = isset($_smarty_tpl->tpl_vars['day']) ? $_smarty_tpl->tpl_vars['day'] : false;
$_smarty_tpl->tpl_vars['day'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['day']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['day']->value) {
$_smarty_tpl->tpl_vars['day']->_loop = true;
$__foreach_day_0_saved_local_item = $_smarty_tpl->tpl_vars['day'];
?>
    <li><<?php echo SmartyBinder::printSmartyAhref(array('href'=>"c1:Course:showDay",'id'=>$_smarty_tpl->tpl_vars['day']->value["day"]->id),$_smarty_tpl);?>
>
        <?php echo $_smarty_tpl->tpl_vars['day']->value["day"]->name;?>
 
        
        </a>
        
        <?php if (isset($_smarty_tpl->tpl_vars['day']->value["progress"])) {?> [dokoncen] <?php }?>
            
    </li>
<?php
$_smarty_tpl->tpl_vars['day'] = $__foreach_day_0_saved_local_item;
}
if ($__foreach_day_0_saved_item) {
$_smarty_tpl->tpl_vars['day'] = $__foreach_day_0_saved_item;
}
?>
</ul>
<?php }?>

<h3>Progress</h3>
<?php echo $_smarty_tpl->tpl_vars['completedDaysCount']->value;?>
 / <?php echo count($_smarty_tpl->tpl_vars['days']->value);
}
}
