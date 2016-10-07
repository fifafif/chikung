<head>
    <title>{$title}</title>
    
    <link rel="stylesheet" type="text/css" href="{$root}css/fgui.css">
    <link rel="stylesheet" type="text/css" href="{$root}css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{$root}css/style.css">
</head>
<body>
    <h1>Kurz 1</h1>
    
    {include file='./../../common/view/components/userLogin.tpl'}
    
    {if $messages|@count gt 0}
        
    <hr />
        
    <ul>
    {foreach from=$messages item=message}
        <li>{$message->getMessage()}</li>
    {/foreach}
    </ul>
    {/if}
    
    <hr />
    
    <div>
        {include file="$template.tpl"}
    </div>
    
    <hr />
    {if $user->isAdmin()}
        <{a href="c1:admin:AdminCourse:default"} class="btn-grey">administrace kurzu</a>
    {/if}
    
</body>