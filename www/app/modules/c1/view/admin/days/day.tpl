<h2>Day - {$day->name}</h2>

<p>{$day->description}</p>

<h3>Cviky</h3>

<a href={link a="c1:admin:AdminCourse:default"}>zpatky</a>
<a href={link a="c1:admin:AdminExercise:showAdd" dayId=$day->id}>pridat cvik</a>
<a href={link a="c1:admin:AdminDay:showEdit" id=$day->id}>editovat</a>
<a href={link a="c1:admin:AdminDay:delete" id=$day->id} onclick="return confirm('Opravdu smazat?');">smazat</a>

<hr />

{if $exercises|@count gt 0}
<ul>
{foreach from=$exercises item=exercise}
    <li><a href={link a="c1:admin:AdminExercise:show" id={$exercise->id}}>{$exercise->name}</li>
{/foreach}
</ul>
{/if}

