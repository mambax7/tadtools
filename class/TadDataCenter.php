<?php
namespace XoopsModules\Tadtools;

use Xmf\Request;
use XoopsModules\Tadtools\CkEditor;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\Utility;

/*

///單一表單
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$form=$TadDataCenter->getForm($mode, $form_tag, $name, $type, $value, $options, $attr, $sort);

///批次表單
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$TadDataCenter->assignBatchForm($form_tag, $data_arr = array(), $type = '', $attr=[])

///儲存資料：
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$TadDataCenter->saveData();
或
$data_arr=[
$data_name => [0 => $data_value],
$data_name => [0 => $data_value],
]
]
$TadDataCenter->saveCustomData($data_arr = array());

///取得資料陣列：
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$data=$TadDataCenter->getData($name,$sort=0);
$xoopsTpl->assign('TDC', $data);
<{$TDC.data_name.0}>

///刪除資料：
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$TadDataCenter->delData($name,$sort);

///-------------------------------------------------------------------------

///後台自訂問卷界面
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$xoopsTpl->assign('CustomSetupForm', $TadDataCenter->getCustomSetupForm($action));
<{$CustomSetupForm}>

///顯示問卷
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$xoopsTpl->assign('CustomForm', $TadDataCenter->getCustomForm($use_form = true, $use_submit = false, $action = '', $lw = 3, $rw = 9));
<{$CustomForm}>

///後台自訂問卷設定儲存
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$TadDataCenter->saveCustomSetupForm();

///前台自訂問卷答案儲存
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$TadDataCenter->saveData();

///自訂表單填答列表（表格）
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$getCustomAns=$TadDataCenter->getCustomAns();

///自訂表單題目
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$CustomSetup      = $TadDataCenter->getCustomSetup();

///自訂表單填答陣列
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$TadDataCenter->set_col($col_name,$col_sn);
$getCustomAnsArr=$TadDataCenter->getCustomAnsArr();

///文字轉表單
use XoopsModules\Tadtools\TadDataCenter;
$TadDataCenter=new TadDataCenter($module_dirname);
$Form = $TadDataCenter->strToForm($str);

資料表：
CREATE TABLE `模組名稱_data_center` (
`mid` mediumint(9) unsigned NOT NULL AUTO_INCREMENT COMMENT '模組編號',
`col_name` varchar(100) NOT NULL DEFAULT '' COMMENT '欄位名稱',
`col_sn` mediumint(9) unsigned NOT NULL DEFAULT '0' COMMENT '欄位編號',
`data_name` varchar(100) NOT NULL DEFAULT '' COMMENT '資料名稱',
`data_value` text NOT NULL COMMENT '儲存值',
`data_sort` mediumint(9) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
`col_id` varchar(100) NOT NULL COMMENT '辨識字串',
`sort` mediumint(9) unsigned COMMENT '顯示順序',
`update_time` datetime NOT NULL COMMENT '更新時間',
PRIMARY KEY (`mid`,`col_name`,`col_sn`,`data_name`,`data_sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

 */

class TadDataCenter
{
    public $col_name;
    public $col_sn;
    public $ans_col_name;
    public $ans_col_sn;
    public $module_dirname;
    public $mid;
    public $TadDataCenterTblName;
    public $col_id;

    public function __construct($module_dirname = '')
    {
        global $xoopsDB;
        if (!empty($module_dirname)) {
            $this->set_module_dirname($module_dirname);
        }

        $this->TadDataCenterTblName = $xoopsDB->prefix("{$this->module_dirname}_data_center");
    }

    //設定模組名稱
    public function set_module_dirname($module_dirname = '')
    {
        $this->module_dirname = $module_dirname;
        $this->set_mid();
    }

    //設定模組編號
    public function set_mid()
    {
        global $xoopsDB, $xoopsModule;
        if ('' != $this->module_dirname) {
            $sql = 'select mid from ' . $xoopsDB->prefix('modules') . " where dirname='{$this->module_dirname}'";
            $result = $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
            list($this->mid) = $xoopsDB->fetchRow($result);
        } elseif ($xoopsModule) {
            $this->mid = $xoopsModule->mid();
        }

        return $this->mid;
    }

    public function set_col($col_name = '', $col_sn = '')
    {
        $this->col_name = $col_name;
        $this->col_sn = $col_sn;
    }

    public function set_var($name = '', $val = '')
    {
        $this->$name = $val;
    }

    public function set_ans_col($ans_col_name = '', $ans_col_sn = '')
    {
        $this->ans_col_name = $ans_col_name;
        $this->ans_col_sn = $ans_col_sn;
    }

