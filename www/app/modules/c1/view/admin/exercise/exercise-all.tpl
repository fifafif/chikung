<h2>Vsechny cviky</h2>

{if $exercises|@count gt 0}
<ul>
{foreach from=$exercises item=exercise}
    <li><a href={link a="c1:admin:AdminExercise:show" id={$exercise->id}}>{$exercise->name}</li>
{/foreach}
</ul>
{/if}

<hr />

<a href={link a="c1:admin:AdminCourse:default"} class="btn info">zpatky</a>