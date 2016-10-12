<?php
/* Smarty version 3.1.29, created on 2016-10-07 16:53:31
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\admin\exercise\exercise-add.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f7d30b1c1728_96751371',
  'file_dependency' => 
  array (
    'd8790ccced0e16746f877e4bb04eaec20a03c952' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\admin\\exercise\\exercise-add.tpl',
      1 => 1475859206,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f7d30b1c1728_96751371 ($_smarty_tpl) {
?>
<h2>Pridat cvik</h2>


    <?php echo '<script'; ?>
 type="text/javascript">
        
        bkLib.onDomLoaded(function() 
        {
            new nicEditor({iconsPath : '<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
js/libs/nicEditorIcons.gif'}).panelInstance('text-edit-1');
        });
    
    <?php echo '</script'; ?>
>
    

<form action=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminExercise:add"),$_smarty_tpl);?>
 method="post">
    Nazev: <input type="text" name="name"><br>
    Poradi: <input type="number" name="order"><br>
    Popis: <textarea id="text-edit-1" rows=20 cols=160 name="desc" style="width: 400px;"></textarea><br>
    Typ: <input type="number" name="type"><br>
    Video: <input type="text" name="video"><br>
    <?php echo SmartyBinder::printFormSelect(array('name'=>"dayId",'data'=>$_smarty_tpl->tpl_vars['days']->value),$_smarty_tpl);?>
<br>
    <input type="submit" name="submit" class="btn success">
</form>

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminDay:showDay",'id'=>$_smarty_tpl->tpl_vars['dayId']->value),$_smarty_tpl);?>
 class="btn info">zpatky</a><?php }
}
