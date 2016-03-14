<?php
/* Smarty version 3.1.29, created on 2016-03-14 02:13:18
  from "D:\Projects\chikung\www\app\apps\modules\main\view\templates\components\userLogin.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56e6102ede47e9_61851945',
  'file_dependency' => 
  array (
    'a99a5c26bd41f9eb215da21d3f204ffc75065b26' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\apps\\modules\\main\\view\\templates\\components\\userLogin.tpl',
      1 => 1457912254,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56e6102ede47e9_61851945 ($_smarty_tpl) {
?>
<div>User login:</div>

    <?php if ($_smarty_tpl->tpl_vars['user']->value->isLogged()) {?>
    
    hello <?php echo $_smarty_tpl->tpl_vars['user']->value->data['username'];?>

    
    <br>
    <a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
index.php?c=User&h=logout">logout</a>
    
    <?php } else { ?>
    
    <h2>Registrace</h2>
    <form action="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
uzivatel/registrace" method="post">
        Username: <input type="text" name="username"><br>
        E-mail: <input type="text" name="email"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" name="submit">
    </form>
    
    <h2>Login</h2>
    <form action="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
uzivatel/login" method="post">
        Username: <input type="text" name="username-login"><br>
        Password: <input type="password" name="password-login"><br>
        <input type="submit" name="submit-login">
    </form>
    
    <?php }
}
}
