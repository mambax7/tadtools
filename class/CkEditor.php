<?php
namespace XoopsModules\Tadtools;

use XoopsModules\Tadtools\Utility;

class CkEditor
{
    public $xoopsDirName;
    public $ColName;
    public $ColID;
    public $CustomConfigurationsPath;
    public $ToolbarSet = 'my';
    public $Width      = '100%';
    public $Height     = 300;
    public $Value;
    public $ContentsCss   = [];
    public $demopublickey = '';
    public $subDir        = '';
    public $Style         = [];
    public $Modal_ID      = '';
    public $placeholder   = '';

    //建構函數
    public function __construct($xoopsDirName = '', $ColName = '', $Value = '', $subDir = '')
    {
        $TadToolsModuleConfig = Utility::TadToolsXoopsModuleConfig();
        $this->xoopsDirName   = $xoopsDirName;
        $this->ColName        = $ColName;
        $this->ColID          = "editor_{$ColName}";
        $this->Value          = $Value;
        $this->subDir         = $subDir;
        if (! empty($TadToolsModuleConfig['uploadcare_publickey'])) {
            $this->set_demopublickey($TadToolsModuleConfig['uploadcare_publickey']);
        }
    }

    //設定自定義設定檔
    public function setCustomConfigurationsPath($path = '')
    {
        $this->CustomConfigurationsPath = $path;
    }

    //設定自定義工具列（$ToolbarSet 預設為 my，可選：myBasic、tadBasic、mySimple、tadSimple）
    public function setToolbarSet($ToolbarSet = '')
    {
        $this->ToolbarSet = $ToolbarSet;
    }

    //設定自定義設寬度
    public function setWidth($Width = '')
    {
        $this->Width = $Width;
    }

    //設定自定義設高度
    public function setHeight($Height = '')
    {
        $this->Height = $Height;
    }

    //設定自定義設高度
    public function setVar($var = '', $val = '')
    {
        $this->$var = $val;
    }

    //新增樣式
    public function setContentCss($ContentsCss = '')
    {
        $this->ContentsCss[] = $ContentsCss;
    }

    //新增樣式 stylesSet :
    public function setStyle($name, $element, $attributes = [], $styles = [])
    {
        $Style['name']    = $name;
        $Style['element'] = $element;
        if ($attributes) {
            $Style['attributes'] = $attributes;
        }
        if ($styles) {
            $Style['styles'] = $styles;
        }
        $this->Style[] = $Style;
    }

    private function getStyle()
    {
        $this->setStyle('陰影標題h2', 'h2', [], ['text-shadow' => '1px 1px 1px #aaaaaa']);
        $this->setStyle('陰影標題h3', 'h3', [], ['text-shadow' => '1px 1px 1px #aaaaaa']);
        $this->setStyle('Info 提示框', 'div', ['class' => 'alert alert-info']);
        $this->setStyle('Success 提示框', 'div', ['class' => 'alert alert-success']);
        $this->setStyle('Warning 提示框', 'div', ['class' => 'alert alert-warning']);
        $this->setStyle('Danger 提示框', 'div', ['class' => 'alert alert-danger']);
        $this->setStyle('自適應圖片', 'img', ['class' => 'img-responsive img-fluid'], ['height' => 'auto']);
        $this->setStyle('自適應圖框', 'img', ['class' => 'img-responsive img-thumbnail img-fluid'], ['height' => 'auto']);
        $this->setStyle('語法', 'code');
        $this->setStyle('按鍵', 'kbd');

        $this->setStyle('清單「壹、貳」', 'ol', ['class' => 'big-tw'], []);
        $this->setStyle('清單「一、二」', 'ol', ['class' => 'small-tw'], []);
        $this->setStyle('清單「(一)、(二)」', 'ol', ['class' => 'brackets-tw'], []);
        $this->setStyle('清單「1.、2.」', 'ol', ['class' => 'dot-num'], []);
        $this->setStyle('清單「(1)、(2)」', 'ol', ['class' => 'brackets-num'], []);

        $this->setStyle('Secondary 徽章', 'span', ['class' => 'label label-default badge badge-secondary bg-secondary']);
        $this->setStyle('Primary 徽章', 'span', ['class' => 'label label-primary badge badge-primary bg-primary']);
        $this->setStyle('Success 徽章', 'span', ['class' => 'label label-success badge badge-success bg-success']);
        $this->setStyle('Info 徽章', 'span', ['class' => 'label label-info badge badge-info bg-info']);
        $this->setStyle('Warning 徽章', 'span', ['class' => 'label label-warning badge badge-warning bg-warning']);
        $this->setStyle('Danger 徽章', 'span', ['class' => 'label label-danger badge badge-danger bg-danger']);
        $this->setStyle('Light 徽章', 'span', ['class' => 'label label-default badge badge-light bg-light']);
        $this->setStyle('Dark 徽章', 'span', ['class' => 'label label-default badge badge-dark bg-dark']);

        $defStyle = json_encode($this->Style, 256);
        return str_replace('"', "'", "stylesSet : {$defStyle},");
    }

    public function set_demopublickey($demopublickey = '')
    {
        $this->demopublickey = $demopublickey;
    }

