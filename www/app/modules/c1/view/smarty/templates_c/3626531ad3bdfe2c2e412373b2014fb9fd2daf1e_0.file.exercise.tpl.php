<?php
/* Smarty version 3.1.29, created on 2016-09-30 23:33:50
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\admin\exercise\exercise.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eef65e4fc3f4_51085136',
  'file_dependency' => 
  array (
    '3626531ad3bdfe2c2e412373b2014fb9fd2daf1e' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\admin\\exercise\\exercise.tpl',
      1 => 1475278425,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57eef65e4fc3f4_51085136 ($_smarty_tpl) {
?>
<h2>Cvik - <?php echo $_smarty_tpl->tpl_vars['exercise']->value->name;?>
</h2>

<?php if (isset($_smarty_tpl->tpl_vars['day']->value) && $_smarty_tpl->tpl_vars['day']->value != false) {?>
    
    <h3>Den - <?php echo $_smarty_tpl->tpl_vars['day']->value->name;?>
</h3>

    <a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminDay:showDay",'id'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
>zpatky</a>
    <a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminExercise:showEdit",'id'=>$_smarty_tpl->tpl_vars['exercise']->value->id,'dayId'=>$_smarty_tpl->tpl_vars['day']->value->id),$_smarty_tpl);?>
>editovat</a>
    
<?php } else { ?>
    
    <h3>Tento cvik neni prirazen ke dnu!</h3>
    
    <a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminExercise:showAll"),$_smarty_tpl);?>
>zpatky</a>
    <a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminExercise:showEdit",'id'=>$_smarty_tpl->tpl_vars['exercise']->value->id),$_smarty_tpl);?>
>editovat</a>
    
<?php }?>

    <a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1:admin:AdminExercise:delete",'id'=>$_smarty_tpl->tpl_vars['exercise']->value->id),$_smarty_tpl);?>
>smazat</a>

<br>

<?php echo $_smarty_tpl->tpl_vars['exercise']->value->id;?>
 - <?php echo $_smarty_tpl->tpl_vars['exercise']->value->name;?>

<br>
<?php echo $_smarty_tpl->tpl_vars['exercise']->value->description;?>


<?php }
}
