<?php
/* Smarty version 3.1.29, created on 2016-06-04 22:02:31
  from "D:\Projects\chikung\www\app\modules\c1\view\days.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_575333d750d5f4_09915726',
  'file_dependency' => 
  array (
    'd6fec9ad01323ed21907e1f3e262359910435bb0' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\c1\\view\\days.tpl',
      1 => 1464677514,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_575333d750d5f4_09915726 ($_smarty_tpl) {
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
