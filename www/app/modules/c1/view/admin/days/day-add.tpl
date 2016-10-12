{literal}
    <script type="text/javascript">
        
        bkLib.onDomLoaded(function() 
        {
            new nicEditor({iconsPath : '{/literal}{$root}{literal}js/libs/nicEditorIcons.gif'}).panelInstance('text-edit-1');
        });
    
    </script>
{/literal}


<h2>Add new day</h2>

<form action={link a="c1:admin:AdminDay:add"} method="post">
    Nazev: <input type="text" name="name"><br>
    Poradi: <input type="number" name="order"><br>
    Popis: <textarea id="text-edit-1" class="span6" rows=20 cols=80 name="description"></textarea><br>
    <input type="submit" name="submit" class="btn success">
</form>
    
<a href={link a="c1:admin:AdminCourse:default"} class="btn info">zpatky</a>