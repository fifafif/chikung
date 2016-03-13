<?php
/* Smarty version 3.1.29, created on 2016-03-13 00:56:52
  from "D:\Projects\chikung\www\app\mvc\view\templates\index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56e4acc41113e1_91229787',
  'file_dependency' => 
  array (
    '583f44e704065e708f0dad9ee120053aeaf25f8c' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\mvc\\view\\templates\\index.tpl',
      1 => 1457827009,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56e4acc41113e1_91229787 ($_smarty_tpl) {
?>
<head>
    
</head>
<body>
    <h1>Chikung</h1>
    
    
    <?php if (count($_smarty_tpl->tpl_vars['messages']->value) > 0) {?>
    <ul>
    <?php
$_from = $_smarty_tpl->tpl_vars['messages']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_message_0_saved_item = isset($_smarty_tpl->tpl_vars['message']) ? $_smarty_tpl->tpl_vars['message'] : false;
$_smarty_tpl->tpl_vars['message'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['message']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->_loop = true;
$__foreach_message_0_saved_local_item = $_smarty_tpl->tpl_vars['message'];
?>
        <li><?php echo $_smarty_tpl->tpl_vars['message']->value->getMessage();?>
</li>
    <?php
$_smarty_tpl->tpl_vars['message'] = $__foreach_message_0_saved_local_item;
}
if ($__foreach_message_0_saved_item) {
$_smarty_tpl->tpl_vars['message'] = $__foreach_message_0_saved_item;
}
?>
    </ul>
    <?php }?>
    
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
    
    <?php }?>
    
</body>

hello koko <?php echo $_smarty_tpl->tpl_vars['name']->value;?>


<?php }
}
