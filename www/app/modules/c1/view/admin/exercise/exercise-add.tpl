<h2>Pridat cvik</h2>


<form action={link a="c1:admin:AdminExercise:add"} method="post">
    Nazev: <input type="text" name="name"><br>
    Poradi: <input type="number" name="order"><br>
    Popis: <textarea rows=4 cols=80 name="desc"></textarea><br>
    Typ: <input type="number" name="type"><br>
    Video: <input type="text" name="video"><br>
    {form_select name="dayId" data=$days}<br>
    <input type="submit" name="submit" class="btn-green">
</form>

<a href={link a="c1:admin:AdminDay:showDay" id=$dayId} class="btn-grey">zpatky</a>