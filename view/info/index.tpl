{include file="head.tpl"}

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
            <h3 class="panel-title">{$lang->word("info.bad drivers database")}</h3>
        </div>
        <div class="panel-body">
            <h3>{$lang->word("info.project mission")}</h3>
            {$lang->word("info.project description")}
        </div>
    </div>
    <br/><br/>
</div>

{include file="tail.tpl"}