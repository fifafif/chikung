<h2>Pridat cvik</h2>

{literal}
    <script type="text/javascript">
        
        bkLib.onDomLoaded(function() 
        {
            new nicEditor({iconsPath : '{/literal}{$root}{literal}js/libs/nicEditorIcons.gif'}).panelInstance('text-edit-1');
        });
    
    </script>
{/literal}

<form action={link a="c1:admin:AdminExercise:add"} method="post">
    Nazev: <input type="text" name="name"><br>
    Poradi: <input type="number" name="order"><br>
    Popis: <textarea id="text-edit-1" rows=20 cols=160 name="desc" style="width: 400px;"></textarea><br>
    Typ: <input type="number" name="type"><br>
    Video: <input type="text" name="video"><br>
    {form_select name="dayId" data=$days}<br>
    <input type="submit" name="submit" class="btn-green">
</form>

<a href={link a="c1:admin:AdminDay:showDay" id=$dayId} class="btn-grey">zpatky</a>