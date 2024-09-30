<?php

global $xoopsConfig;

$modversion = [];
global $xoopsConfig;
$modversion['name'] = _MI_TADTOOLS_NAME;
$modversion['version'] = $_SESSION['xoops_version'] >= 20511 ? '4.0.0-Stable' : '4.0';
// $modversion['version'] = '3.55';
$modversion['description'] = _MI_TADTOOLS_DESC;
$modversion['author'] = 'Tad (tad0616@gmail.com)';
$modversion['credits'] = '';
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0 or later';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image'] = $xoopsConfig['language'] == 'tchinese_utf8' ? 'images/logo_tw.png' : 'images/logo.png';
$modversion['dirname'] = basename(__DIR__);
$modversion['dirmoduleadmin'] = '/Frameworks/moduleclasses/moduleadmin';
$modversion['icons16'] = '../../Frameworks/moduleclasses/icons/16';
$modversion['icons32'] = '../../Frameworks/moduleclasses/icons/32';

//about
$modversion['module_status'] = 'Final';
$modversion['release_date'] = '2023-10-17';
$modversion['module_website_url'] = 'https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=1';
$modversion['module_website_name'] = 'XOOPS EZGO';
$modversion['author_website_url'] = 'https://www.tad0616.net';
$modversion['author_website_name'] = 'Tad';
$modversion['min_php'] = '5.4';
$modversion['min_xoops'] = '2.5.7';
$modversion['min_db'] = [
    'mysql' => '5.0.7',
    'mysqli' => '5.0.7',
];

//---paypal資訊---//
$modversion['paypal'] = [];
$modversion['paypal']['business'] = 'tad0616@gmail.com';
$modversion['paypal']['item_name'] = 'Donation : ' . _MI_TADTOOLS_DESC;
$modversion['paypal']['amount'] = 0;
$modversion['paypal']['currency_code'] = 'TWD';

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][1] = 'tadtools_setup';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---使用者主選單設定---//
$modversion['hasMain'] = 1;

//---安裝設定---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

//---樣板設定---//
$i = 1;
$modversion['templates'][$i]['file'] = 'tadtools_adm_index.tpl';
$modversion['templates'][$i]['description'] = 'tadtools_adm_index.tpl';

//---偏好設定---//
$i = 1;
$modversion['config'][$i]['name'] = 'auto_charset';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_TITLE5';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS_DESC5';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '1';

$i++;
$modversion['config'][$i]['name'] = 'syntaxhighlighter_themes';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_TITLE6';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS_DESC6';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'shThemeMonokai';
$modversion['config'][$i]['options'] = ['shThemeDefault' => 'shThemeDefault', 'shThemeDjango' => 'shThemeDjango', 'shThemeEclipse' => 'shThemeEclipse', 'shThemeEmacs' => 'shThemeEmacs', 'shThemeFadeToGrey' => 'shThemeFadeToGrey', 'shThemeMDUltra' => 'shThemeMDUltra', 'shThemeMidnight' => 'shThemeMidnight', 'shThemeRDark' => 'shThemeRDark', 'shThemeMonokai' => 'shThemeMonokai'];

$i++;
$modversion['config'][$i]['name'] = 'syntaxhighlighter_version';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_TITLE7';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS_DESC7';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'syntaxhighlighter';
$modversion['config'][$i]['options'] = ['syntaxhighlighter 2' => 'syntaxhighlighter_2', 'syntaxhighlighter 3' => 'syntaxhighlighter'];

$i++;
$modversion['config'][$i]['name'] = 'uploadcare_publickey';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_TITLE8';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS_DESC8';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';

$i++;
$modversion['config'][$i]['name'] = 'use_codemirror';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_USE_CODEMIRROR';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS_USE_CODEMIRROR_DESC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '1';

$i++;
$modversion['config'][$i]['name'] = 'image_max_width';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_IMAGE_MAX_WIDTH';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS_IMAGE_MAX_WIDTH_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '1920';

$i++;
$modversion['config'][$i]['name'] = 'image_max_height';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_IMAGE_MAX_HEIGHT';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS_IMAGE_MAX_HEIGHT_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '1920';

$i++;
$modversion['config'][$i]['name'] = 'insert_spacing';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_INSERT_SPACING';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS_INSERT_SPACING_DESC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '0';

$i++;
$modversion['config'][$i]['name'] = 'linkify';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_LINKIFY';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS__MI_TADTOOLS_LINKIFY_DESC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '1';

$i++;
$modversion['config'][$i]['name'] = 'pdf_force_dl';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_PDF_FORCE_DL';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS__MI_TADTOOLS_PDF_FORCE_DL_DESC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '0';

$i++;
$modversion['config'][$i]['name'] = 'test_mode';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_TEST_MODE';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS_TEST_MODE_DESC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '1';

$i++;
$modversion['config'][$i]['name'] = 'facebook_app_id';
$modversion['config'][$i]['title'] = '_MI_TADTOOLS_FACEBOOK_APP_ID';
$modversion['config'][$i]['description'] = '_MI_TADTOOLS_FACEBOOK_APP_ID_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';

$i = 0;
$modversion['blocks'][$i]['file'] = 'tadtools_qrcode.php';
$modversion['blocks'][$i]['name'] = _MI_TADTOOLS_QRCODE_BLOCK_NAME;
$modversion['blocks'][$i]['description'] = _MI_TADTOOLS_QRCODE_BLOCK_DESC;
$modversion['blocks'][$i]['show_func'] = 'tadtools_qrcode';
$modversion['blocks'][$i]['template'] = 'tadtools_qrcode_block.tpl';
$modversion['blocks'][$i]['edit_func'] = 'tadtools_qrcode_edit';
$modversion['blocks'][$i]['options'] = '120';

$i++;
$modversion['blocks'][$i]['file'] = 'tadtools_app.php';
$modversion['blocks'][$i]['name'] = _MI_TADTOOLS_APP_BLOCK_NAME;
$modversion['blocks'][$i]['description'] = _MI_TADTOOLS_APP_BLOCK_DESC;
$modversion['blocks'][$i]['show_func'] = 'tadtools_app';
$modversion['blocks'][$i]['template'] = 'tadtools_app_block.tpl';
$modversion['blocks'][$i]['edit_func'] = 'tadtools_app_edit';
$modversion['blocks'][$i]['options'] = '120|v';
