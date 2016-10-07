{literal}
    <script type="text/javascript">
        
        bkLib.onDomLoaded(function() 
        {
            new nicEditor({iconsPath : '{/literal}{$root}{literal}js/libs/nicEditorIcons.gif'}).panelInstance('text-edit-1');
        });
    
    </script>
{/literal}

<h2>Edit day</h2>

<a href={link a="c1:admin:AdminDay:showDay" id=$day->id} class="btn-grey">zpatky</a>

<form action={link a="c1:admin:AdminDay:edit" id=$day->id} method="post">
    Nazev: <input type="text" name="name" value="{$day->name}"><br>
    Poradi: <input type="number" name="order" value="{$day->order}"><br>
    Popis: <textarea id="text-edit-1" class="span6" rows=20 cols=80 name="description">{$day->description}</textarea><br>
    <input type="submit" name="submit" class="btn-green">
</form>