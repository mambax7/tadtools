<?php
require_once __DIR__ . '/admin_common.php';

define('_MA_TT_SAVE', '儲存設定');
define('_MA_TT_EMPTY_CONFIG', '尚未設定');
define('_MA_TT_NEED_BOOTSTRAP', '當使用此佈景時，模組是否需要載入bootstrap框架？');
define('_MA_TT_VERSION', 'Tad Tools 的版本為：');
define('_MA_TT_THEMES', '目前允許使用的佈景（紅色為預設佈景）');
define('_MA_TT_BOOTSTRAP_COLOR', '套用BootStrap顏色');
define('_TT_COLOR_NORMAL', '正常');
define('_TT_COLOR_DARK', '深色');
define('_TT_COLOR_DEFAULT', '預設');
define('_MA_TT_THEMES_KIND', '佈景種類');
define('_MA_TT_TAD_THEMES', '支援 tad themes，已內建 BootStrap');
define('_MA_TT_THEMES_NOTE', '若發現有重複佈景，請至<a href="' . XOOPS_URL . '/modules/system/admin.php?fct=preferences&op=show&confcat_id=1">一般設定</a>，重新按一下儲存即可');
define('_TAD_MKFILE_ERROR', ' 無法建立 %s 檔案，請確定目錄有寫入權限（777）');
