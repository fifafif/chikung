<?php
/* Smarty version 3.1.29, created on 2016-05-31 09:01:08
  from "D:\Projects\chikung\www\app\modules\common\view\index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574d36b42f51f3_20258430',
  'file_dependency' => 
  array (
    '2fcccbaa54220cc7e5f74ab1676f5508a17055aa' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\common\\view\\index.tpl',
      1 => 1464677556,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./components/userLogin.tpl' => 1,
  ),
),false)) {
function content_574d36b42f51f3_20258430 ($_smarty_tpl) {
?>
<head>
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
css/fgui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
css/style.css">
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
    
    <hr />
    
    <div>
        <?php if ($_smarty_tpl->tpl_vars['user']->value->isLogged()) {?>
            <<?php echo SmartyBinder::printSmartyAhref(array('href'=>"c1:Course:showAllDays"),$_smarty_tpl);?>
>kurz</a>

            <?php if ($_smarty_tpl->tpl_vars['user']->value->isAdmin()) {?>
                <<?php echo SmartyBinder::printSmartyAhref(array('href'=>"c1:admin:AdminCourse:default"),$_smarty_tpl);?>
>kurz admin</a>
            <?php }?>
        <?php }?>
    </div>
    
    <div>
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    </div>
    
</body><?php }
}
