<div id="xoops_theme_content_zone" class="row">
    <{if $xoBlocks.canvas_left|default:null}>
        <div class="col-xl-12" id="xoops_theme_left_zone" style="background-color:<{$lb_color|default:''}>;">
            <a accesskey="L" href="#xoops_theme_left_zone_key" title="<{$smarty.const._TAD_LEFT_ZONE}>" id="xoops_theme_left_zone_key" style="color: transparent; font-size: 0.625rem; position: absolute;">:::</a>
            <div  style="background-color:<{$lb_color|default:''}>;">
                <{include file="$xoops_rootpath/modules/tadtools/themes4_tpl/leftBottom.tpl"}>
            </div>
        </div>
    <{/if}>

    <div class="col-xl-12" id="xoops_theme_center_zone" style="background-color:<{$cb_color|default:''}>;">
        <div style="<{$centerBlocks|default:''}>">
            <{include file="$xoops_rootpath/modules/tadtools/themes4_tpl/centerZone.tpl"}>
        </div>
    </div>

    <{if $xoBlocks.canvas_right|default:null}>
        <div class="col-xl-12" id="xoops_theme_right_zone" style="background-color:<{$rb_color|default:''}>;">
            <a accesskey="R" href="#xoops_theme_right_zone_key" title="<{$smarty.const._TAD_RIGHT_ZONE}>" id="xoops_theme_right_zone_key" style="color: transparent; font-size: 0.625rem; position: absolute;">:::</a>
            <div style="background-color:<{$rb_color|default:''}>;">
                <{include file="$xoops_rootpath/modules/tadtools/themes4_tpl/rightBottom.tpl"}>
            </div>
        </div>
    <{/if}>

    <div style="clear: both;"></div>
</div>