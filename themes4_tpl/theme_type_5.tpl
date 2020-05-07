<div id="xoops_theme_content_zone" class="row" style="<{$content_zone}>">
    <{if $xoBlocks.canvas_left and $xoBlocks.canvas_right}>
        <!-- 若是有左、右區塊 -->

        <div id="xoops_theme_center_zone" class="col-lg-<{$cb_width}> order-lg-2" style="<{$centerBlocks}>">
            <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/centerZone.tpl"}>
        </div>

        <div id="xoops_theme_left_zone" class="<{if $lb_width=="auto"}>col-md<{else}>col-lg-<{$lb_width}><{/if}> order-lg-1" style="background-color:<{$lb_color}>;">
            <div id="xoops_theme_left" style="<{$leftBlocks}>">
                <a accesskey="L" href="#xoops_theme_left_zone_key" title="<{$smarty.const._TAD_LEFT_ZONE}>" id="xoops_theme_left_zone_key" style="color: transparent; font-size: 0.625em;">:::</a>
                <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/leftBlock.tpl"}>
            </div>
        </div>

        <div id="xoops_theme_right_zone" class="<{if $rb_width=="auto"}>col-md<{else}>col-lg-<{$rb_width}><{/if}> order-lg-3" style="background-color:<{$rb_color}>;">
            <div id="xoops_theme_right"  style="<{$rightBlocks}>">
                <a accesskey="R" href="#xoops_theme_right_zone_key" title="<{$smarty.const._TAD_RIGHT_ZONE}>" id="xoops_theme_right_zone_key" style="color: transparent; font-size: 0.625em;">:::</a>
                <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/rightBlock.tpl"}>
            </div>
        </div>
    <{elseif $xoBlocks.canvas_left and !$xoBlocks.canvas_right}>
        <!-- 若是只有左區塊 -->
        <{if $rb_width=="auto" and $lb_width=="auto"}>
            <{assign var=center_width value=9}>
        <{elseif $rb_width!="auto" and $cb_width!="auto"}>
            <{assign var=center_width value=$cb_width+$rb_width}>
        <{elseif $lb_width!="auto"}>
            <{assign var=center_width value=12-$lb_width}>
        <{else}>
            <{assign var=center_width value=$cb_width}>
        <{/if}>

        <div id="xoops_theme_center_zone" class="col-lg-<{$center_width}> order-lg-2" style="<{$centerBlocks}>">
            <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/centerZone.tpl"}>
        </div>

        <div id="xoops_theme_left_zone" class="<{if $lb_width=="auto"}>col-md<{else}>col-lg-<{$lb_width}><{/if}> order-lg-1" style="background-color:<{$lb_color}>;">
            <div id="xoops_theme_left" style="<{$leftBlocks}>">
                <a accesskey="L" href="#xoops_theme_left_zone_key" title="<{$smarty.const._TAD_LEFT_ZONE}>" id="xoops_theme_left_zone_key" style="color: transparent; font-size: 0.625em;">:::</a>
                <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/leftBlock.tpl"}>
            </div>
        </div>
    <{elseif !$xoBlocks.canvas_left and $xoBlocks.canvas_right}>
        <!-- 若是只有右區塊 -->
        <{if $rb_width=="auto" and $lb_width=="auto"}>
            <{assign var=center_width value=9}>
        <{elseif $lb_width!="auto" and $cb_width!="auto"}>
            <{assign var=center_width value=$cb_width+$lb_width}>
        <{elseif $rb_width!="auto"}>
            <{assign var=center_width value=12-$rb_width}>
        <{else}>
            <{assign var=center_width value=$cb_width}>
        <{/if}>
        <div id="xoops_theme_center_zone" class="col-lg-<{$center_width}> order-lg-1" style="<{$centerBlocks}>">
            <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/centerZone.tpl"}>
        </div>

        <div id="xoops_theme_right_zone" class="<{if $rb_width=="auto"}>col-md<{else}>col-lg-<{$rb_width}><{/if}> order-lg-2" style="background-color:<{$rb_color}>;">
            <div id="xoops_theme_right"  style="<{$rightBlocks}>">
                <a accesskey="R" href="#xoops_theme_right_zone_key" title="<{$smarty.const._TAD_RIGHT_ZONE}>" id="xoops_theme_right_zone_key" style="color: transparent; font-size: 0.625em;">:::</a>
                <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/rightBlock.tpl"}>
            </div>
        </div>
    <{else}>
        <div class="col-lg-12" style="<{$centerBlocks}>">
            <{includeq file="$xoops_rootpath/modules/tadtools/themes4_tpl/centerZone.tpl"}>
        </div>
    <{/if}>
    <div style="clear: both;"></div>
</div>
