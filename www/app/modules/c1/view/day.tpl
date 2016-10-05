<h2>Den - {$day->name}</h2>

<p>{$day->description}</p>

<h3>Cviky</h3>

{if $exercises|@count gt 0}
<ul>
{foreach from=$exercises item=exercise}
    <li><a href={link a="c1:Course:showExercise" id={$exercise->id}}>{$exercise->name}</li>
{/foreach}
</ul>
{/if}

<hr />

{if $isCompleted}
    <a href={link a="c1:Course:uncompleteDay" id=$day->id} class="btn-red" onclick="return confirm('Nepslnili jste?');">oznacit jako nesplneny</a>
{else}
    <a href={link a="c1:Course:completeDay" id=$day->id} class="btn-green" onclick="return confirm('Opravdu jste splnili?');">splnit den</a>
{/if}

<a href={link a="c1::Course:showAllDays"} class="btn-grey">zpatky</a>


