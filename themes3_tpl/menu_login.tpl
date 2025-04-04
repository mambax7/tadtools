<{if $openid_login!="3"}>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    <{if $openid_login=="0" or $openid_login=="1"}>
      <li>
        <form action="<{$xoops_url}>/user.php" method="post" class="form-horizontal" role="form">
          <fieldset style="min-width: 200px; margin: 10px;">
            <legend>
            <{if $login_text|default:false}><{$login_text|default:''}><{else}>
            <{$smarty.const.TF_USER_ENTER}><{/if}>
            </legend>
            <{if $login_description|default:false}><div class="alert alert-warning" style="font-size: 0.825rem;"><{$login_description|default:''}></div><{/if}>
            <div class="form-group">
              <label class="col-sm-4 control-label" for="uname">
                <{$smarty.const.TF_USER_S_ID}>
              </label>
              <div class="col-sm-8">
                <input type="text" name="uname"  id="uname" placeholder="<{$smarty.const.TF_USER_ID}>"  class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label" for="pass">
                <{$smarty.const.TF_USER_S_PASS}>
              </label>
              <div class="col-sm-8">
              <input type="password" name="pass" id="pass" placeholder="<{$smarty.const.TF_USER_PASS}>" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">
              </label>
              <div class="col-sm-8">
                <input type="hidden" name="xoops_redirect" value="<{$xoops_requesturi|default:''}>">
                <input type="hidden" name="rememberme" value="On">
                <input type="hidden" name="op" value="login">
                <input type="hidden" name="xoops_login" value="1">
                <button type="submit" class="btn btn-primary btn-block"><{$smarty.const.TF_USER_ENTER}></button>
              </div>
            </div>

            <{if $allow_register|default:false}>
              <div class="form-group">
                <div class="col-sm-5">
                  <a href="<{$xoops_url}>/register.php" class="btn btn-xs btn-link">
                    <span class="fa fa-pencil"></span>
                    <{$smarty.const.TF_USER_REGIST}>
                  </a>
                </div>
                <div class="col-sm-7">
                  <a href="<{$xoops_url}>/user.php#lost" class="btn btn-xs btn-link">
                    <span class="fa fa-magnifying-glass"></span>
                    <{$smarty.const.TF_USER_FORGET_PASS}>
                  </a>
                </div>
              </div>
            <{/if}>
          </fieldset>
        </form>

      </li>
    <{/if}>
    <{if $tlogin && ($openid_login==1 || $openid_login==2)}>
        <li>
            <div class="row">
                <{foreach from=$tlogin item=login}>
                    <{if $tlogin && $tlogin|@count < 4}>
                        <div class="col-12">
                            <a href="<{$login.link}>" class="btn me-2" style="display: block; margin: 4px; border: none; ">
                                <img src="<{$login.img}>" alt="<{$login.text}>" title="<{$login.text}>" style="width: 32px;height: 32px;object-fit: contain;">
                                <{$login.text}>
                            </a>
                        </div>
                    <{else}>
                        <div class="col-12">
                            <a href="<{$login.link}>" class="btn bg-white me-2" style="display: inline-flex;justify-content: center;align-items: center;width: 36px;height: 36px;padding: 0;margin: 3px;background-color: white;border: none;cursor: pointer;">
                                <img src="<{$login.img}>" alt="<{$login.text}>" title="<{$login.text}>" style="width: 32px;height: 32px;object-fit: contain;">
                            </a>
                        </div>
                    <{/if}>
                <{/foreach}>
            </div>
        </li>
    <{/if}>
  </ul>
<{/if}>