    //取得表單
    public function getForm($mode, $form_tag, $name, $type = '', $def_value = '', $options = [], $attr = [], $sort = '', $ans_col_name = '', $ans_col_sn = '')
    {
        global $xoopsTpl;

        if ('checkbox' === $type) {
            $dbv = $this->getData($name, null, $ans_col_name, $ans_col_sn);
            $value = isset($dbv[$name]) ? $dbv[$name] : $def_value;
        } elseif ($sort > 0) {
            $dbv = $this->getData($name, $sort, $ans_col_name, $ans_col_sn);
            $value = isset($dbv[$name]) ? $dbv[$name] : $def_value;
        } else {
            $dbv = $this->getData($name, null, $ans_col_name, $ans_col_sn);
            $value = isset($dbv[$name]) ? $dbv[$name][0] : $def_value;
        }

        if (in_array($type, ['radio', 'checkbox', 'checkbox-radio'])) {
            $defalut_attr = ['id' => $name];
        } else {
            $defalut_attr = ['class' => ['my-input', 'my-100'], 'id' => $name];
        }

        $attr = array_merge_recursive($attr, $defalut_attr);

        $attr_str = '';
        foreach ($attr as $k => $v) {
            $attr_str .= is_array($v) ? " {$k}=\"" . implode(' ', $v) . "\"" : " {$k}=\"{$v}\"";
        }

        $arr = !empty($sort) ? "[$sort]" : '';
        switch ($form_tag) {
            case 'input':
                if ('radio' === $type) {
                    $form = '';
                    foreach ($options as $k => $v) {
                        $checked = $v == $value ? 'checked' : '';
                        $form .= "<div class=\"form-check-inline radio-inline\">
                            <label class=\"form-check-label\">
                                <input class=\"form-check-input\" type=\"{$type}\" name=\"TDC[{$name}]{$arr}\" value=\"{$v}\" {$checked} {$attr_str}>
                                {$k}
                            </label>
                        </div>\n";
                    }
                } elseif ('checkbox' === $type) {
                    $form = '';
                    foreach ($options as $k => $v) {
                        $checked = in_array($v, $value) ? 'checked' : '';
                        $form .= "<div class=\"form-check-inline checkbox-inline\">
                            <label class=\"form-check-label\">
                                <input class=\"form-check-input\" type=\"{$type}\" name=\"TDC[{$name}]{$arr}[]\" value=\"{$v}\" {$checked} {$attr_str}>
                                {$k}
                            </label>
                        </div>\n";
                    }
                } elseif ('checkbox-radio' === $type) {
                    $form = '';
                    foreach ($options as $k => $v) {
                        $checked = in_array($v, $value) ? 'checked' : '';
                        $form .= "<div class=\"form-check-inline checkbox-inline\">
                            <label class=\"form-check-label\">
                                <input class=\"form-check-input\" type=\"checkbox\" name=\"TDC[{$name}]{$arr}\" value=\"{$v}\" {$checked} {$attr_str}>
                                {$k}
                            </label>
                        </div>\n";
                    }
                } elseif ('date' === $type) {
                    include_once XOOPS_ROOT_PATH . '/modules/tadtools/cal.php';
                    $cal = new My97DatePicker();
                    $cal::render();
                    $form = "<input type=\"text\" name=\"TDC[{$name}]{$arr}\" value=\"{$value}\" {$attr_str} onClick=\"WdatePicker({dateFmt:'yyyy-MM-dd', startDate:'%y-%M-%d'})\">";
                } elseif ('' == $type) {
                    $form = "<input type=\"text\" name=\"TDC[{$name}]{$arr}\" value=\"{$value}\" {$attr_str}>";
                } else {
                    $form = "<input type=\"{$type}\" name=\"TDC[{$name}]{$arr}\" value=\"{$value}\" {$attr_str}>";
                }
                break;
            case 'select':
                $options_str = '';
                foreach ($options as $k => $v) {
                    $selected = $k == $value ? 'selected' : '';
                    $options_str .= "<option value=\"{$k}\" {$selected}>{$v}</option>\n";
                }
                $form = "<select name=\"TDC[{$name}]{$arr}\" value=\"{$value}\" {$attr_str}>
                {$options_str}
                </select>";
                break;

            case 'textarea':
                $form = "<textarea name=\"TDC[{$name}]{$arr}\" {$attr_str}>{$value}</textarea>";
                break;

            case 'ckeditor':
                $ck = new CkEditor($this->module_dirname, "TDC[{$name}]{$arr}", $value);
                $ck->setHeight(120);
                $ck->setToolbarSet('tadSimple');
                $form = $ck->render();

                break;

            case 'note':
                $options_str = implode('', $options);
                $form = "<div class='form-control-static'><b>{$options_str}</b></div>";
                break;
        }

        if ($xoopsTpl and 'assign' === $mode) {
            $xoopsTpl->assign($name, $form);
        } else {
            return $form;
        }
    }

    //套用文字框到Smarty
    public function assignBatchForm($form_tag, $data_arr = [], $type = '', $attr = [])
    {
        foreach ($data_arr as $col_name) {
            $this->getForm('assign', $form_tag, $col_name, $type, '', '', $attr);
        }
    }

    //儲存資料 $data[]=['name'=>$name, 'value'=>$value, 'sort'=>$sort]
    public function saveData()
    {
        global $xoopsDB;
        $myts = \MyTextSanitizer::getInstance();

        $TDC = $_POST['TDC'];
        $dc_op = Request::getString('dc_op');
        $sort = 0;
        foreach ($TDC as $name => $value) {
            $name = $myts->addSlashes($name);
            $values = [];

            if (!is_array($value)) {
                $values[0] = $value;
            } else {
                $values = $value;
            }

            $this->delData($name, '', __FILE__, __LINE__);
            foreach ($values as $data_sort => $val) {
                if ('saveCustomSetupForm' === $dc_op and empty($val)) {
                    continue;
                }
                $val = $myts->addSlashes($val);

                $col_id = $this->col_id ? $this->col_id : "{$this->mid}-{$this->col_name}-{$this->col_sn}-{$name}-{$data_sort}";

                $sql = "insert into `{$this->TadDataCenterTblName}`
                (`mid` , `col_name` , `col_sn` , `data_name` , `data_value` , `data_sort`, `col_id`, `sort`, `update_time`)
                values('{$this->mid}' , '{$this->col_name}' , '{$this->col_sn}' , '{$name}' , '{$val}' , '{$data_sort}', '{$col_id}', '{$sort}', now())";
                $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
            }
            $sort++;
        }
    }

