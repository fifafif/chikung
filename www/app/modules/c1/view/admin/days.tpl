<h2>Seznam dnu</h2>

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

<hr />

<a href={link a="c1:admin:AdminDay:showAdd"} class="btn info">pridat den</a>
<a href={link a="c1:admin:AdminExercise:showAll"} class="btn info">zobrazit vsechny cviky</a>
