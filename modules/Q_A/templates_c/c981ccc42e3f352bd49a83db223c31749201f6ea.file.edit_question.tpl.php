<?php /* Smarty version Smarty-3.1.15, created on 2015-06-07 13:25:54
         compiled from "/opt/lbaw/lbaw1414/public_html/final/templates/question/edit_question.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18712486485574267581ad61-86905719%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c981ccc42e3f352bd49a83db223c31749201f6ea' => 
    array (
      0 => '/opt/lbaw/lbaw1414/public_html/final/templates/question/edit_question.tpl',
      1 => 1433676336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18712486485574267581ad61-86905719',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_557426758e3bd6_46779811',
  'variables' => 
  array (
    'question' => 0,
    'tags' => 0,
    'tag' => 0,
    'createdUser' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557426758e3bd6_46779811')) {function content_557426758e3bd6_46779811($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('common/navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-1">
      <div class="pull-right">
        <div><a href="#" class="btn btn-success btn-sm active"><i class="fa fa-chevron-up"></i></a></div>
        <span class="text-success"><strong>+1</strong></span>
        <div><a href="#" class="btn btn-danger btn-sm"><i class="fa fa-chevron-down"></i></a></div>
      </div>
    </div>
    <div class="col-lg-6">
      <ul class="list-group">
        <div >Title</div>
          <input class="form-control" name="name" value="<?php echo $_smarty_tpl->tpl_vars['question']->value['title'];?>
" type="text">
          <hr/>
          <div >Details</div>
          <input class="form-control" name="name" value="<?php echo $_smarty_tpl->tpl_vars['question']->value['content'];?>
" type="text">
          <hr/>
          <div class="row">
            <div class="col-lg-8">
              <span class="text-muted">Tags: </span>
              <?php  $_smarty_tpl->tpl_vars['tag'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tag']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tags']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tag']->key => $_smarty_tpl->tpl_vars['tag']->value) {
$_smarty_tpl->tpl_vars['tag']->_loop = true;
?>
                <span class="label label-info"><?php echo $_smarty_tpl->tpl_vars['tag']->value['name'];?>
</span>
              <?php } ?>
            </div>
            <div class="col-lg-4">
              <p class="list-group-item-text text-muted pull-right"><small>Submitted by: <?php echo $_smarty_tpl->tpl_vars['createdUser']->value['username'];?>
</small></p>
            </div>
          </div>
        <button href="#" type="button" class="pull-right" >Submit</button>
      </ul>
    </div>
  </div>
</div> <!-- end container-->

<?php echo $_smarty_tpl->getSubTemplate ('common/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
