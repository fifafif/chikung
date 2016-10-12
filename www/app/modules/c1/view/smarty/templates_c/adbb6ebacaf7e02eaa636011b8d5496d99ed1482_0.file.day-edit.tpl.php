<?php
/* Smarty version 3.1.29, created on 2016-10-07 17:29:36
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\admin\days\day-edit.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f7db80d380c3_70131500',
  'file_dependency' => 
  array (
    'adbb6ebacaf7e02eaa636011b8d5496d99ed1482' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\admin\\days\\day-edit.tpl',
      1 => 1475861363,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f7db80d380c3_70131500 ($_smarty_tpl) {
?>

    <?php echo '<script'; ?>
 type="text/javascript">
        
        bkLib.onDomLoaded(function() 
        {
            new nicEditor({iconsPath : '<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
js/libs/nicEditorIcons.gif'}).panelInstance('text-edit-1');
        });
    
    <?php echo '</script'; ?>
>


<h2>Edit day</h2>

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminDay:showDay",'id'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
 class="btn info">zpatky</a>

<form action=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminDay:edit",'id'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
 method="post">
    Nazev: <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['day']->value->name;?>
"><br>
    Poradi: <input type="number" name="order" value="<?php echo $_smarty_tpl->tpl_vars['day']->value->order;?>
"><br>
    Popis: <textarea id="text-edit-1" class="span6" rows=20 cols=80 name="description"><?php echo $_smarty_tpl->tpl_vars['day']->value->description;?>
</textarea><br>
    <input type="submit" name="submit" class="btn success">
</form><?php }
}