    //產生編輯器
    public function render()
    {
        global $xoTheme, $TadToolsModuleConfig;

        Utility::get_jquery();
        $_SESSION['xoops_mod_name'] = $this->xoopsDirName;
        $placeholder                = $this->placeholder ? "editorplaceholder: '{$this->placeholder}'," : "";
        $stylesSet                  = $this->getStyle();
        // die($stylesSet);
        // before being fed to the textarea of CKEditor
        $content = str_replace('&', '&amp;', $this->Value);
        $content = str_replace('[', '&#91;', $content);

        if ($xoTheme) {
            $editor = '';
            $xoTheme->addScript('modules/tadtools/ckeditor/ckeditor.js');
        } else {
            $editor = "
            <script type='text/javascript' src='" . XOOPS_URL . "/modules/tadtools/ckeditor/ckeditor.js'></script>";
        }

        $other_css = '';
        if ($this->ContentsCss) {
            $other_css = ",'" . implode("','", $this->ContentsCss) . "'";
        }

        $demopublickey_js = $extra_uploadcare = $uploadcare_setup = '';
        // if ($this->demopublickey) {
        //     $demopublickey_js = "UPLOADCARE_PUBLIC_KEY = '{$this->demopublickey}',";
        //     $extra_uploadcare = ',uploadcare';
        //     $uploadcare_setup = '
        //         uploadcare: {
        //             multiple: true
        //         },';
        // }

        $TadToolsModuleConfig = Utility::TadToolsXoopsModuleConfig();
        $codemirror           = $TadToolsModuleConfig['use_codemirror'] ? ',codemirror' : '';

        $bs = $_SESSION['bootstrap'] ? $_SESSION['bootstrap'] : 4;

        $editor_setup = "{$demopublickey_js}
        CKEDITOR.replace('{$this->ColID}' , {
        skin : 'moono' ,
        width : '{$this->Width}' ,
        height : '{$this->Height}' ,
        language : '" . _LANGCODE . "' ,
        toolbar : '{$this->ToolbarSet}' ,
        $stylesSet
        contentsCss : ['" . XOOPS_URL . "/modules/tadtools/bootstrap{$bs}/css/bootstrap.css', '" . XOOPS_URL . "/modules/tadtools/css/fonts.css', '" . XOOPS_URL . "/modules/tadtools/css/ckeditor.css', '" . XOOPS_URL . "/modules/tadtools/css/fontawesome6/css/all.min.css'{$other_css}],
        extraPlugins: 'editorplaceholder,pasteUploadImage,sourcearea,font,syntaxhighlight,dialog,eqneditor,quicktable,imagerotate,fakeobjects,widget,lineutils,widgetbootstrap,widgettemplatemenu,pagebreak,ckeditorfa,prism,codesnippet,undo,autoembed,autolink,clipboard,toolbar,button,dialogui,notification,textmatch,embed,embedbase,widgetselection,notificationaggregator,embedsemantic,panel,floatpanel,menu{$codemirror}{$extra_uploadcare}',
        {$uploadcare_setup}
        pasteFilter: 'plain-text',
        filebrowserBrowseUrl : '" . XOOPS_URL . '/modules/tadtools/elFinder/elfinder.php?type=file&subDir=' . $this->subDir . '&mod_dir=' . $this->xoopsDirName . "',
        filebrowserImageBrowseUrl : '" . XOOPS_URL . '/modules/tadtools/elFinder/elfinder.php?type=image&subDir=' . $this->subDir . '&mod_dir=' . $this->xoopsDirName . "',

        pasteUploadFileApi: '" . XOOPS_URL . '/modules/tadtools/upload.php?type=image&subDir=' . $this->subDir . '&mod_dir=' . $this->xoopsDirName . "',
        pasteUploadImageUrlApi: '" . XOOPS_URL . '/modules/tadtools/upload.php?type=image&subDir=' . $this->subDir . '&mod_dir=' . $this->xoopsDirName . "',
        $placeholder
        qtRows: 10, // Count of rows
        qtColumns: 10, // Count of columns
        qtBorder: '1', // Border of inserted table
        qtWidth: '100%', // Width of inserted table
        qtStyle: { 'border-collapse' : 'collapse' },
        qtClass: 'table table-bordered table-hover table-condensed table-sm', // Class of table
        qtCellPadding: '0', // Cell padding table
        qtCellSpacing: '0', // Cell spacing table
        qtPreviewBorder: '1px double black', // preview table border
        qtPreviewSize: '15px', // Preview table cell size
        qtPreviewBackground: '#c8def4' // preview table background (hover)
        } );";

        if ($this->Modal_ID != '') {
            $editor_setup = "
            $(document).on('click', '#btn{$this->Modal_ID}', function(e){
                \$('#{$this->Modal_ID}').modal('show');
                $editor_setup
            });
            ";
        }

        $editor .= "
        <textarea name='{$this->ColName}' id='{$this->ColID}' class='ckeditor_css'>{$content}</textarea>
        <script type='text/javascript'>
        $editor_setup
        </script>
        ";

        return $editor;
    }
}

/*
use XoopsModules\Tadtools\CkEditor;
$CkEditor=new CkEditor("tadnews","news_content",$news_content);
$CkEditor->setHeight(350);
$editor=$CkEditor->render();
 */
