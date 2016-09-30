<h2>Days</h2>

<{a href="c1:admin:AdminDay:showAdd"}>pridat den</a>
<{a href="c1:admin:AdminExercise:showAll"}>zobrazit vsechny cviky</a>

{if $days|@count gt 0}
<ul>
{foreach from=$days item=day}
    <li><{a href="c1:admin:AdminDay:showDay" id=$day->id}>
        {$day->name} 
        </a>            
    </li>
{/foreach}
</ul>
{/if}