    //儲存資料 $data_arr=[$name=>array($sort=>$value)]
    public function saveCustomData($data_arr = [], $mode = '')
    {
        global $xoopsDB;
        $myts = \MyTextSanitizer::getInstance();
        $sort = 0;
        foreach ($data_arr as $name => $value) {
            $name = $myts->addSlashes($name);

            // 若為接續模式，取出目前最大 data_sort
            if ($mode == 'append') {
                $sql = "select max(data_sort) from `{$this->TadDataCenterTblName}` where `mid`='{$this->mid}' and `col_name`='{$this->col_name}' and `col_sn`='{$this->col_sn}' and `data_name`='{$name}'";
                $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
                list($old_data_sort) = $xoopsDB->fetchRow($result);
                $old_data_sort++;
            }
            $values = [];
            if (!is_array($value)) {
                $values[0] = $value;
            } else {
                $values = $value;
            }

            foreach ($values as $data_sort => $val) {
                if ($mode == 'append') {
                    $data_sort += $old_data_sort;
                }
                $v = json_decode($val, true);
                $val = $myts->addSlashes($val);

                $this->delData($name, $data_sort, __FILE__, __LINE__);

                $sql = "insert into `{$this->TadDataCenterTblName}`
                (`mid` , `col_name` , `col_sn` , `data_name` , `data_value` , `data_sort`, `col_id`, `sort`, `update_time`)
                values('{$this->mid}' , '{$this->col_name}' , '{$this->col_sn}' , '{$name}' , '{$val}' , '{$data_sort}', '{$v['col_id']}' , '{$sort}', now())";
                $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
            }
            $sort++;
        }
    }

    //取得資料
    public function getData($name = '', $data_sort = null, $ans_col_name = '', $ans_col_sn = '')
    {
        global $xoopsDB;
        $myts = \MyTextSanitizer::getInstance();
        $and_name = ('' != $name) ? "and `data_name`='{$name}'" : '';
        $and_sort = ('' != $data_sort) ? "and `data_sort`='{$data_sort}'" : '';

        $def_col_name = !empty($ans_col_name) ? $ans_col_name : $this->col_name;
        $def_col_sn = !empty($ans_col_name) ? $ans_col_sn : $this->col_sn;

        $and_col_name = ('' != $def_col_name) ? "and `col_name`='{$def_col_name}'" : '';
        $and_col_sn = ('' != $def_col_sn) ? "and `col_sn`='{$def_col_sn}'" : '';

        $sql = "desc `{$this->TadDataCenterTblName}` `sort`";
        $result = $xoopsDB->queryF($sql);
        $orderby = $xoopsDB->getRowsNum($result) ? "order by `sort` , `data_sort`" : "order by `data_sort`";

        $sql = "select `col_name`,`col_sn`,`data_name`,`data_sort`, `data_value` from `{$this->TadDataCenterTblName}`
            where `mid`= '{$this->mid}' {$and_col_name} {$and_col_sn} {$and_name} {$and_sort} {$orderby}";

        $result = $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
        if (isset($data_sort)) {
            list($col_name, $col_sn, $data_name, $data_sort, $data_value) = $xoopsDB->fetchRow($result);

            return $data_value;
        }
        $values = [];
        while (list($col_name, $col_sn, $data_name, $data_sort, $data_value) = $xoopsDB->fetchRow($result)) {
            if (empty($def_col_sn) and ('' != $name)) {
                $values[$col_sn][$data_sort] = $data_value;
            } else {
                $values[$data_name][$data_sort] = $data_value;
            }
        }

        return $values;
    }

    //取得問卷題目資料
    public function getDcqData($sort = '')
    {
        global $xoopsDB;
        $myts = \MyTextSanitizer::getInstance();
        $and_sort = ('' != $sort) ? "and `data_sort`='{$sort}'" : '';

        $sql = "desc `{$this->TadDataCenterTblName}` `sort`";
        $result = $xoopsDB->queryF($sql);
        $orderby = $xoopsDB->getRowsNum($result) ? "order by `sort` , `data_sort`" : "order by `data_sort`";

        $sql = "select * from `{$this->TadDataCenterTblName}`
                where `mid`= '{$this->mid}' and `col_name`='{$this->col_name}' and `col_sn`='{$this->col_sn}' and `data_name`='dcq' {$and_sort} {$orderby}";

        $result = $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
        if ($sort) {
            $all = $xoopsDB->fetchArray($result);

            return $all;
        }
        $values = [];
        while ($all = $xoopsDB->fetchArray($result)) {
            $data_sort = $all['data_sort'];
            $values[$data_sort] = $all;
        }

        return $values;
    }

