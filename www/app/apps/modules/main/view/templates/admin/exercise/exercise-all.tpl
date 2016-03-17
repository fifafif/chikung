
{if $exercises|@count gt 0}
    <ul>
    {foreach from=$exercises item=$exercise}
        <li>{$exercise->id} - {$exercise->name}</li>
    {/foreach}
    </ul>
    {/if}