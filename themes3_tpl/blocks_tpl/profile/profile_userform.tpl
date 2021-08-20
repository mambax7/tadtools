<h2 style="display:none;">Login</h2>
<fieldset class="pad10">
    <legend class="bold"><{$lang_login}></legend>
    <form action="user.php" method="post">
        <{$lang_username}> <input type="text" name="uname" size="26" maxlength="25" value="" title="uname"/><br><br>
        <{$lang_password}> <input type="password" name="pass" size="21" maxlength="32" title="pass"/><br><br>
        <{if isset($lang_rememberme)}>
            <input type="checkbox" name="rememberme" value="On" checked title="rememberme"/>
            <{$lang_rememberme}>
            <br>
            <br>
        <{/if}>

        <input type="hidden" name="op" value="login"/>
        <input type="hidden" name="xoops_redirect" value="<{$redirect_page}>"/>
        <input type="submit" value="<{$lang_login}>"/>
    </form>
    <br>
    <a name="lost">&nbsp;</a>

    <div><{$lang_notregister}><br></div>
</fieldset>

<br>

<fieldset class="pad10">
    <legend class="bold"><{$lang_lostpassword}></legend>
    <div><br><{$lang_noproblem}></div>
    <form action="lostpass.php" method="post">
        <{$lang_youremail}> <input type="text" name="email" size="26" maxlength="60" title="email"/>&nbsp;&nbsp;<input type="hidden" name="op" value="mailpasswd"/><input type="hidden" name="t" value="<{$mailpasswd_token}>"/><input type="submit" value="<{$lang_sendpassword}>"/>
    </form>
</fieldset>
