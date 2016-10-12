<?php
/* Smarty version 3.1.29, created on 2016-10-05 04:40:13
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\admin\days\day-add.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f4842d13b541_24094891',
  'file_dependency' => 
  array (
    '92d5d808356339139ffbde8a27ddb275cafe2e43' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\admin\\days\\day-add.tpl',
      1 => 1475642319,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f4842d13b541_24094891 ($_smarty_tpl) {
?>
<h2>Add new day</h2>

<form action=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminDay:add"),$_smarty_tpl);?>
 method="post">
    Nazev: <input type="text" name="name"><br>
    Poradi: <input type="number" name="order"><br>
    Popis: <textarea rows=4 cols=80 name="description"></textarea><br>
    <input type="submit" name="submit" class="btn success">
</form>
    
<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminCourse:default"),$_smarty_tpl);?>
 class="btn info">zpatky</a><?php }
}
