<h2>Editovat uzivatele</h2>

<form action={link a="common:admin:AdminUser:edit" id=$targetUser->id} method="post">
    Uzivatelske jmeno: <input type="text" name="username" value="{$targetUser->username}"><br>
    Email: <input type="text" name="email" value="{$targetUser->email}"><br>
    {form_select name="role" data=$roleData}
    <input type="submit" name="submit" class="btn-green">
</form>

<a href={link a="common:admin:AdminUser:show" id=$targetUser->id} class="btn-grey">Zrusit</a>
    
