<?php
/* Smarty version 3.1.31, created on 2017-02-23 11:40:10
  from "G:\GIT\VideoSchoolAPI\view\menu.demo.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_58ae9fea9cf177_43208151',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c45dec63548bd008d6f8a70ee61faefb1621c702' => 
    array (
      0 => 'G:\\GIT\\VideoSchoolAPI\\view\\menu.demo.tpl',
      1 => 1487837875,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58ae9fea9cf177_43208151 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="row">
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target="#MyTopMenu" >
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="MyTopMenu">
                    <ul class="nav navbar-nav">
                        <li<?php if ($_smarty_tpl->tpl_vars['arr']->value['menu'] == "info/index") {?> class="active"<?php }?>>
                            <a href="/info/index" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value["HOME"];?>
">
                                <i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['lang']->value["HOME"];?>
</a>
                        </li>
                        <li<?php if ($_smarty_tpl->tpl_vars['arr']->value['menu'] == "user/insert") {?> class="active"<?php }?>>
                           <a href="/user/insert" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value["JOIN"];?>
">
                               <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['lang']->value["JOIN"];?>

                            </a>
                        </li>
                        <li>
                           <a href="/ru" title="По-русски">
                               &nbsp;&nbsp;По-русски
                           </a>
                        </li>
                        <li>
                           <a href="/en" title="English">
                               </i>&nbsp;&nbsp;English
                           </a>
                        </li>
                        <li>
                           <a href="/lt" title="По-литовски">
                               </i>&nbsp;&nbsp;Lietuviškai
                           </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li<?php if ($_smarty_tpl->tpl_vars['arr']->value['menu'] == "user/login") {?> class="active"<?php }?>>
                            <a href="/user/login" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value["LOGIN"];?>
">
                                <i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['lang']->value["LOGIN"];?>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
}
