<ul>
{foreach from=$info.menu->items key=key item=item}
    <li><a href="{$item->url}">{$item->text}</a></li>
{/foreach}
    <li>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$info.menu->right->url}">{$info.menu->right->text}</a></li>
</ul>