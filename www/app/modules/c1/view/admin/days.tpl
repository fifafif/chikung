<h2>Days</h2>

<{a href="c1:admin:adminDay:showAdd"}>Add new day</a>            

{if $days|@count gt 0}
<ul>
{foreach from=$days item=day}
    <li><{a href="c1:admin:adminDay:showDay" day=$day->id}>
        {$day->name} 
        </a>            
    </li>
{/foreach}
</ul>
{/if}