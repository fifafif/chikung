<?php
/* Smarty version 3.1.29, created on 2016-10-07 19:37:57
  from "C:\projects\Chikung\chikung\www\app\modules\common\view\admin\user\user-edit.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f7f9954096e5_47915954',
  'file_dependency' => 
  array (
    '4918e623e80044ad09d224a965f5959f6733e594' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\common\\view\\admin\\user\\user-edit.tpl',
      1 => 1475869074,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f7f9954096e5_47915954 ($_smarty_tpl) {
?>
<h2>Editovat uzivatele</h2>

<form action=<?php echo SmartyBinder::printSmartyLink(array('a'=>"common:admin:AdminUser:edit",'id'=>$_smarty_tpl->tpl_vars['targetUser']->value->id),$_smarty_tpl);?>
 method="post">
    Uzivatelske jmeno: <input type="text" name="username" value="<?php echo $_smarty_tpl->tpl_vars['targetUser']->value->username;?>
"><br>
    Email: <input type="text" name="email" value="<?php echo $_smarty_tpl->tpl_vars['targetUser']->value->email;?>
"><br>
    <?php echo SmartyBinder::printFormSelect(array('name'=>"role",'data'=>$_smarty_tpl->tpl_vars['roleData']->value),$_smarty_tpl);?>

    <input type="submit" name="submit" class="btn-green">
</form>

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"common:admin:AdminUser:show",'id'=>$_smarty_tpl->tpl_vars['targetUser']->value->id),$_smarty_tpl);?>
 class="btn-grey">Zrusit</a>
    
<?php }
}
