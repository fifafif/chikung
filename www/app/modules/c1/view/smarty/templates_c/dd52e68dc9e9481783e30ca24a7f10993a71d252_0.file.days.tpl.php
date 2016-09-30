<?php
/* Smarty version 3.1.29, created on 2016-09-30 18:46:37
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\days.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eeb30dcf2d73_13072831',
  'file_dependency' => 
  array (
    'dd52e68dc9e9481783e30ca24a7f10993a71d252' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\days.tpl',
      1 => 1475253453,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57eeb30dcf2d73_13072831 ($_smarty_tpl) {
?>
<h2>Days</h2>


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
    <li><<?php echo SmartyBinder::printSmartyAhref(array('href'=>"c1:Course:showDay",'day'=>$_smarty_tpl->tpl_vars['day']->value["day"]->id),$_smarty_tpl);?>
>
        <?php echo $_smarty_tpl->tpl_vars['day']->value["day"]->name;?>
 
        <?php if (isset($_smarty_tpl->tpl_vars['day']->value["progress"])) {?> completed <?php }?>
        </a>
            
    </li>
<?php
$_smarty_tpl->tpl_vars['day'] = $__foreach_day_0_saved_local_item;
}
if ($__foreach_day_0_saved_item) {
$_smarty_tpl->tpl_vars['day'] = $__foreach_day_0_saved_item;
}
?>
</ul>
<?php }
}
}
