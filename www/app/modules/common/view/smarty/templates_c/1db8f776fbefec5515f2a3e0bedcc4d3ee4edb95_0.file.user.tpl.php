<?php
/* Smarty version 3.1.29, created on 2016-10-08 00:36:27
  from "C:\projects\Chikung\chikung\www\app\modules\common\view\admin\user\user.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f83f8bb3ebe6_38123414',
  'file_dependency' => 
  array (
    '1db8f776fbefec5515f2a3e0bedcc4d3ee4edb95' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\common\\view\\admin\\user\\user.tpl',
      1 => 1475886980,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f83f8bb3ebe6_38123414 ($_smarty_tpl) {
?>
<h1>Uzivatel</h1>

Id: <?php echo $_smarty_tpl->tpl_vars['targetUser']->value->id;?>
<br />
Uzivatelske jmeno: <?php echo $_smarty_tpl->tpl_vars['targetUser']->value->username;?>
<br />
Email: <?php echo $_smarty_tpl->tpl_vars['targetUser']->value->email;?>
<br />
Role: <?php echo $_smarty_tpl->tpl_vars['targetUser']->value->role;?>
 [0 - default, 1 - admin]<br />

Kurzy:
<?php if (count($_smarty_tpl->tpl_vars['userCourses']->value) > 0) {?>
    <?php
$_from = $_smarty_tpl->tpl_vars['userCourses']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_course_0_saved_item = isset($_smarty_tpl->tpl_vars['course']) ? $_smarty_tpl->tpl_vars['course'] : false;
$_smarty_tpl->tpl_vars['course'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['course']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['course']->value) {
$_smarty_tpl->tpl_vars['course']->_loop = true;
$__foreach_course_0_saved_local_item = $_smarty_tpl->tpl_vars['course'];
?>
        <?php echo $_smarty_tpl->tpl_vars['course']->value->id;?>
; 
    <?php
$_smarty_tpl->tpl_vars['course'] = $__foreach_course_0_saved_local_item;
}
if ($__foreach_course_0_saved_item) {
$_smarty_tpl->tpl_vars['course'] = $__foreach_course_0_saved_item;
}
} else { ?>
    Uzivatel nema zadne kurzy.
<?php }?>
            

<hr />

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"common:admin:AdminUser:default"),$_smarty_tpl);?>
 class="btn-grey">zpatky</a>
<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"common:admin:AdminUser:showEdit",'id'=>$_smarty_tpl->tpl_vars['targetUser']->value->id),$_smarty_tpl);?>
 class="btn-grey">editovat</a><?php }
}
