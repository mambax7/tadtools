<?php
use XoopsModules\Tadtools\Utility;
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}

//區塊主函式 (tadtools_qrcode)
function tadtools_qrcode($options)
{
    global $xoopsDB;

    $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    Utility::get_jquery();
    $block['url'] = urlencode($protocol . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
    $block['width'] = $options[0] < 50 ? 120 : (int) $options[0];

    return $block;
}

function tadtools_qrcode_edit($options)
{
    $form = "
    <ol class='my-form'>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TT_QRCODE_WIDTH . "</lable>
            <div class='my-content'>
                <input type='text' name='options[0]' value='{$options[0]}' class='my-input' size=5>px
            </div>
        </li>
    </ol>
    ";

    return $form;
}
