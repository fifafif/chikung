<?php
/* Smarty version 3.1.29, created on 2016-10-07 17:24:47
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\admin\index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f7da5f312790_19857652',
  'file_dependency' => 
  array (
    'e2e9e692d0e413f4d4feedf9ea9acb054c04b15d' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\admin\\index.tpl',
      1 => 1475861018,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./../../../common/view/components/userLogin.tpl' => 1,
  ),
),false)) {
function content_57f7da5f312790_19857652 ($_smarty_tpl) {
?>
<head>
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 - administrace</title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
css/fgui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
css/style.css">
    
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
js/libs/nicEdit.js"><?php echo '</script'; ?>
>
    
    

</head>
<body>
    <h1>Administrace kurzu</h1>
    
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./../../../common/view/components/userLogin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    
    <hr />
    
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
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    </div>
    
</body><?php }
}
