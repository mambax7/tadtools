<{assign var=this_file value=$smarty.template|basename|replace:'db:':''}>
<{config_load file="$xoops_rootpath/uploads/bootstrap.conf"}>
<{includeq file="$xoops_rootpath/modules/tadtools/themes`$smarty.config.bootstrap`_tpl/blocks_tpl/pm/`$this_file`"}>