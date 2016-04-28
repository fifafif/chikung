<head>
    <title>{$title}</title>
</head>
<body>
    <h1>Chikung</h1>
    
    {include file='./components/userLogin.tpl'}
    
    {if $messages|@count gt 0}
    <ul>
    {foreach from=$messages item=message}
        <li>{$message->getMessage()}</li>
    {/foreach}
    </ul>
    {/if}
    
    <div>
        {if $user->isLogged()}
        <{a href="c1:course:showAllDays"}>kurz</a>
        {/if}
    </div>
    
    <div>
        {include file="$template.tpl"}
    </div>
    
</body>