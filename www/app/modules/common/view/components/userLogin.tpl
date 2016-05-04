<div>User login:</div>


<{a href="User:create" a=!$user->isLogged() name="123"}>user </a>


    {if $user->isLogged()}
    
    hello {$user->username}
    
    <br>
    <a href="{$root}index.php?c=User&h=logout">logout</a>
    
    {else}
    
    <h2>Registrace pico!</h2>
    <{form action="User:create"} method="post">
        Username: <input type="text" name="username"><br>
        E-mail: <input type="text" name="email"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" name="submit">
    </form>
    
    <h2>Login</h2>
    <{form action="User:login"} method="post">
        Username: <input type="text" name="username-login"><br>
        Password: <input type="password" name="password-login"><br>
        <input type="submit" name="submit-login">
    </form>
    
    {/if}
