<{assign var="this_file" value=$smarty.template|basename|replace:'db:':''}>

<{include file="$xoops_rootpath/modules/tadtools/themes`$smarty.session.bootstrap|default:5`_tpl/blocks_tpl/profile/`$this_file`"}>