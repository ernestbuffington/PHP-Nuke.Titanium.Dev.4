<?php /* Smarty version Smarty-3.1.15, created on 2015-06-07 13:25:44
         compiled from "/opt/lbaw/lbaw1414/public_html/final/templates/common/login_modal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1052572938557412fb89e383-15641034%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b9a019a49492c70b65f5e8ca2ac7ac8ce816e11' => 
    array (
      0 => '/opt/lbaw/lbaw1414/public_html/final/templates/common/login_modal.tpl',
      1 => 1433676336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1052572938557412fb89e383-15641034',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_557412fb8a7881_50539001',
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557412fb8a7881_50539001')) {function content_557412fb8a7881_50539001($_smarty_tpl) {?><div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Log in</h4>
      </div>
      <form class="form-horizontal" method="POST" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/registered_user/login.php">
        <div class="modal-body">
          <fieldset>
            <div class="form-group">
              <label for="inputEmail" class="col-lg-2 control-label">Email</label>
              <div class="col-lg-10">
                <input class="form-control" id="inputEmail" name="email" placeholder="Email" type="text">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword" class="col-lg-2 control-label">Password</label>
              <div class="col-lg-10">
                <input class="form-control" id="inputPassword" name="password" placeholder="Password" type="password">
              </div>
            </div>
          </fieldset>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Log in</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php }} ?>
