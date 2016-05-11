<?php
/* Smarty version 3.1.29, created on 2016-05-11 06:54:26
  from "D:\Projects\chikung\www\app\modules\c1\view\admin\days\day-add.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5732bb022beab5_72649813',
  'file_dependency' => 
  array (
    '2404fa8829b7d1cacac9101e12c85e5983b9052f' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\modules\\c1\\view\\admin\\days\\day-add.tpl',
      1 => 1462941794,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5732bb022beab5_72649813 ($_smarty_tpl) {
?>
<h2>Add new day</h2>

<<?php echo SmartyBinder::printSmartyForm(array('action'=>"c1:admin:AdminDay:add"),$_smarty_tpl);?>
 method="post">
    Nazev: <input type="text" name="name"><br>
    Poradi: <input type="number" name="order"><br>
    Popis: <input type="text" name="description"><br>
    <input type="submit" name="submit">
</form><?php }
}
