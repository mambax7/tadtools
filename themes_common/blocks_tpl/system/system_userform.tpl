<{assign var=this_file value=$smarty.template|basename|replace:'db:':''}>
<!-- 嘿 -->
<{includeq file="$xoops_rootpath/modules/tadtools/themes`$smarty.session.bootstrap`_tpl/blocks_tpl/system/`$this_file`"}>