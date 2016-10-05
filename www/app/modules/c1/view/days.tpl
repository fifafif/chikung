<h2>Seznam dnu</h2>


{if $days|@count gt 0}
<ul>
{foreach from=$days item=day}
    <li><{a href="c1:Course:showDay" id=$day["day"]->id}>
        {$day["day"]->name} 
        
        </a>
        
        {if isset($day["progress"])} [dokoncen] {/if}
            
    </li>
{/foreach}
</ul>
{/if}

<h3>Progress</h3>
{$completedDaysCount} / {$days|@count}