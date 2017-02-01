{include file="head.tpl"}

<table>
    <tr>
        <th>Packet</th>
        <th>Info</th>
        <th>Price</th>
    </tr>
    {foreach from=$info.rows item=row}
    <tr>
        <td>{$row.packet_id}</td>
        <td>{$row.name} - {$row.info}</td>
        <td>{$row.price}</td>
    </tr>
</table>

{include file="tail.tpl"}