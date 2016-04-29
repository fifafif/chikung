<?php
/* Smarty version 3.1.29, created on 2016-04-29 09:27:09
  from "D:\Projects\chikung\www\app\modules\common\view\templates\index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57230ccd4f2f30_58890231',
  'file_dependency' => 
  array (
    'd3e9fbca121a5c31c39d51aef3fbc928a5d2a7b9' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\common\\view\\templates\\index.tpl',
      1 => 1461914704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./components/userLogin.tpl' => 1,
  ),
),false)) {
function content_57230ccd4f2f30_58890231 ($_smarty_tpl) {
?>
<head>
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
css/fgui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
css/bootstrap/bootstrap.min.css">
</head>
<body>
    <h1>Chikung</h1>
    
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./components/userLogin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    
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
    
    <div>
        <?php if ($_smarty_tpl->tpl_vars['user']->value->isLogged()) {?>
        <<?php echo FLink::printSmartyLink(array('href'=>"c1:course:showAllDays"),$_smarty_tpl);?>
>kurz</a>
        <<?php echo FLink::printSmartyLink(array('href'=>"c1:admin:adminCourse:showAllDays"),$_smarty_tpl);?>
>kurz admin</a>
        <?php }?>
    </div>
    
    <div>
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    </div>
    
</body><?php }
}
