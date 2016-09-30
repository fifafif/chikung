<h2>Cvik - {$exercise->name}</h2>

{if isset($day) && $day != false}
    
    <h3>Den - {$day->name}</h3>

    <a href={link a="c1:admin:AdminDay:showDay" id=$day->id}>zpatky</a>
    <a href={link a="c1:admin:AdminExercise:showEdit" id=$exercise->id dayId=$day->id}>editovat</a>
    
{else}
    
    <h3>Tento cvik neni prirazen ke dnu!</h3>
    
    <a href={link a="c1:admin:AdminExercise:showAll"}>zpatky</a>
    <a href={link a="c1:admin:AdminExercise:showEdit" id=$exercise->id}>editovat</a>
    
{/if}

    <a href={link a="c1:admin:AdminExercise:delete" id=$exercise->id}>smazat</a>

<br>

{$exercise->id} - {$exercise->name}
<br>
{$exercise->description}

