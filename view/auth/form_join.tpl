{include file='div/head.tpl'}
{include file='div/menu.tpl'}
<br/>
<blockquote>
    <form method="post">
        {if $err}
            <b>{$err}</b><br/>
        {/if}
        Эл. почта: <input type="text" name="email" value="{$arr.email}" /> <br/>
        Логин-имя: <input type="text" name="name" value="{$arr.name}" /> <br/>
        Пароль: <input type="text" name="password" value="" /> <br/>
        <input type="submit" value="Зарегистрироваться" />
    </form>
</blockquote>
{include file='div/tail.tpl'}
{include file='div/stop.tpl'}