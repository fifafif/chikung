<head>
    <title>{$title} - administrace</title>
    <link rel="stylesheet" type="text/css" href="{$root}css/reset.css">
    <link rel="stylesheet" type="text/css" href="{$root}css/fgui.css">
    <link rel="stylesheet" type="text/css" href="{$root}css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{$root}css/style.css">
</head>
<body>
    <h1>Administrace kurzu</h1>
    
    {include file='./../../../common/view/components/userLogin.tpl'}
    
    <hr />
    
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