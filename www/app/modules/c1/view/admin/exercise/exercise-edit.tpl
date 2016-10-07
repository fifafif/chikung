{literal}
    <script type="text/javascript">
        
        bkLib.onDomLoaded(function() 
        {
            new nicEditor({iconsPath : '{/literal}{$root}{literal}js/libs/nicEditorIcons.gif'}).panelInstance('text-edit-1');
        });
    
    </script>
{/literal}

<h2>Upravit cvik</h2>

<form action={link a="c1:admin:AdminExercise:edit" id=$exercise->id} method="post">
    Nazev: <input type="text" name="name" value={$exercise->name}><br>
    Poradi: <input type="number" name="order" value="to do"><br>
    Popis: <textarea id="text-edit-1" class="span6" rows=20 cols=80 name="desc">{$exercise->description}</textarea><br>
    Typ: <input type="number" name="type" value={$exercise->type}><br>
    Video: <input type="text" name="video" value={$exercise->video}><br>
    {form_select name="dayId" data=$days}
    <input type="submit" name="submit" class="btn-green">
</form>

    
<a href={link a="c1:admin:AdminExercise:show" id=$exercise->id} class="btn-grey">Zrusit</a>
    
