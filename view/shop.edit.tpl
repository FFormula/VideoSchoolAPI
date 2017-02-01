{include file="head.tpl"}

<a href="/show/edit/new">add new item</a>

<form method="post" action="/shop/edit/{$info.packet_id}">

    ID: <tt>{$info.packet_id}</tt><br/>
    Name: <input type="text" name="name" value="{$info.name}" /><br/>
    Info: <textarea name="info" cols="80">{$info.info}</textarea><br/>
    HTML: <textarea name="html" cols="80">{$info.html}</textarea><br/>
    Price:<input type="text" name="price" value="{$info.price}" /><br/>
    <input type="submit" value="save" />

</form>

{include file="tail.tpl"}