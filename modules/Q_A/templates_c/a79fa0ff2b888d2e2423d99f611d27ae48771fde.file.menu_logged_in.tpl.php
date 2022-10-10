<?php /* Smarty version Smarty-3.1.15, created on 2015-06-07 13:25:44
         compiled from "/opt/lbaw/lbaw1414/public_html/final/templates/common/menu_logged_in.tpl" */ ?>
<?php /*%%SmartyHeaderCode:34719115557412fb8b82e3-69066599%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a79fa0ff2b888d2e2423d99f611d27ae48771fde' => 
    array (
      0 => '/opt/lbaw/lbaw1414/public_html/final/templates/common/menu_logged_in.tpl',
      1 => 1433676336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34719115557412fb8b82e3-69066599',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_557412fb8c9c05_00060472',
  'variables' => 
  array (
    'BASE_URL' => 0,
    'USERNAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557412fb8c9c05_00060472')) {function content_557412fb8c9c05_00060472($_smarty_tpl) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/registered_user/own_profile.php">Logged in as <?php echo $_smarty_tpl->tpl_vars['USERNAME']->value;?>
</a></li>
<li><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/registered_user/logout.php">Logout</a></li>
<?php }} ?>
