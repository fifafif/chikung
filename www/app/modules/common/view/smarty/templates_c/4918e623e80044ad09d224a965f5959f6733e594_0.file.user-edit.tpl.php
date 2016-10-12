<?php
/* Smarty version 3.1.29, created on 2016-10-08 00:09:03
  from "C:\projects\Chikung\chikung\www\app\modules\common\view\admin\user\user-edit.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f8391fcf7ee1_84083159',
  'file_dependency' => 
  array (
    '4918e623e80044ad09d224a965f5959f6733e594' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\common\\view\\admin\\user\\user-edit.tpl',
      1 => 1475885341,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f8391fcf7ee1_84083159 ($_smarty_tpl) {
?>
<h2>Editovat uzivatele</h2>

<form action=<?php echo SmartyBinder::printSmartyLink(array('a'=>"common:admin:AdminUser:edit",'id'=>$_smarty_tpl->tpl_vars['targetUser']->value->id),$_smarty_tpl);?>
 method="post">
    Uzivatelske jmeno: <input type="text" name="username" value="<?php echo $_smarty_tpl->tpl_vars['targetUser']->value->username;?>
"><br>
    Email: <input type="text" name="email" value="<?php echo $_smarty_tpl->tpl_vars['targetUser']->value->email;?>
"><br>
    <?php echo SmartyBinder::printFormSelect(array('name'=>"role",'data'=>$_smarty_tpl->tpl_vars['roleData']->value),$_smarty_tpl);?>
<br />
    
    Aktivovane kurzy:<br />
    <?php if (count($_smarty_tpl->tpl_vars['courses']->value) > 0) {?>
    <?php
$_from = $_smarty_tpl->tpl_vars['courses']->value;
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
        <input type="checkbox" name="courseIds[]" value="<?php echo $_smarty_tpl->tpl_vars['course']->value->id;?>
" 
               
                <?php if (array_key_exists($_smarty_tpl->tpl_vars['course']->value->id,$_smarty_tpl->tpl_vars['userCourses']->value) && $_smarty_tpl->tpl_vars['userCourses']->value[$_smarty_tpl->tpl_vars['course']->value->id]->status == 1) {?> checked <?php }?>
               /><?php echo $_smarty_tpl->tpl_vars['course']->value->name;?>

    <?php
$_smarty_tpl->tpl_vars['course'] = $__foreach_course_0_saved_local_item;
}
if ($__foreach_course_0_saved_item) {
$_smarty_tpl->tpl_vars['course'] = $__foreach_course_0_saved_item;
}
?>
    <?php } else { ?>
        Nejsou zadne kuzry
    <?php }?>
    
    <br />
    
    <input type="submit" name="submit" class="btn success"><br />
    
</form>

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"common:admin:AdminUser:show",'id'=>$_smarty_tpl->tpl_vars['targetUser']->value->id),$_smarty_tpl);?>
 class="btn info">Zrusit</a>
    
<?php }
}