    //刪除資料
    public function delData($name = '', $data_sort = '', $file = '', $line = '')
    {
        global $xoopsDB;
        $myts = \MyTextSanitizer::getInstance();
        $and_name = ('' != $name) ? "and `data_name`='{$name}'" : '';
        $and_sort = ('' != $data_sort) ? "and `data_sort`='{$data_sort}'" : '';
        $sql = "delete from `{$this->TadDataCenterTblName}`
            where `mid`= '{$this->mid}' and `col_name`='{$this->col_name}' and `col_sn`='{$this->col_sn}' {$and_name} {$and_sort}";
        // die("$sql ,$file, $line");
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    }

    public function mk_form_group($left_width, $right_width, $label, $form, $input_group = false, $help = '', $require = '')
    {
        $help_text = $help ? '<div><small class="text-muted">' . $help . '</small></div>' : '';
        $ig_tag_start = $input_group ? '<div class="input-group">' : '';
        $ig_tag_body = $input_group ? '<span class="input-group-btn">' . $input_group . '</span>' : '';
        $ig_tag_end = $input_group ? '</div>' : '';
        $require_mark = 1 == $require ? '<span style="display:inline-block; margin-right:4px; color:red;">*</span>' : '';
        $padding_top = '';
        if (strpos($form, 'form-check-inline') !== false) {
            $padding_top = ' style="padding-top: 8px;"';
        }
        $main = '
        <div class="form-group row">
            <label class="col-sm-' . $left_width . ' control-label col-form-label text-md-right">' . $require_mark . $label . '</label>
            <div class="col-sm-' . $right_width . '" ' . $padding_top . '>
            ' . $ig_tag_start . '
            ' . $form . '
            ' . $ig_tag_body . '
            ' . $ig_tag_end . '
            ' . $help_text . '
            </div>
        </div>
        ';

        return $main;
    }

    //$form_arr[]=array('0'=>4,'1'=>'xxx','2'='<input>');
    public function mk_form_group_arr($form_arr, $col_id = '')
    {
        $main = '<ul>';
        foreach ($form_arr as $k => $form) {
            $main .= '
            <li class="vcell">' . $form[1] . '</li>
            <li class="vm w' . $form[0] . '">' . $form[2] . '</li>
            ';
        }
        $main .= '</ul>';

        return $main;
    }

    //從界面取得自訂表單
    public function getCustomSetupForm($action)
    {
        global $xoTheme;
        $action = empty($action) ? $_SERVER['PHP_SELF'] : $action;
        $DcqData = $this->getDcqData();
        $sort = 0;

        if ($xoTheme) {
            $main = '';
            $xoTheme->addStylesheet('modules/tadtools/css/my-input.css');
            $xoTheme->addStylesheet('modules/tadtools/css/vtable.css');
        } else {
            $main = '<link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="' . XOOPS_URL . '/modules/tadtools/css/my-input.css">
            <link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="' . XOOPS_URL . '/modules/tadtools/css/vtable.css">';
        }

        $main .= '
        <script type="text/javascript">
        $(document).ready(function(){
            $("#dcq_sort").sortable({ opacity: 0.6, cursor: "move", update: function() {
                var order = $(this).sortable("serialize");
                $.post("' . XOOPS_URL . '/modules/tadtools/TadDataCenter.php?dcq_op=save_dcq_sort&col_sn=' . $this->col_sn . '&col_name=' . $this->col_name . '&dirname=' . $this->module_dirname . '", order, function(theResponse){
                    $("#save_msg").html(theResponse);
                    location.reload();
                });
            }
            });
        });
        </script>
        <div id="save_msg"></div>
        <form action="' . $action . '" method="post" class="form-horizontal" id="dcq_sort">
        <div class="vtable">
            <ul class="vhead">
            <li class="w1">題號</li>
            <li class="w2">題目</li>
            <li class="w1">說明</li>
            <li class="w1">類型</li>
            <li class="w2">選項</li>
            <li class="w1">必填</li>
            <li class="w1"><span data-toggle="tooltip" data-placement="top" title="給程式讀取用，無須修改，若要修改，影確保其為唯一值">唯一碼</span></li>
            </ul>';
        foreach ($DcqData as $sort => $data) {
            $main .= $this->getCustomSetupCol($sort, $data['data_value'], $data['col_id']);
            $sort++;
        }
        $main .= $this->getCustomSetupCol($sort, '', 'new');
        $main .= '</div>';
        $main .= '<input type="hidden" name="dc_op" value="saveCustomSetupForm">';
        $main .= '<input type="hidden" name="' . $this->col_name . '" value="' . $this->col_sn . '">';
        $main .= '<div class="text-center" style="margin:10px auto;"><button type="submit" class="btn btn-primary">儲存</button></div>';
        $main .= '</form>';

        $SweetAlert = new SweetAlert();
        $SweetAlert->render('del_dcq_col', XOOPS_URL . "/modules/tadtools/TadDataCenter.php?dcq_op=del_dcq_col&col_name={$this->col_name}&col_sn={$this->col_sn}&dirname={$this->module_dirname}&col_id=", 'col_id');

        return $main;
    }

