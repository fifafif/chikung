<head>
    <title>{$title}</title>
</head>
<body>
    <h1>Admin Chikung</h1>
    
    {include file='../../../common/view/templates/components/userLogin.tpl'}
    
    {if $messages|@count gt 0}
    <ul>
    {foreach from=$messages item=message}
        <li>{$message->getMessage()}</li>
    {/foreach}
    </ul>
    {/if}
    
    <div>
        <a href="{$root}admin/uzivatele">Uzivatele</a>
        <a href="{$root}admin/cviceni">Cviceni</a>
    </div>
    
    <div>
        {include file="$template.tpl"}
    </div>
    
</body>