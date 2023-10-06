<?php

namespace XoopsModules\Tadtools;

use XoopsModules\Tadtools\Utility;

class TreeTable
{
    public $tbl_id;
    public $show_jquery;
    public $post_url;
    public $folder_class;
    public $sn;
    public $of_sn;
    public $msg;
    public $sort_id;
    public $sort_url;
    public $sort_msg;
    public $expanded;

    //建構函數
    public function __construct($show_jquery = true, $sn = 'cat_sn', $of_sn = 'of_cat_sn', $tbl_id = '#tbl', $post_url = '', $folder_class = '.folder', $msg = '#save_msg', $expanded = true, $sort_id = '', $sort_url = 'save_sort.php', $sort_msg = '#save_msg2')
    {
        $this->show_jquery = $show_jquery;
        $this->tbl_id = $tbl_id;
        $this->post_url = $post_url;
        $this->folder_class = $folder_class;
        $this->sn = $sn;
        $this->of_sn = $of_sn;
        $this->msg = $msg;
        $this->sort_id = $sort_id;
        $this->sort_url = $sort_url;
        $this->sort_msg = $sort_msg;
        $this->expanded = $expanded;
    }

    //產生路徑工具
    public function render($tag = "tr")
    {
        global $xoTheme;

        $jquery = ($this->show_jquery) ? Utility::get_jquery(true) : '';

        $expanded = ($this->expanded) ? ",initialState: 'expanded'" : '';

        $sort_code = '';
        if (!empty($this->sort_id)) {
            $sort_code = "
            $('{$this->sort_id}').sortable({
                opacity: 0.6,
                cursor: 'move',
                axis:'y',
                update: function(e, ui) {
                    var href = '{$this->sort_url}';
                    $(this).sortable('refresh');
                    var sorted = $(this).sortable('serialize','id');
                    $.ajax({
                        type:   'POST',
                        url:    href,
                        data:   sorted,
                        success: function(msg) {
                            $('{$this->sort_msg}').html(msg);
                        }
                    });
                }
            });";
        }

        $drag_code = '';
        if (!empty($this->post_url)) {
            $drag_code = "
            // Configure draggable nodes
            $('{$this->tbl_id} {$this->folder_class}').draggable({
                helper: 'clone',
                opacity: .75,
                refreshPositions: true, // Performance?
                revert: 'invalid',
                revertDuration: 300,
                scroll: true
            });

            // Configure droppable rows
            $('{$this->tbl_id} {$this->folder_class}').each(function() {
                $(this).parents('{$this->tbl_id} {$tag}').droppable({
                accept: '{$this->folder_class}',
                drop: function(e, ui) {
                    var droppedEl = ui.draggable.parents('{$tag}');
                    $('{$this->tbl_id}').treetable('move', droppedEl.data('ttId'), $(this).data('ttId'));
                    //alert(droppedEl.data('ttId'));

                    $.ajax({
                    type:   'POST',
                    url:    '{$this->post_url}',
                    data:   { {$this->of_sn}: $(this).data('ttId'), {$this->sn}: droppedEl.data('ttId') },
                    success: function(msg) {
                        $('{$this->msg}').html(msg);
                    }
                    });

                },
                hoverClass: 'accept',
                over: function(e, ui) {
                    var droppedEl = ui.draggable.parents('{$tag}');
                    if(this != droppedEl[0] && !$(this).is('.expanded')) {
                    $('{$this->tbl_id}').treetable('expandNode', $(this).data('ttId'));
                    }
                }
                });
            });";
        }

        if ($xoTheme) {
            $xoTheme->addStylesheet('modules/tadtools/treeTable/stylesheets/jquery.treetable.css');
            $xoTheme->addStylesheet('modules/tadtools/treeTable/stylesheets/jquery.treetable.theme.default.css');
            $xoTheme->addScript('modules/tadtools/treeTable/javascripts/src/jquery.treetable.js');

            $xoTheme->addScript('', null, "
                (function(\$){
                \$(document).ready(function(){
                    \$('{$this->tbl_id}').treetable({ expandable: true $expanded });
                    $sort_code
                    \$('table{$this->tbl_id} tbody').on('mousedown', '{$tag}', function() {
                    \$('.selected').not(this).removeClass('selected');
                    \$(this).toggleClass('selected');
                    });
                    $drag_code
                });
                })(jQuery);
            ");
        } else {
            $main = "
            $jquery
            <link href='" . XOOPS_URL . "/modules/tadtools/treeTable/stylesheets/jquery.treetable.css' rel='stylesheet'  >
            <link href='" . XOOPS_URL . "/modules/tadtools/treeTable/stylesheets/jquery.treetable.theme.default.css' rel='stylesheet' >

            <script type='text/javascript' src='" . XOOPS_URL . "/modules/tadtools/treeTable/javascripts/src/jquery.treetable.js'></script>
            <script type='text/javascript'>
            $(document).ready(function()  {
                $('{$this->tbl_id}').treetable({ expandable: true $expanded });
                $sort_code
                $('table{$this->tbl_id} tbody').on('mousedown', '{$tag}', function() {
                $('.selected').not(this).removeClass('selected');
                $(this).toggleClass('selected');
                });
                $drag_code
            });

            </script>";

            return $main;
        }
    }
}
/*
use XoopsModules\Tadtools\TreeTable;
$TreeTable = new TreeTable(false, 'cate_sn', 'of_cate_sn', "#treetbl{$treeID}", 'save_drag.php', '.folder', '#save_msg', true, '.sort', 'save_sort.php', '#save_msg');
$TreeTable->render();
 */