    //取得設定界面的單一欄位
    private function getCustomSetupCol($sort, $json = '', $col_id = '')
    {
        $val = json_decode($json, true);

        $col_type_arr['input=text'] = _TDC_INPUT;
        $col_type_arr['input=radio'] = _TDC_RADIO;
        $col_type_arr['input=checkbox'] = _TDC_CHECKBOX;
        $col_type_arr['input=date'] = _TDC_DATE;
        $col_type_arr['select'] = _TDC_SELECT;
        $col_type_arr['textarea'] = _TDC_TEXTAREA;
        $col_type_arr['note'] = _TDC_NOTE;
        $option = '';
        foreach ($col_type_arr as $type => $text) {
            $selected = $val['type'] == $type ? 'selected' : '';
            $option .= '<option value="' . $type . '" ' . $selected . '>' . $text . '</option>';
        }

        $del = ('new' !== $col_id and $col_id) ? "<a href=\"javascript:del_dcq_col('{$col_id}')\" style='color:red;'><i class='fa fa-trash-o' title='" . _TAD_DEL . "'></i></a> " : '';

        $i = $sort + 1;

        $form_arr[] = [1, '', $del . _TDC_TITLE . $i];

        $form_arr[] = [2, _TDC_TITLE . $i, '<input type="text" name="dcq[' . $sort . '][title]" class="my-input my-100" placeholder="' . _TDC_INPUT_TITLE . '" value="' . $val['title'] . '">'];

        $form_arr[] = [1, _TDC_DESCRIPTION, '<input type="text" name="dcq[' . $sort . '][placeholder]" class="my-input my-100" placeholder="' . _TDC_INPUT_DESCRIPTION . '" value="' . $val['placeholder'] . '">'];

        $form_arr[] = [1, _TDC_TYPE, '<select name="dcq[' . $sort . '][type]" class="my-input my-100">' . $option . '</select>'];
        $form_arr[] = [2, _TDC_OPTIONS, '<input type="text" name="dcq[' . $sort . '][opt]" class="my-input my-100" placeholder="' . _TDC_OPTIONS_NOTE . '" value="' . $val['opt'] . '">'];

        $checked = 1 == $val['require'] ? 'checked' : '';
        $form_arr[] = [1, _TDC_REQUIRE . $i, '<label class="checkbox-inline"><input type="checkbox" name="dcq[' . $sort . '][require]" value="1" ' . $checked . '>' . _TDC_REQUIRE . '</label>'];

        if ('new' === $col_id) {
            $form_arr[] = [1, _TDC_COL_ID, '<input type="hidden" name="dcq[' . $sort . '][col_id]" value="' . $col_id . '">'];
        } else {
            $form_arr[] = [1, _TDC_COL_ID, '<input type="hidden" name="dcq[' . $sort . '][old_col_id]" value="' . $col_id . '"><input type="text" name="dcq[' . $sort . '][col_id]" class="my-input my-100" placeholder="' . _TDC_INPUT_COL_ID . '" value="' . $col_id . '" title="' . _TDC_INPUT_COL_ID . '">'];
        }
        $main = $this->mk_form_group_arr($form_arr, $col_id);

        return $main;
    }

    //儲存自訂表單設定
    public function saveCustomSetupForm()
    {
        $dc_op = Request::getString('dc_op');
        if ('saveCustomSetupForm' === $dc_op) {
            $this->saveDcqData();
            header("location: {$_SERVER['HTTP_REFERER']}");
            exit;
        }
    }

    //儲存自訂問卷資料資料
    private function saveDcqData()
    {
        global $xoopsDB;
        $myts = \MyTextSanitizer::getInstance();

        $dcq = Request::getArray('dcq');
        $dc_op = Request::getString('dc_op');

        foreach ($dcq as $data_sort => $dcq) {
            if ('saveCustomSetupForm' === $dc_op and empty($dcq['title'])) {
                continue;
            }

            $json_val = json_encode($dcq, JSON_UNESCAPED_UNICODE);
            $json_val = $myts->addSlashes($json_val);

            $this->delData('dcq', $data_sort, __FILE__, __LINE__);
            $col_id = (empty($dcq['col_id']) or 'new' === $dcq['col_id']) ? $this->rand_str() : $dcq['col_id'];
            $sql = "insert into `{$this->TadDataCenterTblName}`
                    (`mid` , `col_name` , `col_sn` , `data_name` , `data_value` , `data_sort`, `col_id` , `sort`, `update_time`)
                    values('{$this->mid}' , '{$this->col_name}' , '{$this->col_sn}' , 'dcq' , '{$json_val}' , '{$data_sort}' , '{$col_id}' , '{$sort}' , now())";
            $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
            if ($dcq['col_id'] != $dcq['old_col_id']) {
                $this->update_col_id($dcq['old_col_id'], $dcq['col_id']);
            }
        }
    }

    //更新辨識碼
    private function update_col_id($old_col_id, $new_col_id)
    {
        global $xoopsDB;
        $sql = "update `{$this->TadDataCenterTblName}` set `data_name`='{$this->col_name}_{$this->col_sn}_dcq_{$new_col_id}' where `data_name`='{$this->col_name}_{$this->col_sn}_dcq_{$old_col_id}'";
        // die($sql);
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    }

