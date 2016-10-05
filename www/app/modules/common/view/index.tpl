<head>
    <title>{$title}</title>
    <link rel="stylesheet" type="text/css" href="{$root}css/reset.css">
    <link rel="stylesheet" type="text/css" href="{$root}css/fgui.css">
    <link rel="stylesheet" type="text/css" href="{$root}css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{$root}css/style.css">
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
    
    <hr />
    
    <div>
        {if $user->isLogged()}
            <{a href="c1:Course:showAllDays"} class="btn-green">prejit na kurz</a>

            {if $user->isAdmin()}
                <{a href="c1:admin:AdminCourse:default"} class="btn-grey">administrace kurzu</a>
            {/if}
        {/if}
    </div>
    
    <div>
        {include file="$template.tpl"}
    </div>
    
</body>