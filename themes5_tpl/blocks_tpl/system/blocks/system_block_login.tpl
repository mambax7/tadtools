<div class="loginform">
  <form action="<{$xoops_url}>/user.php" method="post" role="form">
    <div class="form-group row mb-3">
      <label class="col-md-4 col-form-label text-sm-end" for="uname">
        <{$smarty.const.TF_USER_S_ID}>
      </label>
      <div class="col-md-8">
        <input type="text" name="uname"  id="uname" placeholder="<{$smarty.const.TF_USER_ID}>"  class="form-control">
      </div>
    </div>

    <div class="form-group row mb-3">
      <label class="col-md-4 col-form-label text-sm-end" for="pass">
        <{$smarty.const.TF_USER_S_PASS}>
      </label>
      <div class="col-md-8">
      <input type="password" name="pass" id="pass" placeholder="<{$smarty.const.TF_USER_PASS}>" class="form-control">
      </div>
    </div>

    <div class="form-group row mb-3">
      <label class="col-md-4 col-form-label text-sm-end checkbox" for="rememberme">
        <{if isset($block.lang_rememberme)}>
            <input type="checkbox" name="rememberme" id="rememberme" value="On" class="formButton">
            <{$block.lang_rememberme|default:''}>
        <{/if}>
      </label>
      <div class="col-md-8 d-grid gap-2">
        <input type="hidden" name="xoops_redirect" value="<{$xoops_requesturi|default:''}>">
        <input type="hidden" name="rememberme" value="On">
        <input type="hidden" name="op" value="login">
        <input type="hidden" name="xoops_login" value="1"/>
        <{$block.sslloginlink|default:''}>
        <button type="submit" class="btn btn-primary btn-block"><{$smarty.const.TF_USER_ENTER}></button>
      </div>
    </div>

    <{if $allow_register|default:false}>
      <div class="form-group row mb-3">
        <div class="col-md-5">
          <a href="<{$xoops_url}>/register.php" class="btn btn-sm btn-link">
            <span class="fa fa-pencil"></span>
            <{$smarty.const.TF_USER_REGIST}>
          </a>
        </div>
        <div class="col-md-7">
          <a href="<{$xoops_url}>/user.php#lost" class="btn btn-sm btn-link">
            <span class="fa fa-magnifying-glass"></span>
            <{$smarty.const.TF_USER_FORGET_PASS}>
          </a>
        </div>
      </div>
    <{/if}>
  </form>
</div>
