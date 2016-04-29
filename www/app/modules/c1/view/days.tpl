<h2>Days</h2>


{if $days|@count gt 0}
<ul>
{foreach from=$days item=day}
    <li><{a href="c1:course:showDay" day=$day["day"]->id}>
        {$day["day"]->name} 
        {if isset($day["progress"])} completed {/if}
        </a>
            
    </li>
{/foreach}
</ul>
{/if}