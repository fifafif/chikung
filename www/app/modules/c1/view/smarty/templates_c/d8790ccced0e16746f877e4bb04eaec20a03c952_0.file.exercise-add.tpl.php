<?php
/* Smarty version 3.1.29, created on 2016-09-30 23:27:40
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\admin\exercise\exercise-add.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eef4ecb3ffa3_70687226',
  'file_dependency' => 
  array (
    'd8790ccced0e16746f877e4bb04eaec20a03c952' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\admin\\exercise\\exercise-add.tpl',
      1 => 1475277885,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57eef4ecb3ffa3_70687226 ($_smarty_tpl) {
?>
<h2>Pridat cvik</h2>

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminDay:showDay",'id'=>$_smarty_tpl->tpl_vars['dayId']->value),$_smarty_tpl);?>
>zpatky</a>

<form action=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminExercise:add"),$_smarty_tpl);?>
 method="post">
    Nazev: <input type="text" name="name"><br>
    Poradi: <input type="number" name="order"><br>
    Popis: <textarea rows=4 cols=80 name="desc"></textarea><br>
    Typ: <input type="number" name="type"><br>
    Video: <input type="text" name="video"><br>
    <?php echo SmartyBinder::printFormSelect(array('name'=>"dayId",'data'=>$_smarty_tpl->tpl_vars['days']->value),$_smarty_tpl);?>

    <input type="submit" name="submit">
</form><?php }
}
