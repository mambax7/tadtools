<?php

namespace XoopsModules\Tadtools;

use XoopsModules\Tadtools\Utility;

class Jeditable
{
    public $cols;
    public $show_jquery;

    //建構函數
    public function __construct($show_jquery = true)
    {
        $this->show_jquery = $show_jquery;
    }

    //設定文字欄位 $submitdata="{'sn':$the_sn}
    public function setTextCol($selector, $file, $width = '100%', $height = '12px', $submitdata = '', $tooltip = '')
    {
        $submitdata_set = (empty($submitdata)) ? '' : "submitdata:$submitdata,";
        $this->cols[] = "
        $('$selector').editable('$file', {
            type : 'text',
            indicator : 'Saving...',
            width: '$width',
            height: '$height',
            $submitdata_set
            onblur:'submit',
            event: 'click',
            style   : 'display: inline',
            placeholder : '{$tooltip}'
        });";
    }

    //設定大量文字欄位 $submitdata="{'sn':$the_sn}
    public function setTextAreaCol($selector, $file, $width = '100%', $height = '50px', $submitdata = '', $tooltip = '')
    {
        $submitdata_set = (empty($submitdata)) ? '' : "submitdata:$submitdata,";
        $this->cols[] = "
        $('$selector').editable('$file', {
            type : 'textarea',
            indicator : 'Saving...',
            width: '$width',
            height: '$height',
            $submitdata_set
            onblur:'submit',
            event: 'click',
            style   : 'display: inline',
            placeholder : '{$tooltip}'
        });";
    }

    //設定下拉欄位 $submitdata="{'sn':$the_sn},$data="{'男生':'男生' , '女生':'女生'}";
    public function setSelectCol($selector, $file, $data = '', $submitdata = '', $tooltip = '')
    {
        $submitdata_set = (empty($submitdata)) ? '' : "submitdata:$submitdata,";
        $this->cols[] = "
        $('$selector').editable('$file', {
            type : 'select',
            indicator : 'Saving...',
            data   : \"{$data}\",
            $submitdata_set
            onblur:'submit',
            event: 'click',
            style   : 'display: inline',
            placeholder : '{$tooltip}'
        });";
    }

    //產生路徑工具
    public function render($mode = '')
    {
        global $xoTheme;

        if (is_array($this->cols)) {
            $all_col = implode("\n", $this->cols);
        }
        $jquery = ($this->show_jquery) ? Utility::get_jquery() : '';

        if ($xoTheme and 'force' !== $mode) {
            $xoTheme->addScript('modules/tadtools/jeditable/jquery.jeditable.mini.js');

            $xoTheme->addScript('', null, "
                (function(\$){
                    \$(document).ready(function(){
                    {$all_col}
                    });
                })(jQuery);
            ");
        } else {
            $main = "
            $jquery
            <script src='" . XOOPS_URL . "/modules/tadtools/jeditable/jquery.jeditable.mini.js' type='text/javascript' language='JavaScript'></script>
            <script type='text/javascript'>
                $(document).ready(function()
                {
                $all_col
                })
            </script>";

            return $main;
        }
    }
}

/*
use XoopsModules\Tadtools\Jeditable;
$file="save.php";
$jeditable = new Jeditable();
$jeditable->setTextCol("#candidate_note",$file,'140px','12px',"{'vote_sn':$vote_sn,'candidate_id':'$candidate_id','op' : 'save'}","編輯備註");
$jeditable->setTextAreaCol("#id",$file,'140px','12px',"{'sn':$sn,'op' : 'save'}","點擊編輯");
$jeditable->setSelectCol("#id",$file,"{'boy':'男生' , 'girl':'女生' , 'selected':'girl'}","{'sn' : $sn , 'op' : 'save'}","點擊編輯");
$jeditable->render();

<?php
include "header.php";
$sql = 'UPDATE `' . $xoopsDB->prefix("vote_candidate") . '` SET `candidate_note` = ? WHERE `vote_sn` = ? AND `candidate_id` = ?';
Utility::query($sql, 'sss', [$_POST['value'], $_POST['vote_sn'], $_POST['candidate_id']]);
echo $_POST['value'];
?>

 */
