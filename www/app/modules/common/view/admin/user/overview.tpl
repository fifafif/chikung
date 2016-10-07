<h2>Users overview</h2>


{if $users|@count gt 0}
<ul>
{foreach from=$users item=user}
    <li><a href={link a="common:admin:AdminUser:show" id=$user->id}>{$user->id} - {$user->username}</a></li>
{/foreach}
</ul>
{else}
no users
{/if}

{*
{if $userData|@count gt 0}
<ul>
{foreach from=$userData item=user}
    <li>{$user['user']->id} - {$user['courses']}</li>
{/foreach}
</ul>
{else}
no users
{/if}
*}