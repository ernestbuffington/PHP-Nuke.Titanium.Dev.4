<?php /* Smarty version Smarty-3.1.15, created on 2015-06-07 13:25:44
         compiled from "/opt/lbaw/lbaw1414/public_html/final/templates/question/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1439798237557412ff6885c7-69100910%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ba71765abe23f90ec3f8908c6a8899a9ad21c58' => 
    array (
      0 => '/opt/lbaw/lbaw1414/public_html/final/templates/question/list.tpl',
      1 => 1433676336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1439798237557412ff6885c7-69100910',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_557412ff785994_71657171',
  'variables' => 
  array (
    'BASE_URL' => 0,
    'questions' => 0,
    'question' => 0,
    'numberOfPages' => 0,
    'i' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557412ff785994_71657171')) {function content_557412ff785994_71657171($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('common/navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="container-fluid">
  </div class="row">
    <div class="col-lg-12">
      <div class="btn-group-vertical pull-right">
        <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/question/create.php" class="btn btn-default">+</a>
      </div>
    </div>
    <div class="col-lg-12">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Rating</th>
            <th>Question</th>
            <th>Number of Answers</th>
            <th>Author</th>
          </tr>
        </thead>
        <tbody>
          <?php  $_smarty_tpl->tpl_vars['question'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['question']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['questions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['question']->key => $_smarty_tpl->tpl_vars['question']->value) {
$_smarty_tpl->tpl_vars['question']->_loop = true;
?>
          <tr>
            <td><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/question/view.php?id=<?php echo $_smarty_tpl->tpl_vars['question']->value['questionid'];?>
"><?php echo $_smarty_tpl->tpl_vars['question']->value['questionid'];?>
<a></td>
            <td>1</td>
            <td><?php echo $_smarty_tpl->tpl_vars['question']->value['content'];?>
</td>
            <td>0</td>
            <td><?php echo $_smarty_tpl->tpl_vars['question']->value['createdby'];?>
</td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="col-lg-12">
      <div class="primary pull-right">
           <ul class="pagination">
   		  <li class="disabled"><a href="#"><</a></li>
        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['numberOfPages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['numberOfPages']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
          <li <?php if ($_smarty_tpl->tpl_vars['i']->value==$_smarty_tpl->tpl_vars['page']->value) {?>class="active" <?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/question/list.php?page=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a></li>
        <?php }} ?>
   		  <li><a href="#">></a></li>
   		</ul>
       </div>
    </div>
  </div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('common/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
