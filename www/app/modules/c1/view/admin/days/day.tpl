<h2>Day - {$day->name}</h2>

<p>{$day->description}</p>

<h3>Cviky</h3>

<{a href="c1:admin:AdminExercise:showAdd"}>pridat cvik</a>
<a href={link a="c1:admin:AdminDay:showEdit" day=$day->id}>editovat</a>
<a href={link a="c1:admin:AdminDay:delete" day=$day->id} onclick="return confirm('Opravdu smazat?');">smazat</a>

{if $exercises|@count gt 0}
<ul>
{foreach from=$exercises item=exercise}
    <li>{$exercise->id} - {$exercise->name}</li>
{/foreach}
</ul>
{/if}

