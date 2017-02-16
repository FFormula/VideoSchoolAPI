{include file='div/head.tpl'}
{include file='div/menu.tpl'}
<br/>
<blockquote>
    <form method="post">
        {if $err}
            <b>{$err}</b><br/>
        {/if}
        Эл. почта: <input type="text" name="email" value="{$arr.email}" /> <br/>
        Пароль: <input type="password" name="password" value="" /> <br/>
        <input type="submit" value="Войти" />
    </form>
</blockquote>
{include file='div/tail.tpl'}
{include file='div/stop.tpl'}