    //取得自訂表單題目設定
    public function getCustomSetup()
    {
        $DcqData = $this->getDcqData();
        $dcq_arr = [];
        foreach ($DcqData as $sort => $data) {
            $dcq = json_decode($data['data_value'], true);

            list($dcq['form_tag'], $dcq['type']) = explode('=', $dcq['type']);

            $dcq['name'] = "{$this->col_name}_{$this->col_sn}_dcq_{$data['col_id']}";

            $options = explode(';', $dcq['opt']);
            $option_arr = [];
            foreach ($options as $opt) {
                if (false !== mb_strpos($opt, '=')) {
                    list($key, $val) = explode('=', $opt);
                } else {
                    $key = $val = $opt;
                }
                $option_arr[$key] = $val;
            }
            $dcq['option_arr'] = $option_arr;
            $dcq_arr[$sort] = $dcq;
        }

        return $dcq_arr;
    }

    //取得自訂表單
    public function getCustomForm($use_form = true, $use_submit = false, $action = '', $lw = 3, $rw = 9)
    {
        global $xoTheme;
        $action = empty($action) ? $_SERVER['PHP_SELF'] : $action;
        $DcqData = $this->getDcqData();
        $sort = 0;
        $form_col = '';
        foreach ($DcqData as $sort => $data) {
            $dcq = json_decode($data['data_value'], true);
            list($form_tag, $type) = explode('=', $dcq['type']);

            $name = "{$this->col_name}_{$this->col_sn}_dcq_{$data['col_id']}";
            $options = explode(';', $dcq['opt']);
            $option_arr = [];
            foreach ($options as $opt) {
                if (false !== mb_strpos($opt, '=')) {
                    list($key, $val) = explode('=', $opt);
                } else {
                    $key = $val = $opt;
                }
                $option_arr[$key] = $val;
            }

            $require = 1 == $dcq['require'] ? ' validate[required]' : '';
            if (in_array($type, ['radio', 'checkbox', 'checkbox-radio'])) {
                $attr_arr = ['class' => $require, 'id' => $name];
            } else {
                $attr_arr = ['class' => "my-input my-100 $require", 'id' => $name, 'placeholder' => $dcq['placeholder']];
            }
            $col = $this->getForm('return', $form_tag, $name, $type, null, $option_arr, $attr_arr, null, $this->ans_col_name, $this->ans_col_sn);
            $form_col .= $this->mk_form_group($lw, $rw, $dcq['title'], $col, false, $dcq['placeholder'], $dcq['require']);
        }

        if ($form_col) {
            if ($xoTheme) {
                $form = '';
                $xoTheme->addStylesheet('modules/tadtools/css/my-input.css');
            } else {
                $form = '<link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="' . XOOPS_URL . '/modules/tadtools/css/my-input.css">';
            }

            if ($use_form) {
                $FormValidator = new FormValidator('#myForm', false);
                $FormValidator->render('topLeft');
                $form .= '<form action="' . $action . '" id="myForm" method="post" class="form-horizontal"  enctype="multipart/form-data">';
            }
            $form .= $form_col;
            $form .= '
            <input type="hidden" name="' . $this->ans_col_name . '" value="' . $this->ans_col_sn . '">
            <input type="hidden" name="dirname" value="' . $this->module_dirname . '">
            <input type="hidden" name="col_name" value="' . $this->ans_col_name . '">
            <input type="hidden" name="col_sn" value="' . $this->ans_col_sn . '">';
            $form .= $use_submit ? $this->mk_form_group($lw, $rw, '', '<button type="submit" class="btn btn-primary">' . _TAD_SAVE . '</button>') : '';
            $form .= '<input type="hidden" name="dcq_op" value="saveCustomSetupFormVal">';
            $form .= $use_form ? '</form>' : '';

            return $form;
        }
    }

