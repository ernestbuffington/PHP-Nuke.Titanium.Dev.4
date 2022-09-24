<?php /* Smarty version Smarty-3.1.15, created on 2015-06-07 14:31:11
         compiled from "/opt/lbaw/lbaw1414/public_html/final/templates/common/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1650987165557412fb856153-88784015%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1606ed79a0293cabba0f40864c45fa3488cbe7d8' => 
    array (
      0 => '/opt/lbaw/lbaw1414/public_html/final/templates/common/header.tpl',
      1 => 1433680268,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1650987165557412fb856153-88784015',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_557412fb863557_60788028',
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557412fb863557_60788028')) {function content_557412fb863557_60788028($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/bootstrap.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
javascript/jquery-2.1.3.min.js"></script>

<script src="https://apis.google.com/js/platform.js" async defer></script>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_PT/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<body>
  <div id="fb-root"></div><?php }} ?>
