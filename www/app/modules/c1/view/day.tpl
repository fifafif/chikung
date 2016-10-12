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

{if $prevDayId != -1}
    <a href={link a="c1:Course:showDay" id=$prevDayId} class="btn info">&Lt; Predchozi den</a>
{/if}

{if $nextDayId != -1}
    <a href={link a="c1:Course:showDay" id=$nextDayId} class="btn info">Dalsi den &Gt;</a>
{/if}

<hr />

{if $isCompleted}
    <a href={link a="c1:Course:uncompleteDay" id=$day->id} class="btn danger" onclick="return confirm('Nepslnili jste?');">oznacit jako nesplneny</a>
{else}
    <a href={link a="c1:Course:completeDay" id=$day->id} class="btn success" onclick="return confirm('Opravdu jste splnili?');">splnit den</a>
{/if}

<a href={link a="c1::Course:showAllDays"} class="btn info">zpatky</a>


