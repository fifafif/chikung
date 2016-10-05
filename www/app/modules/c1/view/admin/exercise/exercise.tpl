<h2>Cvik - {$exercise->name}</h2>

<br>

{$exercise->id} - {$exercise->name}
<br>
{$exercise->description}

<hr />

{if isset($day) && $day != false}
    
    <h3>Den - {$day->name}</h3>

    <a href={link a="c1:admin:AdminDay:showDay" id=$day->id} class="btn-grey">zpatky</a>
    <a href={link a="c1:admin:AdminExercise:showEdit" id=$exercise->id dayId=$day->id} class="btn-grey">editovat</a>
    
{else}
    
    <h3>Tento cvik neni prirazen ke dnu!</h3>
    
    <a href={link a="c1:admin:AdminExercise:showAll"} class="btn-grey">zpatky</a>
    <a href={link a="c1:admin:AdminExercise:showEdit" id=$exercise->id} class="btn-grey">editovat</a>
    
{/if}

    <a href={link a="c1:admin:AdminExercise:delete" id=$exercise->id} class="btn-red">smazat</a>

