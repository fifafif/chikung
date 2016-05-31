<h2>Days</h2>

<{a href="c1:admin:AdminDay:showAdd"}>Add new day</a>            

{if $days|@count gt 0}
<ul>
{foreach from=$days item=day}
    <li><{a href="c1:admin:AdminDay:showDay" day=$day->id}>
        {$day->name} 
        </a>            
    </li>
{/foreach}
</ul>
{/if}