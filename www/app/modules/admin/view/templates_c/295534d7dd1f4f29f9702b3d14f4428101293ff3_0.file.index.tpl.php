<?php
/* Smarty version 3.1.29, created on 2016-03-20 22:13:29
  from "D:\Projects\chikung\www\app\modules\admin\view\templates\index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56ef12793c7831_00918618',
  'file_dependency' => 
  array (
    '295534d7dd1f4f29f9702b3d14f4428101293ff3' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\admin\\view\\templates\\index.tpl',
      1 => 1458508334,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../../../common/view/templates/components/userLogin.tpl' => 1,
  ),
),false)) {
function content_56ef12793c7831_00918618 ($_smarty_tpl) {
?>
<head>
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>
<body>
    <h1>Admin Chikung</h1>
    
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../../../common/view/templates/components/userLogin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
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
        <a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
admin/uzivatele">Uzivatele</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
admin/cviceni">Cviceni</a>
    </div>
    
    <div>
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    </div>
    
</body><?php }
}
