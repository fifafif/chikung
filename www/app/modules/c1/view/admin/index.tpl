<head>
    <title>{$title} - administrace</title>
</head>
<body>
    <h1>Administrace kurzu</h1>
    
    {include file='./../../../common/view/components/userLogin.tpl'}
    
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