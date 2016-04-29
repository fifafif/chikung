<h2>Days</h2>


{if $days|@count gt 0}
<ul>
{foreach from=$days item=day}
    <li><{a href="c1:admin:adminCourse:showDay" day=$day->id}>
        {$day->name} 
        </a>            
    </li>
{/foreach}
</ul>
{/if}