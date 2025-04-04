<div class="xoops-comment-body">
    <div class="row">
        <div class="col-sm-2 col-lg-2"><strong><{$lang_poster|default:''}></strong></div>
        <div class="col-sm-10 col-lg-10"><strong><{$lang_thread|default:''}></strong></div>
    </div>
    <{foreach item=comment from=$comments}>
        <{include file="db:system_comment.tpl" comment=$comment}>
    <{/foreach}>

    <{if $commentform|default:false}>
        <div class="aligncenter">
            <button class="btn-comment btn btn-primary btn-md" data-toggle="modal" data-target="#comments-form">
                <span class="glyphicon glyphicon-comment"></span> Add Comment
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="comments-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog comments-modal">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="xoops-comment-form">
                            <{$commentform|default:''}>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">&times;</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    <{/if}>
</div>
