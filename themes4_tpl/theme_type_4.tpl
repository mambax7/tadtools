<div id="xoops_theme_content_zone" class="row" style="<{$content_zone}>">
    <{if $xoBlocks.canvas_left}>
        <div id="xoops_theme_center_zone" class="col-md-<{$cb_width}>" style="<{$centerBlocks}>">
            <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/centerZone.tpl"}>
        </div>

        <div id="xoops_theme_left_zone" class="col-md-<{$lb_width}>" style="background-color:<{$lb_color}>;">
            <a accesskey="L" href="#xoops_theme_left_zone_key" title="<{$smarty.const._TAD_LEFT_ZONE}>" id="xoops_theme_left_zone_key" style="color: transparent; font-size: 10px;">:::</a>
            <div id="xoops_theme_right"  style="<{$leftBlocks}>">
                <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/leftBlock.tpl"}>
            </div>
        </div>
    <{else}>
        <div id="xoops_theme_center_zone" class="col-md-12" style="<{$centerBlocks}>">
            <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/centerZone.tpl"}>
        </div>
    <{/if}>
    <div style="clear: both;"></div>
</div>

<{if $xoBlocks.canvas_right}>
    <div id="xoops_theme_right_zone" class="row" style="background-color:<{$rb_color}>;">
        <a accesskey="R" href="#xoops_theme_right_zone_key" title="<{$smarty.const._TAD_RIGHT_ZONE}>" id="xoops_theme_right_zone_key" style="color: transparent; font-size: 10px;">:::</a>
        <div class="col-md-<{$rb_width}>">
            <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/rightBottom.tpl"}>
        </div>
        <div style="clear: both;"></div>
    </div>
<{/if}>