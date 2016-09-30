<?php
/* Smarty version 3.1.29, created on 2016-09-30 18:13:04
  from "C:\projects\Chikung\chikung\www\app\modules\common\view\components\userLogin.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eeab3072f707_30773346',
  'file_dependency' => 
  array (
    '301a3220e989dffe7ffdf4de2852d736a5191c72' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\common\\view\\components\\userLogin.tpl',
      1 => 1475253453,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57eeab3072f707_30773346 ($_smarty_tpl) {
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
