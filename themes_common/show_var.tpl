
<script type='text/javascript' src='<{$xoops_url}>/modules/tadtools/Easy-Responsive-Tabs/js/easyResponsiveTabs.js'></script>
<link rel='stylesheet' type='text/css' media='all' title='Style sheet' href='<{$xoops_url}>/modules/tadtools/Easy-Responsive-Tabs/css/easy-responsive-tabs.css' >
<script>
    $(document).ready(function(){
        $('#showVarTab').easyResponsiveTabs({
            tabidentify: 'vert',
            type: 'default', //Types: default, vertical, accordion
            width: 'auto',
            fit: true,
            closed: false,
            activate: function() {}
        });

        $('#showTadThemeVarTab').easyResponsiveTabs({
            tabidentify: 'vert1',
            type: 'default', //Types: default, vertical, accordion
            width: 'auto',
            fit: true,
            closed: false,
            activate: function() {}
        });
    });
</script>
<style>
    tbody.unable{
        color:rgb(140, 142, 151);
    }
</style>

<h2>所有可用佈景變數</h2>
<{if $xoops_isadmin|default:false}>
    <div class="row" style="margin-bottom:200px;">
        <div id="showVarTab">
            <ul class="resp-tabs-list vert">
                <li>佈景及各種偏好設定</li>
                <li>佈景變數值</li>
                <li>主選單</li>
                <li>自訂選單</li>
                <li>滑動圖文變數值</li>
                <li>額外設定變數值</li>
            </ul>

            <{assign var="bootstrap" value=$smarty.session.bootstrap|default:$session.bootstrap}>
            <div class="resp-tabs-container vert">
                <!-- 佈景及各種偏好設定值 -->
                <div>
                    <table class="table table-striped table-bordered table-hover" style="background:white;">
                        <tr><th colspan=3><h2>基本設定</h2></th></tr>
                        <tr><th>佈景種類</th><th>$theme_kind</th><td><{$theme_kind|default:''}></td></tr>
                        <tr><th>BootStrap版本</th><th>$bootstrap</th><td><{$bootstrap|default:''}></td></tr>
                        <tr><th>佈景編號</th><th>$theme_id</th><td><{$theme_id|default:''}></td></tr>
                        <tr><th>佈景名稱</th><th>$theme_name</th><td><{$theme_name|default:''}></td></tr>
                        <tr><th>bootstrap顏色</th><th>$theme_color</th><td><{$theme_color|default:''}></td></tr>
                        <tr><th>載入選單種類</th><th>$menu_var_kind</th><td><{$menu_var_kind|default:''}></td></tr>
                        <tr><th>開除錯</th><th>$debug</th><td><{$debug|default:''}></td></tr>
                        <tr><th>內容區設定</th><th>$content_zone</th><td><{$content_zone|default:''}></td></tr>
                        <tr><th>左區域設定</th><th>$leftBlocks</th><td><{$leftBlocks|default:''}></td></tr>
                        <tr><th>中區域設定</th><th>$centerBlocks</th><td><{$centerBlocks|default:''}></td></tr>
                        <tr><th>右區域設定</th><th>$rightBlocks</th><td><{$rightBlocks|default:''}></td></tr>
                        <tr><th>第二左區域設定</th><th>$leftBlocks2</th><td><{$leftBlocks2|default:''}></td></tr>
                        <tr><th>第二右區域設定</th><th>$rightBlocks2</th><td><{$rightBlocks2|default:''}></td></tr>
                        <tr><th>樣板設定檔</th><th>$xoops_themecss</th><td><{$xoops_themecss|default:''}></td></tr>

                        <tr><th colspan=3><h2>Tad Themes 偏好設定</h2></th></tr>
                        <tr><th>顯示主選單下拉選單</th><th>$auto_mainmenu</th><td><{$auto_mainmenu|default:''}></td></tr>
                        <tr><th>是否在工具列顯示網站標題文字</th><th>$show_sitename</th><td><{$show_sitename|default:''}></td></tr>

                        <tr><th colspan=3><h2>Tad Tools 偏好設定</h2></th></tr>
                        <tr><th>導覽列的登入呈現方式</th><th>$openid_login</th><td><{$openid_login|default:''}></td></tr>
                        <tr><th>登入選單一排要呈現幾個OpenID圖示</th><th>$openid_logo</th><td><{$openid_logo|default:''}></td></tr>
                        <tr><th>是否釘選住導覽列？</th><th>$use_pin</th><td><{$use_pin|default:''}></td></tr>
                        <tr><th>導覽列的登入文字</th><th>$login_text</th><td><{$login_text|default:''}></td></tr>
                        <tr><th>登入說明</th><th>$login_description</th><td><{$login_description|default:''}></td></tr>

                        <tr><th colspan=3><h2>其他設定</h2></th></tr>
                        <tr><th>左邊區塊數</th><th>$left_count</th><td><{$left_count|default:''}></td></tr>
                        <tr><th>右邊區塊數</th><th>$right_count</th><td><{$right_count|default:''}></td></tr>
                        <tr><th>選單是否有用到 popup 模式</th><th>$have_popup</th><td><{$have_popup|default:''}></td></tr>
                        <tr><th>popup 語法</th><th>$tad_themes_popup_code</th><td><{$tad_themes_popup_code|default:''}></td></tr>
                    </table>
                </div>

                <!-- 佈景變數值 -->
                <div>
                    <h2>佈景變數值</h2>
                    <div id="showTadThemeVarTab">
                        <ul class="resp-tabs-list vert1">
                            <li>網頁布局設定</li>
                            <li>背景圖設定</li>
                            <li>滑動圖片設定</li>
                            <li>logo 圖設定</li>
                            <li>區塊標題設定</li>
                            <li>導覽列設定</li>
                        </ul>

                        <div class="resp-tabs-container vert1">
                            <!-- 網頁布局設定 -->
                            <div>
                                <h2>網頁布局設定</h2>
                                <table class="table table-striped table-bordered table-hover" style="background:white;">
                                    <tbody <{if !$config_tabs.1}>class="unable"<{/if}>>
                                        <tr><th>版面類型</th><th>$theme_type</th><td><{$theme_type|default:''}></td></tr>
                                        <tr><th>版面寬度</th><th>$theme_width</th><td><{$theme_width|default:''}></td></tr>
                                        <tr><th>文字大小</th><th>$font_size</th><td><{$font_size|default:''}></td></tr>
                                        <tr><th>內容區顏色</th><th>$base_color</th><td><{$base_color|default:''}></td></tr>
                                        <tr><th>左區塊顏色</th><th>$lb_color</th><td><{$lb_color|default:''}></td></tr>
                                        <tr><th>中區塊顏色</th><th>$cb_color</th><td><{$cb_color|default:''}></td></tr>
                                        <tr><th>右區塊顏色</th><th>$rb_color</th><td><{$rb_color|default:''}></td></tr>
                                        <tr><th>左區塊寬度</th><th>$lb_width</th><td><{$lb_width|default:''}></td></tr>
                                        <tr><th>中區塊寬度</th><th>$center_width</th><td><{$center_width|default:''}></td></tr>
                                        <tr><th>右區塊寬度</th><th>$rb_width</th><td><{$rb_width|default:''}></td></tr>
                                        <tr><th>中左區塊寬度</th><th>$clb_width</th><td><{$clb_width|default:''}></td></tr>
                                        <tr><th>中右區塊寬度</th><th>$crb_width</th><td><{$crb_width|default:''}></td></tr>
                                        <tr><th>上方邊界</th><th>$margin_top</th><td><{$margin_top|default:''}></td></tr>
                                        <tr><th>下方邊界</th><th>$margin_bottom</th><td><{$margin_bottom|default:''}></td></tr>
                                        <tr><th>文字顏色</th><th>$font_color</th><td><{$font_color|default:''}></td></tr>
                                        <tr><th>連結顏色</th><th>$link_color</th><td><{$link_color|default:''}></td></tr>
                                        <tr><th>滑鼠移到連結顏色</th><th>$hover_color</th><td><{$hover_color|default:''}></td></tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- 背景圖設定 -->
                            <div>
                                <h2>背景圖設定</h2>
                                <table class="table table-striped table-bordered table-hover" style="background:white;">
                                    <tbody <{if !$config_tabs.2}>class="unable"<{/if}>>
                                        <tr><th>預設背景圖</th><th>$bg_img</th><td><{$bg_img|default:''}></td></tr>
                                        <tr><th>背景顏色</th><th>$bg_color</th><td><{$bg_color|default:''}></td></tr>
                                        <tr><th>背景重複</th><th>$bg_repeat</th><td><{$bg_repeat|default:''}></td></tr>
                                        <tr><th>背景模式</th><th>$bg_attachment</th><td><{$bg_attachment|default:''}></td></tr>
                                        <tr><th>背景位置</th><th>$bg_position</th><td><{$bg_position|default:''}></td></tr>

                                    </tbody>
                                </table>
                            </div>

                            <!-- 滑動圖片設定 -->
                            <div>
                                <h2>滑動圖片設定</h2>
                                <table class="table table-striped table-bordered table-hover" style="background:white;">
                                    <tbody <{if !$config_tabs.3}>class="unable"<{/if}>>
                                        <tr><th>是否可上傳滑動圖片</th><th>$use_slide</th><td><{$use_slide|default:''}></td></tr>

                                    </tbody>
                                </table>
                            </div>

                            <!-- logo 圖設定 -->
                            <div>
                                <h2>logo 圖設定</h2>
                                <table class="table table-striped table-bordered table-hover" style="background:white;">
                                    <tbody <{if !$config_tabs.4}>class="unable"<{/if}>>
                                        <tr><th>logo 圖</th><th>$logo_img</th><td><{$logo_img|default:''}></td></tr>
                                        <tr><th>logo 圖位置</th><th>$logo_position</th><td><{$logo_position|default:''}></td></tr>
                                        <tr><th>logo 圖上方位置</th><th>$logo_top</th><td><{$logo_top|default:''}>%</td></tr>
                                        <tr><th>logo 圖右方位置</th><th>$logo_right</th><td><{$auto_mainlogo_rightmenu|default:''}>%</td></tr>
                                        <tr><th>logo 圖下方位置</th><th>$logo_bottom</th><td><{$logo_bottom|default:''}>%</td></tr>
                                        <tr><th>logo 圖左方位置</th><th>$logo_left</th><td><{$logo_left|default:''}>%</td></tr>
                                        <tr><th>logo 圖置中</th><th>$logo_center</th><td><{$logo_center|default:''}></td></tr>
                                        <tr><th>Logo 圖位置</th><th>$logo_place</th><td><{$logo_place|default:''}></td></tr>

                                    </tbody>
                                </table>
                            </div>

                            <!-- 區塊標題設定 -->
                            <div>
                                <h2><{$bt.block_position|default:false}>區塊標題設定</h2>
                                <table class="table table-striped table-bordered table-hover" style="background:white;">
                                    <tbody <{if !$config_tabs.5|default:false}>class="unable"<{/if}>>
                                        <{foreach from=$positions|default:false item=bt}>
                                            <tr><th>區塊標題列背景重複</th><th>$<{$bt.block_position}>.bt_bg_repeat</th><td><{$bt.bt_bg_repeat}></td></tr>
                                            <tr><th>區塊標題列背景圖</th><th>$<{$bt.block_position}>.bt_bg_img</th><td><{$bt.bt_bg_img}></td></tr>
                                            <tr><th>區塊標題文字縮排</th><th>$<{$bt.block_position}>.bt_text_padding</th><td><{$bt.bt_text_padding}></td></tr>
                                            <tr><th>區塊標題文字大小</th><th>$<{$bt.block_position}>.bt_text_size</th><td><{$bt.bt_text_size}></td></tr>
                                            <tr><th>區塊標題列文字顏色</th><th>$<{$bt.block_position}>.bt_text</th><td><{$bt.bt_text}></td></tr>
                                            <tr><th>區塊標題列背景顏色</th><th>$<{$bt.block_position}>.bt_bg_color</th><td><{$bt.bt_bg_color}></td></tr>
                                            <tr><th>區塊標題工具按鈕</th><th>$<{$bt.block_position}>.block_config</th><td><{$bt.block_config}></td></tr>
                                            <tr><th>區塊標題圓角設定</th><th>$<{$bt.block_position}>.bt_radius</th><td><{$bt.bt_radius}></td></tr>
                                            <tr><th>區塊整體樣式手動設定</th><th>$<{$bt.block_position}>.block_style</th><td><{$bt.block_style}></td></tr>
                                            <tr><th>區塊標題區樣式手動設定</th><th>$<{$bt.block_position}>.block_title_style</th><td><{$bt.block_title_style}></td></tr>
                                            <tr><th>區塊內容區樣式手動設定</th><th>$<{$bt.block_position}>.block_content_style</th><td><{$bt.block_content_style}></td></tr>
                                        <{/foreach}>

                                    </tbody>
                                </table>
                            </div>

                            <!-- 導覽列設定 -->
                            <div>
                                <h2>導覽列設定</h2>
                                <table class="table table-striped table-bordered table-hover" style="background:white;">
                                    <tbody <{if !$config_tabs.6}>class="unable"<{/if}>>
                                        <tr><th>導覽列位置</th><th>$navbar_pos</th><td><{$navbar_pos|default:''}></td></tr>
                                        <tr><th>導覽列漸層顏色(top)</th><th>$navbar_bg_top</th><td><{$navbar_bg_top|default:''}></td></tr>
                                        <tr><th>導覽列漸層顏色(bottom)</th><th>$navbar_bg_bottom</th><td><{$navbar_bg_bottom|default:''}></td></tr>
                                        <tr><th>導覽列連結區塊底色</th><th>$navbar_hover</th><td><{$navbar_hover|default:''}></td></tr>
                                        <tr><th>導覽列文字顏色</th><th>$navbar_color</th><td><{$navbar_color|default:''}></td></tr>
                                        <tr><th>導覽列文字移過顏色</th><th>$navbar_color_hover</th><td><{$navbar_color_hover|default:''}></td></tr>
                                        <tr><th>導覽列圖示顏色</th><th>$navbar_icon</th><td><{$navbar_icon|default:''}></td></tr>
                                        <tr><th>導覽選項上下距離</th><th>$navbar_py</th><td><{$navbar_py|default:''}></td></tr>
                                        <tr><th>導覽選項左右距離</th><th>$navbar_px</th><td><{$navbar_px|default:''}></td></tr>
                                        <tr><th>導覽列背景圖</th><th>$navbar_img</th><td><{$navbar_img|default:''}></td></tr>
                                        <tr><th>選項文字大小</th><th>$navbar_font_size</th><td><{$navbar_font_size|default:''}></td></tr>

                                        <tr><th colspan=3><h2>導覽列 logo 圖設定</h2></th></tr>
                                        <tr><th>導覽列圖示(舊)</th><th>$navlogo_img</th><td><{$navlogo_img|default:''}></td></tr>
                                        <tr><th>導覽列 logo 圖</th><th>$logo_img</th><td><{$logo_img|default:''}></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- 主選單 -->
                <div>
                    <table class="table table-striped table-bordered table-hover" style="background:white;">

                        <tr><th colspan=3><h2>主選單 &lt;{$main_menu_var}&gt;</h2></th></tr>
                        <{foreach from=$main_menu_var key=k item=m}>
                            <tr>
                                <th rowspan=7>
                                    <{$m.title}><br>&lt;{$main_menu_var.<{$k|default:''}>}&gt;
                                </th>
                                <th>&lt;{$main_menu_var.<{$k|default:''}>.id}&gt;</th><td><{$m.id}></td>
                            </tr>
                            <tr><th>&lt;{$main_menu_var.<{$k|default:''}>.title}&gt;</th><td><{$m.title}></td></tr>
                            <tr><th>&lt;{$main_menu_var.<{$k|default:''}>.url}&gt;</th><td><{$m.url}></td></tr>
                            <tr><th>&lt;{$main_menu_var.<{$k|default:''}>.target}&gt;</th><td><{$m.target}></td></tr>
                            <tr><th>&lt;{$main_menu_var.<{$k|default:''}>.icon}&gt;</th><td><{$m.icon}></td></tr>
                            <tr><th>&lt;{$main_menu_var.<{$k|default:''}>.img}&gt;</th><td><{$m.img}></td></tr>
                            <tr><th>&lt;{$main_menu_var.<{$k|default:''}>.read_group}&gt;</th><td>
                                <{foreach from=$m.read_group|default:false item=read_group}>
                                    <span><{$read_group|default:''}></span>
                                <{/foreach}>
                            </td></tr>
                        <{/foreach}>
                    </table>
                </div>

                <!-- 自訂選單 -->
                <div>
                    <table class="table table-striped table-bordered table-hover" style="background:white;">
                        <tr><th colspan=3><h2>自訂選單 &lt;{$menu_var}&gt;</h2></th></tr>

                        <{foreach from=$menu_var key=k item=m}>
                            <tr>
                                <th rowspan=7>
                                    <{$m.title}><br>&lt;{$menu_var.<{$k|default:''}>}&gt;
                                </th>
                                <th>&lt;{$menu_var.<{$k|default:''}>.id}&gt;</th><td><{$m.id}></td>
                            </tr>
                            <tr><th>&lt;{$menu_var.<{$k|default:''}>.title}&gt;</th><td><{$m.title}></td></tr>
                            <tr><th>&lt;{$menu_var.<{$k|default:''}>.url}&gt;</th><td><{$m.url}></td></tr>
                            <tr><th>&lt;{$menu_var.<{$k|default:''}>.target}&gt;</th><td><{$m.target}></td></tr>
                            <tr><th>&lt;{$menu_var.<{$k|default:''}>.icon}&gt;</th><td><{$m.icon}></td></tr>
                            <tr><th>&lt;{$menu_var.<{$k|default:''}>.img}&gt;</th><td><{$m.img}></td></tr>
                            <{if $m.submenu|default:false}>
                                <tr><td colspan=2 style="background-color: rgb(248, 248, 219);">
                                    <p><b>&lt;{$menu_var.<{$k|default:''}>.submenu}&gt;</b></p>
                                    <table class="table table-striped table-bordered table-hover table-condensed table-sm">
                                        <tr>
                                            <th>id</th>
                                            <th>title</th>
                                            <th>url</th>
                                            <th>target</th>
                                            <th>icon</th>
                                            <th>submenu</th>
                                        </tr>
                                        <{foreach from=$m.submenu item=m2}>
                                            <tr>
                                                <th <{if $m2.submenu|default:false}>rowspan=2<{/if}>><{$m2.id}></th>
                                                <th <{if $m2.submenu|default:false}>rowspan=2<{/if}>><{$m2.title}></th>
                                                <td><{$m2.url}></td>
                                                <td><{$m2.target}></td>
                                                <td><{$m2.icon}></td>
                                                <td><{if $m2.submenu|default:false}>子選項如下<{/if}></td>
                                            </tr>

                                            <{if $m2.submenu|default:false}>
                                                <tr>
                                                    <td colspan=4 style="background-color: rgb(220, 248, 219);">
                                                        <table class="table table-striped table-bordered table-hover table-condensed table-sm">
                                                            <tr>
                                                                <th>id</th>
                                                                <th>title</th>
                                                                <th>url</th>
                                                                <th>target</th>
                                                                <th>icon</th>
                                                                <th>submenu</th>
                                                            </tr>
                                                            <{foreach from=$m2.submenu item=m3}>
                                                                <tr>
                                                                    <th><{$m3.id}></th>
                                                                    <th><{$m3.title}></th>
                                                                    <td><{$m3.url}></td>
                                                                    <td><{$m3.target}></td>
                                                                    <td><{$m3.icon}></td>
                                                                    <td><{if $m3.submenu|default:false}>子選項如下<{/if}></td>
                                                                </tr>
                                                            <{/foreach}>
                                                        </table>
                                                    </td>
                                                </tr>
                                            <{/if}>

                                        <{/foreach}>
                                    </table>
                                    </td>
                                </tr>
                            <{else}>
                                <tr><th>&lt;{$menu_var.<{$k|default:''}>.submenu}&gt;</th><td></td></tr>
                            <{/if}>

                        <{/foreach}>

                    </table>
                </div>

                <!-- 滑動圖文變數值 -->
                <div>
                    <table class="table table-striped table-bordered table-hover" style="background:white;">
                        <tr><th colspan=3><h2>滑動圖文 $slider_var</h2></th></tr>
                        <{foreach from=$slider_var item=slide}>
                            <tr>
                                <th><img src="<{$slide.file_thumb_url}>" alt="<{$slide.file_name}>" title="<{$slide.file_name}>"></th>
                                <th>$slider_var[<{$slide.files_sn}>]</th>
                                <td>
                                    $slider_var[<{$slide.files_sn}>]['files_sn'] = <{$slide.files_sn}>;<br>
                                    $slider_var[<{$slide.files_sn}>]['sort'] = <{$slide.sort}>;<br>
                                    $slider_var[<{$slide.files_sn}>]['file_name'] = "<{$slide.file_name}>";<br>
                                    $slider_var[<{$slide.files_sn}>]['description'] = "<{$slide.description}>";<br>
                                    $slider_var[<{$slide.files_sn}>]['text_description'] = "<{$slide.text_description}>";<br>
                                    $slider_var[<{$slide.files_sn}>]['original_filename'] = "<{$slide.original_filename}>";<br>
                                    $slider_var[<{$slide.files_sn}>]['sub_dir'] = "<{$slide.sub_dir}>";<br>
                                    $slider_var[<{$slide.files_sn}>]['file_url'] = "<{$slide.file_url}>";<br>
                                    $slider_var[<{$slide.files_sn}>]['file_thumb_url'] = "<{$slide.file_thumb_url}>";<br>
                                    $slider_var[<{$slide.files_sn}>]['slide_url'] = "<{$slide.slide_url}>";<br>
                                    $slider_var[<{$slide.files_sn}>]['slide_target'] = "<{$slide.slide_target}>";
                                </td>
                            </tr>
                        <{/foreach}>
                    </table>
                </div>

                <!-- 額外設定變數值 -->
                <div>
                    <table class="table table-striped table-bordered table-hover" style="background:white;">
                    <{foreach from=$config2_files|default:[] item=config2_file}>
                        <tr><th colspan=3><h2>佈景額外<{$config2_file|default:''}>設定</h2></th></tr>
                        <{foreach from=$config2.$config2_file|default:[] key=k item=config}>
                            <tr><th><{$config.text}></th><th>$<{$config.name}></th><td><{if $config.type=='selectpicker' || $config.type=='custom_zone' || $config.type=='checkbox'}><{$config.value|@json_encode:256}><{else}><{$config.value}><{/if}></td></tr>
                            <{if $config.type|default:false =='bg_file'}>
                                <tr><th><{$config.text}> repeat</th><th>$<{$config.name}>_repeat</th><td><{$config.repeat}></td></tr>
                                <tr><th><{$config.text}> position</th><th>$<{$config.name}>_position</th><td><{$config.position}></td></tr>
                                <tr><th><{$config.text}> size</th><th>$<{$config.name}>_size</th><td><{$config.size}></td></tr>
                            <{elseif $config.type|default:false =='custom_zone'}>
                                <tr><th><{$config.text}> bid</th><th>$<{$config.name}>_bid</th><td><{$config.bid}></td></tr>
                                <tr><th><{$config.text}> content</th><th>$<{$config.name}>_content</th><td><{$config.content}></td></tr>
                                <tr><th><{$config.text}> html_content</th><th>$<{$config.name}>_html_content</th><td><{$config.html_content}></td></tr>
                                <tr><th><{$config.text}> html_content_desc</th><th>$<{$config.name}>_html_content_desc</th><td><{$config.html_content_desc}></td></tr>
                                <tr><th><{$config.text}> fa_content</th><th>$<{$config.name}>_fa_content</th><td><{$config.fa_content}></td></tr>
                                <tr><th><{$config.text}> fa_content_desc</th><th>$<{$config.name}>_fa_content_desc</th><td><{$config.fa_content_desc}></td></tr>
                                <tr><th><{$config.text}> menu_content</th><th>$<{$config.name}>_menu_content</th><td><{$config.menu_content}></td></tr>
                                <tr><th><{$config.text}> menu_content_desc</th><th>$<{$config.name}>_menu_content_desc</th><td><{$config.menu_content_desc}></td></tr>
                            <{elseif $config.type|default:false =='padding_margin'}>
                                <tr><th><{$config.text}> margin-top</th><th>$<{$config.name}>_mt</th><td><{$config.mt}></td></tr>
                                <tr><th><{$config.text}> margin-bottom</th><th>$<{$config.name}>_mb</th><td><{$config.mb}></td></tr>
                            <{/if}>
                        <{/foreach}>
                    <{/foreach}>
                    </table>
                </div>
            </div>
        </div>
    </div>

<{/if}>
