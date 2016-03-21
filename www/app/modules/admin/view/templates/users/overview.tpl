<h2>Users overview</h2>


{if $users|@count gt 0}
<ul>
{foreach from=$users item=user}
    <li>{$user->id} - {$user->username}</li>
{/foreach}
</ul>
{else}
no users
{/if}


{if $userData|@count gt 0}
<ul>
{foreach from=$userData item=user}
    <li>{$user['user']->id} - {$user['courses']->id}</li>
{/foreach}
</ul>
{else}
no users
{/if}