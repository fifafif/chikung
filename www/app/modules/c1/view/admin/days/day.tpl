<h2>Day - {$day->name}</h2>

<p>{$day->description}</p>

<h3>Cviky</h3>


{if $exercises|@count gt 0}
<ul>
{foreach from=$exercises item=exercise}
    <li><a href={link a="c1:admin:AdminExercise:show" id={$exercise->id}}>{$exercise->name}</li>
{/foreach}
</ul>
{/if}


<hr />

<a href={link a="c1:admin:AdminCourse:default"} class="btn info">zpatky</a>
<a href={link a="c1:admin:AdminExercise:showAdd" dayId=$day->id}class="btn success">pridat cvik</a>
<a href={link a="c1:admin:AdminDay:showEdit" id=$day->id}class="btn info">editovat</a>
<a href={link a="c1:admin:AdminDay:delete" id=$day->id} onclick="return confirm('Opravdu smazat?');" class="btn danger">smazat</a>
