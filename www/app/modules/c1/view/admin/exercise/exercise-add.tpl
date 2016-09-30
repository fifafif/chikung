<h2>Pridat cvik</h2>

<a href={link a="c1:admin:AdminDay:showDay" id=$dayId}>zpatky</a>

<form action={link a="c1:admin:AdminExercise:add"} method="post">
    Nazev: <input type="text" name="name"><br>
    Poradi: <input type="number" name="order"><br>
    Popis: <textarea rows=4 cols=80 name="desc"></textarea><br>
    Typ: <input type="number" name="type"><br>
    Video: <input type="text" name="video"><br>
    {form_select name="dayId" data=$days}
    <input type="submit" name="submit">
</form>