    //已填答案列表： $del_col_name= 'uid'(顯示刪除，並以 uid 為參數) ，$display_mode=vertical
    public function getCustomAns($call_back_func = '', $del_col_name = false, $display_mode = '')
    {
        global $xoTheme;
        $DcqData = $this->getDcqData();
        if ($xoTheme) {
            $xoTheme->addStylesheet('modules/tadtools/css/vtable.css');
            $main = '';
        } else {
            $main = '<link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="' . XOOPS_URL . '/modules/tadtools/css/vtable.css">';
        }

        if ('vertical' === $display_mode) {
            $main .= "<div class='vtable'>";

            foreach ($DcqData as $sort => $data) {
                $dcq = json_decode($data['data_value'], true);
                list($form_tag, $type) = explode('=', $dcq['type']);
                if ('note' === $form_tag) {
                    continue;
                }

                $dcq_title = $dcq['title'];
                $data_name = "{$this->col_name}_{$this->col_sn}_dcq_{$data['col_id']}";
                $ans = $this->getDcqDataArr($data_name);
                // if($_GET['debug']==1){
                //     die(var_export($this->ans_col_sn));
                // }
                $answer = [];
                foreach ($ans as $a) {
                    $answer[] = nl2br(implode('、', $a[$data_name]));
                }
                $dcq_answer = implode(';', $answer);
                $main .= "<ul>
                <li class='w2 vtitle'>$dcq_title</li>
                <li class='w8'>$dcq_answer</li>
                </ul>";
            }

            if ($del_col_name) {
                $main .= "<ul>
                <li class='w2 vtitle'>" . _TAD_FUNCTION . "</li>
                <li class='w8'><li style='text-align: center;'><a href='javascript:del_dcq_ans({$this->col_sn})' style='color:red;'><li class='fa fa-trash-o' title='" . _TAD_DEL . "'></li></li>
                </ul>";
            }
            $main .= '</div>';
        } else {
            $main .= "
            <div class='vtable'>
            <ul class='vhead'>
            <li>" . _TDC_FILL_PEOPLE . '</li>
            ';

            foreach ($DcqData as $sort => $data) {
                $dcq = json_decode($data['data_value'], true);
                list($form_tag, $type) = explode('=', $dcq['type']);
                if ('note' === $form_tag) {
                    continue;
                }
                $dcq_title = $dcq['title'];
                $name[$dcq_title] = "{$this->col_name}_{$this->col_sn}_dcq_{$data['col_id']}";
                $main .= "<li style='text-align: center;'>{$dcq_title}</li>";
            }

            if ($del_col_name) {
                $main .= '<li>' . _TAD_FUNCTION . '</li>';
            }
            $main .= '</ul>';

            $data_name_arr = [];
            $ans = $this->getDcqDataArr($name);
            foreach ($ans as $col_sn => $ans_arr) {
                $title = ($call_back_func) ? call_user_func($call_back_func, $col_sn, $this->col_name, $this->col_sn) : $col_sn;
                $main .= "<ul>
                <li class='vcell'>" . _TDC_FILL_PEOPLE . "</li>
                <li style='text-align: center;'>{$title}</li>";
                // foreach ($ans_arr as $data_name => $value) {
                foreach ($name as $dcq_title => $data_name) {
                    $main .= "<li class='vcell'>{$dcq_title}</li>
                    <li class='text-center'>";
                    $main .= nl2br(implode('、', $ans_arr[$data_name]));
                    $main .= '</li>';

                    $data_name_arr[$data_name] = $data_name;
                }

                if ($del_col_name) {
                    $main .= "<li style='text-align: center;'><a href='javascript:del_dcq_ans({$col_sn})' style='color:red;'><i class='fa fa-trash-o' title='" . _TAD_DEL . "'></i>
                    </a></li>";
                }
                $main .= '</ul>';
            }
            $main .= '</div>';
        }

        if ($del_col_name) {
            $data_name = implode('|', $data_name_arr);
            $SweetAlert = new SweetAlert();
            $SweetAlert->render('del_dcq_ans', XOOPS_URL . "/modules/tadtools/TadDataCenter.php?dcq_op=del_dcq_ans&data_name={$data_name}&dirname={$this->module_dirname}&col_name={$del_col_name}&col_sn=", 'col_ans_sn');
        }

        return $main;
    }

    //已填答案陣列
    public function getCustomAnsArr()
    {
        $DcqData = $this->getDcqData();
        foreach ($DcqData as $sort => $data) {
            $dcq = json_decode($data['data_value'], true);
            list($form_tag, $type) = explode('=', $dcq['type']);
            if ('note' === $form_tag) {
                continue;
            }
            $name[] = "{$this->col_name}_{$this->col_sn}_dcq_{$data['col_id']}";
        }
        $ans = $this->getDcqDataArr($name);

        return $ans;
    }

    //取得填答資料陣列
    public function getDcqDataArr($data_name = '')
    {
        global $xoopsDB;
        $and_col_name = $this->ans_col_name ? "and `col_name`='{$this->ans_col_name}'" : '';
        $and_col_sn = $this->ans_col_sn ? "and `col_sn`='{$this->ans_col_sn}'" : '';
        $values = [];
        if (is_array($data_name)) {
            foreach ($data_name as $name) {
                $sql = "select col_sn, data_sort ,data_value from `{$this->TadDataCenterTblName}`
                    where `mid`= '{$this->mid}' and `data_name`='{$name}' $and_col_name $and_col_sn order by col_sn";
                $result = $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

                while (list($col_sn, $data_sort, $data_value) = $xoopsDB->fetchRow($result)) {
                    $values[$col_sn][$name][$data_sort] = $data_value;
                }
            }
        } else {
            $sql = "select col_sn, data_sort ,data_value from `{$this->TadDataCenterTblName}`
            where `mid`= '{$this->mid}' and `data_name`='{$data_name}' $and_col_name $and_col_sn order by col_sn";
            $result = $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

            while (list($col_sn, $data_sort, $data_value) = $xoopsDB->fetchRow($result)) {
                $values[$col_sn][$data_name][$data_sort] = $data_value;
            }
        }

        return $values;
    }

