<a accesskey="C" href="#xoops_theme_center_zone_key" title="<{$smarty.const._TAD_CENTER_ZONE}>" id="xoops_theme_center_zone_key" style="color: transparent; font-size: 0.625rem; position: absolute;">:::</a>
<div id="xoops_theme_center" style="<{$centerBlocksContent|default:''}>">
  <{include file="$xoops_rootpath/modules/tadtools/themes3_tpl/centerBlock.tpl"}>
  <div class="row">
    <div class="col-sm-6"><{include file="$xoops_rootpath/modules/tadtools/themes3_tpl/centerLeft.tpl"}></div>
    <div class="col-sm-6"><{include file="$xoops_rootpath/modules/tadtools/themes3_tpl/centerRight.tpl"}></div>
  </div>

  <{include file="$xoops_rootpath/modules/tadtools/themes3_tpl/xoopsContents.tpl"}>

  <{include file="$xoops_rootpath/modules/tadtools/themes3_tpl/centerBottom.tpl"}>

  <div class="row">
    <div class="col-sm-6"><{include file="$xoops_rootpath/modules/tadtools/themes3_tpl/centerBottomLeft.tpl"}></div>
    <div class="col-sm-6"><{include file="$xoops_rootpath/modules/tadtools/themes3_tpl/centerBottomRight.tpl"}></div>
  </div>
</div>