<?php
/* Smarty version 3.1.29, created on 2016-10-07 17:13:49
  from "C:\projects\Chikung\chikung\www\app\modules\c1\view\exercise.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57f7d7cd54d9b9_42875926',
  'file_dependency' => 
  array (
    '8567fab0edb8ad9ffc2a79491caac86a13d4a266' => 
    array (
      0 => 'C:\\projects\\Chikung\\chikung\\www\\app\\modules\\c1\\view\\exercise.tpl',
      1 => 1475860422,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57f7d7cd54d9b9_42875926 ($_smarty_tpl) {
?>
<h2>Cvik - <?php echo $_smarty_tpl->tpl_vars['exercise']->value->name;?>
</h2>

<p><?php echo $_smarty_tpl->tpl_vars['exercise']->value->description;?>
</p>

<p>
    <iframe width="560" height="315" src="<?php echo $_smarty_tpl->tpl_vars['exercise']->value->video;?>
" frameborder="0" allowfullscreen></iframe>
    
    <!-- <iframe src="https://player.vimeo.com/video/180548609?badge=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></p> -->
</p>

<hr />

<a href=<?php echo SmartyBinder::printSmartyLink(array('a'=>"c1::Course:showDay",'id'=>$_smarty_tpl->tpl_vars['exercise']->value->c1day_id),$_smarty_tpl);?>
 class="btn-grey">zpatky</a><?php }
}
