<?php
/* Smarty version 3.1.29, created on 2016-05-31 07:06:53
  from "D:\Projects\chikung\www\app\modules\common\view\components\userLogin.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574d1bedbaf749_80580888',
  'file_dependency' => 
  array (
    'd46176f7cad36b45cfad80c4e13da96fc81e13b1' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\common\\view\\components\\userLogin.tpl',
      1 => 1464671205,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_574d1bedbaf749_80580888 ($_smarty_tpl) {
?>
    <?php if ($_smarty_tpl->tpl_vars['user']->value->isLogged()) {?>
    
    hello <?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>

    
    <br>
    <a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
index.php?c=User&h=logout">logout</a>
    
    <?php } else { ?>
    
    <h2>Registrace</h2>
    <<?php echo SmartyBinder::printSmartyForm(array('action'=>"User:create"),$_smarty_tpl);?>
 method="post">
        Username: <input type="text" name="username"><br>
        E-mail: <input type="text" name="email"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" name="submit">
    </form>
    
    <h2>Login</h2>
    <<?php echo SmartyBinder::printSmartyForm(array('action'=>"User:login"),$_smarty_tpl);?>
 method="post">
        Username: <input type="text" name="username-login"><br>
        Password: <input type="password" name="password-login"><br>
        <input type="submit" name="submit-login">
    </form>
    
    <?php }
}
}
