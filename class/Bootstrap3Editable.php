<?php

namespace XoopsModules\Tadtools;

use XoopsModules\Tadtools\Utility;

class Bootstrap3Editable
{
    public $show_jquery;

    //建構函數
    public function __construct($show_jquery = true)
    {
        $this->show_jquery = $show_jquery;
    }

    //產生語法
    public function render($name = '.editable', $url = '')
    {
        global $xoTheme;

        $jquery = $this->show_jquery ? Utility::get_jquery() : '';

        // if ($xoTheme) {
        //     $xoTheme->addStylesheet("modules/tadtools/bootstrap{$_SESSION['bootstrap']}-editable/css/bootstrap-editable.css");
        //     $xoTheme->addScript("modules/tadtools/bootstrap{$_SESSION['bootstrap']}-editable/js/bootstrap-editable.min.js");

        //     if ($url) {
        //         $xoTheme->addScript('', null, "\$(document).ready(function(){
        //             \$('{$name}').editable({url: '$url'});
        //         });");
        //     }
        // } else {
        if (!isset($_SESSION['bootstrap'])) {
            $_SESSION['bootstrap'] = 3;
        }

        $main = "
        {$jquery}
        <link href='" . XOOPS_URL . "/modules/tadtools/bootstrap{$_SESSION['bootstrap']}-editable/css/bootstrap-editable.css' rel='stylesheet'>
        <script src='" . XOOPS_URL . "/modules/tadtools/bootstrap{$_SESSION['bootstrap']}-editable/js/bootstrap-editable.js'></script>
        ";

        if (is_array($name)) {
            $editable = '';
            foreach ($name as $name_item) {
                $editable .= "$('{$name_item}').editable({url: '$url'});\n";
            }
        } else {
            $editable = "$('{$name}').editable({url: '$url'});";
        }

        if ($url) {
            $main .= "
            <script type='text/javascript'>
                $(document).ready(function(){
                    {$editable}
                });
            </script>
            ";
        }

        return $main;
        // }
    }
}

/*
這要放在網頁最後面才有效

use XoopsModules\Tadtools\Bootstrap3Editable;
$Bootstrap3Editable=new Bootstrap3Editable();
$Bootstrap3EditableCode=$Bootstrap3Editable->render('.editable','ajax.php');
$xoopsTpl->assign('Bootstrap3EditableCode', $Bootstrap3EditableCode);

http://vitalets.github.io/x-editable/docs.html
<a href="#" class="editable" data-name="username" data-type="text" data-pk="1" data-title="Enter username" data-params="{op: 'en'}">superuser</a>

type ：輸入類型 (text, textarea, select)
pk ：主索引的值，也可以這樣寫 {id: 1, lang: 'en'}
id or name ：主索引的名稱
value ：預設值，如果是空白，就是以原本內容為主

 */
