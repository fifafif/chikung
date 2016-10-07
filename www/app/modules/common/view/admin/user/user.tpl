<h1>Uzivatel</h1>

Id: {$targetUser->id}<br />
Uzivatelske jmeno: {$targetUser->username}<br />
Email: {$targetUser->email}<br />
Role: {$targetUser->role} [0 - default, 1 - admin]<br />

<hr />

<a href={link a="common:admin:AdminUser:default"} class="btn-grey">zpatky</a>
<a href={link a="common:admin:AdminUser:showEdit" id=$targetUser->id} class="btn-grey">editovat</a>