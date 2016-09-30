<h2>Upravit cvik</h2>

<a href={link a="c1:admin:AdminExercise:show" id=$exercise->id}>Zrusit</a>

<form action={link a="c1:admin:AdminExercise:edit" id=$exercise->id} method="post">
    Nazev: <input type="text" name="name" value={$exercise->name}><br>
    Poradi: <input type="number" name="order" value="to do"><br>
    Popis: <textarea rows=4 cols=80 name="desc">{$exercise->description}</textarea><br>
    Typ: <input type="number" name="type" value={$exercise->type}><br>
    Video: <input type="text" name="video" value={$exercise->video}><br>
    {form_select name="dayId" data=$days}
    <input type="submit" name="submit">
</form>
    
    
