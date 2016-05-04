<?php
/* Smarty version 3.1.29, created on 2016-05-04 08:08:49
  from "D:\Projects\chikung\www\app\modules\common\view\templates\components\userLogin.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_572991f1229366_64866296',
  'file_dependency' => 
  array (
    'a3dea72cf71b134d18f623ac90bb1d51a0868990' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\common\\view\\templates\\components\\userLogin.tpl',
      1 => 1462342115,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_572991f1229366_64866296 ($_smarty_tpl) {
?>
<div>User login:</div>


<<?php echo SmartyBinder::printSmartyAhref(array('href'=>"User:create",'a'=>!$_smarty_tpl->tpl_vars['user']->value->isLogged(),'name'=>"123"),$_smarty_tpl);?>
>user </a>


    <?php if ($_smarty_tpl->tpl_vars['user']->value->isLogged()) {?>
    
    hello <?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>

    
    <br>
    <a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
index.php?c=User&h=logout">logout</a>
    
    <?php } else { ?>
    
    <h2>Registrace pico!</h2>
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
