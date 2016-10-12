<h2>Editovat uzivatele</h2>

<form action={link a="common:admin:AdminUser:edit" id=$targetUser->id} method="post">
    Uzivatelske jmeno: <input type="text" name="username" value="{$targetUser->username}"><br>
    Email: <input type="text" name="email" value="{$targetUser->email}"><br>
    {form_select name="role" data=$roleData}<br />
    
    Aktivovane kurzy:<br />
    {if $courses|@count gt 0}
    {foreach from=$courses item=course}
        <input type="checkbox" name="courseIds[]" value="{$course->id}" 
               
                {if array_key_exists($course->id, $userCourses) && $userCourses[$course->id]->status == 1} checked {/if}
               />{$course->name}
    {/foreach}
    {else}
        Nejsou zadne kuzry
    {/if}
    
    <br />
    
    <input type="submit" name="submit" class="btn success"><br />
    
</form>

<a href={link a="common:admin:AdminUser:show" id=$targetUser->id} class="btn info">Zrusit</a>
    
