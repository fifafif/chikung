<?php
/* Smarty version 3.1.29, created on 2016-03-15 19:56:54
  from "D:\Projects\chikung\www\app\apps\modules\main\view\templates\admin\exercise\exercise-add.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56e85af63c1260_02776887',
  'file_dependency' => 
  array (
    '4c072170e37a096a1caa3e4372953e19e9b8ab63' => 
    array (
      0 => 'D:\\Projects\\chikung\\www\\app\\apps\\modules\\main\\view\\templates\\admin\\exercise\\exercise-add.tpl',
      1 => 1458068208,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56e85af63c1260_02776887 ($_smarty_tpl) {
?>

<h2>Nove cviceni</h2>
    <form action="<?php echo $_smarty_tpl->tpl_vars['root']->value;?>
admin/cviceni-nove/" method="post">
        Nazev: <input type="text" name="name"><br>
        Popis: <input type="text" name="description"><br>
        <input type="submit" name="submit">
    </form>
    <?php }
}
