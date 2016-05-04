<h2>Pridat cvik</h2>

<form action={link a="c1:admin:AdminExercise:add"} method="post">
    Nazev: <input type="text" name="name"><br>
    Poradi: <input type="number" name="order"><br>
    Popis: <input type="text" name="desc"><br>
    Typ: <input type="number" name="type"><br>
    Video: <input type="text" name="video"><br>
    {form_select name="dayId" data=$days}
    <input type="submit" name="submit">
</form>