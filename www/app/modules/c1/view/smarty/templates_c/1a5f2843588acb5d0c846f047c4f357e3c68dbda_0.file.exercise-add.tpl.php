<?php
/* Smarty version 3.1.29, created on 2016-05-04 08:40:23
  from "D:\Projects\chikung\www\app\modules\c1\view\admin\exercise\exercise-add.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57299957105512_69693946',
  'file_dependency' => 
  array (
    '1a5f2843588acb5d0c846f047c4f357e3c68dbda' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\c1\\view\\admin\\exercise\\exercise-add.tpl',
      1 => 1462344014,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57299957105512_69693946 ($_smarty_tpl) {
?>
<h2>Pridat cvik</h2>

<form action=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminExercise:add"),$_smarty_tpl);?>
 method="post">
    Nazev: <input type="text" name="name"><br>
    Poradi: <input type="number" name="order"><br>
    Popis: <input type="text" name="desc"><br>
    Typ: <input type="number" name="type"><br>
    Video: <input type="text" name="video"><br>
    <?php echo SmartyBinder::printFormSelect(array('name'=>"dayId",'data'=>$_smarty_tpl->tpl_vars['days']->value),$_smarty_tpl);?>

    <input type="submit" name="submit">
</form><?php }
}
