<?php
/* Smarty version 3.1.31, created on 2017-02-23 11:40:10
  from "G:\GIT\VideoSchoolAPI\view\info\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_58ae9fea9664a5_47974089',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '345627a089fe0a946b7876ae1f033073d6f95109' => 
    array (
      0 => 'G:\\GIT\\VideoSchoolAPI\\view\\info\\index.tpl',
      1 => 1487837875,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:tail.tpl' => 1,
  ),
),false)) {
function content_58ae9fea9664a5_47974089 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<style>
    .yt-container {
        position:relative;
        padding-bottom:56.25%;
        padding-top:30px;
        height:0;
        overflow:hidden;
    }

    .yt-container iframe, .yt-container object, .yt-container embed {
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
    }
</style>
<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">База неблагоприятных Водителей</h3>
        </div>
        <div class="panel-body">
            <h3>Цель проекта</h3>
            Проект был создан с целью упрощения работы автопарков и повышения их безопасности.
            <br/>
            Цель проекта — объединить в одном месте всех неблагоприятных водителей,
            <br/>
            которые по тем или иным причинам попали в черные списки отдельных парков.
            <br/>
            <h3>Видеоинструкция для новых пользователей</h3>
            <div class="yt-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/b_kJDVN1J5U?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
            </div>
            <br/><br/>
            У каждого парка есть возможность зарегистрироваться<br/>
            и самостоятельно вносить в базу данные водителей,<br/>
            которые оставили негативное впечатление о себе после работы в вашем парке.
            <br/><br/>
            При этом каждый парк после регистрации сможет<br/>
            воспользоваться поиском и проверить нового водителя,<br/>
            который пришел к вам устраиваться на работу,<br/>
            на наличие судимостей, либо наличие долгов в том парке, где он работал ранее.
            <br/><br/>
            Таким образом, провинившиеся водители не смогут<br/>
            устроиться на работу в новый парк, не закрыв<br/>
            свои долги перед предыдущим арендодателем.
        </div>
    </div>
    <br/><br/>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:tail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
