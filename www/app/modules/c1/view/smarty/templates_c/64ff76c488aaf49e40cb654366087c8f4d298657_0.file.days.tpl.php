<?php
/* Smarty version 3.1.29, created on 2016-09-30 23:27:36
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\admin\days.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eef4e8501b24_40702158',
  'file_dependency' => 
  array (
    '64ff76c488aaf49e40cb654366087c8f4d298657' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\admin\\days.tpl',
      1 => 1475277844,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57eef4e8501b24_40702158 ($_smarty_tpl) {
?>
<h2>Days</h2>

<<?php echo SmartyBinder::printSmartyAhref(array('href'=>"c1:admin:AdminDay:showAdd"),$_smarty_tpl);?>
>pridat den</a>
<<?php echo SmartyBinder::printSmartyAhref(array('href'=>"c1:admin:AdminExercise:showAll"),$_smarty_tpl);?>
>zobrazit vsechny cviky</a>

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
    <li><<?php echo SmartyBinder::printSmartyAhref(array('href'=>"c1:admin:AdminDay:showDay",'id'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
>
        <?php echo $_smarty_tpl->tpl_vars['day']->value->name;?>
 
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
