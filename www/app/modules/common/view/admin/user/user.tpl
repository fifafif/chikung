<h1>Uzivatel</h1>

Id: {$targetUser->id}<br />
Uzivatelske jmeno: {$targetUser->username}<br />
Email: {$targetUser->email}<br />
Role: {$targetUser->role} [0 - default, 1 - admin]<br />

Kurzy:
{if $userCourses|@count gt 0}
    {foreach from=$userCourses item=course}
        {$course->id}; 
    {/foreach}
{else}
    Uzivatel nema zadne kurzy.
{/if}
            

<hr />

<a href={link a="common:admin:AdminUser:default"} class="btn info">zpatky</a>
<a href={link a="common:admin:AdminUser:showEdit" id=$targetUser->id} class="btn info">editovat</a>