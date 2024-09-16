<{if $xoBlocks.canvas_right|default:null}>
  <{assign var="i" value=0}>
  <{assign var="total" value=1}>

  <div class="rightBlock" style="<{if $rightBlocks2|default:false}><{$rightBlocks2}>;<{/if}>width:100%;">
    <{foreach item=block from=$xoBlocks.canvas_right|default:null}>
      <{if $i==0}>
        <div class="row">
      <{/if}>

      <{if $block.content|default:false}>
        <div class="col-sm-3">
          <{include file="$xoops_rootpath/modules/tadtools/themes_common/blockTitle.tpl"}>
          <div class="blockContent" style="clear:both;">
            <{$block.content}>
          </div>
        </div>
      <{/if}>

      <{assign var="i" value=$i+1}>
      <{if $i == 4 || $total==$right_count}>
        </div>
        <{assign var="i" value=0}>
      <{/if}>
      <{assign var="total" value=$total+1}>
    <{/foreach}>
    <div class="clearfix"></div>
  </div>
<{/if}>