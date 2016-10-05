<?php
/* Smarty version 3.1.29, created on 2016-10-05 04:40:41
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\admin\exercise\exercise-edit.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f484490332b9_73762871',
  'file_dependency' => 
  array (
    'cdf9c8d382aebd0246302fb58d06fe2feae1c713' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\admin\\exercise\\exercise-edit.tpl',
      1 => 1475642355,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f484490332b9_73762871 ($_smarty_tpl) {
?>
<h2>Upravit cvik</h2>

<form action=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminExercise:edit",'id'=>$_smarty_tpl->tpl_vars['exercise']->value->id),$_smarty_tpl);?>
 method="post">
    Nazev: <input type="text" name="name" value=<?php echo $_smarty_tpl->tpl_vars['exercise']->value->name;?>
><br>
    Poradi: <input type="number" name="order" value="to do"><br>
    Popis: <textarea rows=4 cols=80 name="desc"><?php echo $_smarty_tpl->tpl_vars['exercise']->value->description;?>
</textarea><br>
    Typ: <input type="number" name="type" value=<?php echo $_smarty_tpl->tpl_vars['exercise']->value->type;?>
><br>
    Video: <input type="text" name="video" value=<?php echo $_smarty_tpl->tpl_vars['exercise']->value->video;?>
><br>
    <?php echo SmartyBinder::printFormSelect(array('name'=>"dayId",'data'=>$_smarty_tpl->tpl_vars['days']->value),$_smarty_tpl);?>

    <input type="submit" name="submit" class="btn-green">
</form>

    
<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminExercise:show",'id'=>$_smarty_tpl->tpl_vars['exercise']->value->id),$_smarty_tpl);?>
 class="btn-grey">Zrusit</a>
    
<?php }
}
