<h2>Edit day</h2>

<a href={link a="c1:admin:AdminDay:showDay" id=$day->id}>zpatky</a>

<{form action="c1:admin:AdminDay:edit" id=$day->id} method="post">
    Nazev: <input type="text" name="name" value="{$day->name}"><br>
    Poradi: <input type="number" name="order" value="{$day->order}"><br>
    Popis: <input type="text" name="description" value="{$day->description}"><br>
    <input type="submit" name="submit">
</form>