    // 文字轉表單
    public function strToForm($str = '')
    {
        global $xoTheme;
        if ($xoTheme) {
            $main = '';
            $xoTheme->addStylesheet('modules/tadtools/css/my-input.css');
        } else {
            $main = '<link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="' . XOOPS_URL . '/modules/tadtools/css/my-input.css">';
        }

        $setups = \explode("\n", $str);
        $sort = 0;
        foreach ($setups as $setup) {
            $setup = \trim($setup);
            $cols = \explode(",", $setup);
            $options = $attrs = [];
            $type = $help = $other = '';
            $require = '';
            $sort++;
            unset($value);
            foreach ($cols as $i => $col) {
                if (\strpos($col, '#') !== false) {
                    $help = \str_replace('#', '', $col);
                } elseif ($i == 0) {
                    $label = $col;
                    if (\strpos($label, '*') !== false) {
                        $require = 1;
                        $attrs['class'][] = 'validate[required]';
                        $label = \str_replace('*', '', $label);
                    }
                } elseif ($i == 1) {
                    switch ($cols[1]) {
                        case 'radio':
                            $form_tag = 'input';
                            $type = 'radio';
                            break;
                        case 'checkbox':
                            $form_tag = 'input';
                            $type = 'checkbox';
                            break;
                        case 'select':
                            $form_tag = 'select';
                            $type = 'select';
                            break;
                        case 'textarea':
                            $form_tag = 'textarea';
                            $type = 'textarea';
                            break;
                        case 'hidden':
                            $form_tag = 'input';
                            $type = 'hidden';
                            break;
                        case 'const':
                            $form_tag = 'input';
                            $type = 'hidden';
                            break;
                        default:
                            $form_tag = 'input';
                            $type = 'text';
                            break;
                    }
                } else {
                    if (\strpos($col, '+') !== false) {
                        $col = \str_replace('+', '', $col);
                        if ($type == 'checkbox') {
                            $value[] = $col;
                        } else {
                            $value = $col;
                        }
                    } elseif ($cols[1] == 'const') {
                        $other = $value = $col;
                    } elseif ($cols[1] == 'hidden') {
                        $value = $col;
                    }

                    if (\in_array($type, ['select', 'radio', 'checkbox'])) {
                        $options[$col] = $col;
                    } elseif (strpos($col, '=') !== false) {
                        list($k, $v) = explode('=', $col);
                        $attrs[$k] = $v;
                    }
                }
            }

            $form = $this->getForm('return', $form_tag, $label, $type, $value, $options, $attrs) . $other;
            $main .= $this->mk_form_group(2, 10, $label, $form, false, $help, $require);
        }
        return $main;
    }

    private function rand_str($len = 6, $format = 'ALL')
    {
        switch ($format) {
            case 'ALL':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
            case 'CHAR':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                break;
            case 'NUMBER':
                $chars = '0123456789';
                break;
            default:
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
        }
        list($usec, $sec) = explode(' ', microtime());
        $seed = (float) $sec + ((float) $usec * 100000);
        // die('seed=' . $seed);
        mt_srand($seed);
        $password = '';
        while (mb_strlen($password) < $len) {
            $password .= mb_substr($chars, (mt_rand() % mb_strlen($chars)), 1);
        }

        return $password;
    }
}

if (isset($_REQUEST['dcq_op'])) {
    include_once '../../mainfile.php';

    $dcq_op = Request::getString('dcq_op');
    $dirname = Request::getString('dirname');
    $col_name = Request::getString('col_name');
    $col_sn = Request::getInt('col_sn');
    $data_name = Request::getString('data_name');

    if ('save_dcq_sort' === $dcq_op) {
        $col_ids = Request::getArray('col_id');
        $sql = 'update ' . $xoopsDB->prefix("{$dirname}_data_center") . " set `data_sort`=`data_sort`+1000 where  `col_name`='{$col_name}' and `col_sn`='{$col_sn}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')' . $sql);

        $sort = 0;
        foreach ($col_ids as $col_id) {
            $sql = 'update ' . $xoopsDB->prefix("{$dirname}_data_center") . " set `data_sort`='{$sort}' where col_id='{$col_id}' and `col_name`='{$col_name}' and `col_sn`='{$col_sn}'";
            $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')' . $sql);
            $sort++;
        }
        echo _TAD_SORTED . '(' . date('Y-m-d H:i:s') . ')';
    } elseif ('del_dcq_ans' === $dcq_op and $_SESSION['isAdmin']) {
        $data_name_arr = explode('|', $data_name);
        foreach ($data_name_arr as $data_name) {
            $sql = 'delete from ' . $xoopsDB->prefix("{$dirname}_data_center") . " where `data_name`='{$data_name}' and `col_name`='{$col_name}' and `col_sn`='{$col_sn}'";
            $xoopsDB->queryF($sql) or die(' (' . date('Y-m-d H:i:s') . ')' . $sql);
        }
        header("location:{$_SERVER['HTTP_REFERER']}");
        exit;
    } elseif ('del_dcq_col' === $dcq_op and $_SESSION['isAdmin']) {
        $col_id = Request::getString('col_id');

        $sql = 'delete from ' . $xoopsDB->prefix("{$dirname}_data_center") . " where `col_id`='{$col_id}'";
        $xoopsDB->queryF($sql) or die(' (' . date('Y-m-d H:i:s') . ')' . $sql);
        $sql = 'delete from ' . $xoopsDB->prefix("{$dirname}_data_center") . " where `data_name`='{$col_name}_{$col_sn}_dcq_{$col_id}'";
        $xoopsDB->queryF($sql) or die(' (' . date('Y-m-d H:i:s') . ')' . $sql);
        header("location:{$_SERVER['HTTP_REFERER']}");
        exit;
    } elseif ('saveCustomSetupFormVal' === $dcq_op) {
        $TadDataCenter = new TadDataCenter($dirname);
        $TadDataCenter->set_col($col_name, $col_sn);
        $TadDataCenter->saveData();
        // header("location:{$_SERVER['HTTP_REFERER']}");
        // exit;
    }
}
