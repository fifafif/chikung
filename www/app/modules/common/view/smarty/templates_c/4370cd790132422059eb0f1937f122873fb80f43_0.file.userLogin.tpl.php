<?php
/* Smarty version 3.1.29, created on 2016-03-14 00:41:27
  from "D:\Projects\chikung\www\app\mvc\view\templates\components\userLogin.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56e5faa711a731_97721884',
  'file_dependency' => 
  array (
    '4370cd790132422059eb0f1937f122873fb80f43' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\mvc\\view\\templates\\components\\userLogin.tpl',
      1 => 1457912254,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56e5faa711a731_97721884 ($_smarty_tpl) {
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
