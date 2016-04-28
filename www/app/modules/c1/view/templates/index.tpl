<head>
    <title>{$title}</title>
</head>
<body>
    <h1>Kurz 1</h1>
    
    {include file='components/userLogin.tpl'}
    
    {if $messages|@count gt 0}
    <ul>
    {foreach from=$messages item=message}
        <li>{$message->getMessage()}</li>
    {/foreach}
    </ul>
    {/if}
    
    <div>
        {include file="$template.tpl"}
    </div>
    
</body>