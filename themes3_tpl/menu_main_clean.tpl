<{if $auto_mainmenu|default:false}>
    <li>
        <a href="index.php">
            <{if $auto_mainmenu_icon|default:false}><span class="<{if $auto_mainmenu_icon|substr:0:3=='fa-'}>fa <{/if}><{$auto_mainmenu_icon|default:''}>"></span><{/if}>
            <{$smarty.const.THEME_MODULE0}>
        </a>
        <ul>
            <{foreach from=$main_menu_var item=menu}>
                <li><a href="<{$menu.url}>" target="<{$menu.target}>"><span class="<{if $menu.icon|substr:0:3=='fa-'}>fa <{/if}><{$menu.icon}>"></span> <{$menu.title}></a></li>
            <{/foreach}>
        </ul>
    </li>
<{/if}>