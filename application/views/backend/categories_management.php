<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">试题类别管理</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php if(!empty($this->session->flashdata('flashdata'))) { ?>
    <?php $f = $this->flashdata('flashdata'); ?>
    <?php if($f['state'] == 'success') {?>
    <div class="alert alert-success">
        <?php echo $f['message']; ?>
    </div>
    <?php } elseif ( $f['state'] == 'error' ) { ?>
    <div class="alert alert-danger">
        <?php echo $f['message']; ?>
    </div>
    <?php } ?>
    <?php } ?>
    <div class="alert alert-success" id="success-bar" style="display:none;">
    </div>
    <div class="alert alert-danger" id="error-bar" style="display: none;">
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-table fa-fw"></i> 类别列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <script>
                        var update_category = function (cid) {
                            $('#success-bar').fadeOut();
                            $('#error-bar').fadeOut();
                            $('#input'+cid).prop('disabled', false);
                            $('#button'+cid).prop('disabled', true);
                            $.ajax({
                                type: 'post',
                                url: "<?php echo site_url('backend/update_category')?>",
                                data: {
                                    'cid': cid,
                                    'value': $('#input'+cid).val()
                                },
                                success: function(response) {
                                    if (response.state == 'success') {
                                        $('#input'+cid).val(response.value);
                                        $('#button'+cid).prop('disabled', false);
                                        $('#success-bar').html(response.message);
                                        $('#success-bar').fadeIn();
                                        setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
                                    } else {
                                        $('#button'+cid).prop('disabled', false);
                                        $('#error-bar').html(response.message);
                                        $('#error-bar').fadeIn();
                                        setTimeout(function(){$('#error-bar').fadeOut()}, 1000)
                                    }
                                }
                            });
                        }
                    </script>
                    <ul class="list-group">
                    <?php foreach($roots as $l) {?>
                        <li class="list-group-item">
                            <input value="<?php echo $l->name;?>" id="input<?php echo $l->id?>"/>
                            <button onclick="update_category(<?php echo $l->id?>)" id="button<?php echo $l->id?>" class="btn btn-primary">修改名称</button>
                            <a href="<?php echo site_url('backend/papers_list')?>?cid=<?php echo $l->id?>" class="btn">查看试题</a>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal<?php echo $l->id?>" class="btn">添加子类別</a>
                            <a href="<?php echo site_url('backend/category_delete');?>?id=<?php echo $l->id; ?>" class="btn btn-danger">删除</a>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal<?php echo $l->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">添加子类别</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo site_url('backend/category_add')?>" method="post" id="form<?php echo $l->id?>">
                                                <input name="name" value="" placeholder="试题类别名" class="form-control"/>
                                                <input name="pid" value="<?php echo $l->id ?>" type="hidden" />
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                            <button type="button" class="btn btn-primary" onclick="$('#form<?php echo $l->id?>').submit()">保存</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <?php if ($l->has_sub_categories) { ?>
                                <ul class="list-group">
                                    <?php foreach($l->roots as $l) {?>
                                        <li class="list-group-item">
                                            <input value="<?php echo $l->name;?>" id="input<?php echo $l->id?>" class="form-control"/>
                                            <button onclick="update_category(<?php echo $l->id?>)" id="button<?php echo $l->id?>" class="btn btn-primary">修改名称</button>
                                            <a href="<?php echo site_url('backend/papers_list')?>?cid=<?php echo $l->id?>" class="btn">查看试题</a>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal<?php echo $l->id?>" class="btn">添加子类別</a>
                                            <a href="<?php echo site_url('backend/category_delete');?>?id=<?php echo $l->id; ?>" class="btn btn-danger">删除</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal<?php echo $l->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">添加子类别</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo site_url('backend/category_add')?>" method="post" id="form<?php echo $l->id?>">
                                                                <input name="name" value="" placeholder="试题类别名" class="form-control"/>
                                                                <input name="pid" value="<?php echo $l->id ?>" type="hidden" />
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                            <button type="button" class="btn btn-primary" onclick="$('#form<?php echo $l->id?>').submit()">保存</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                            <?php if ($l->has_sub_categories) { ?>
                                                <ul class="list-group">
                                                    <?php foreach($l->roots as $l) {?>
                                                        <li class="list-group-item">
                                                            <input value="<?php echo $l->name;?>" id="input<?php echo $l->id?>"/>
                                                            <button onclick="update_category(<?php echo $l->id?>)" id="button<?php echo $l->id?>" class="btn btn-primary">修改名称</button>
                                                            <a href="<?php echo site_url('backend/papers_list')?>?cid=<?php echo $l->id?>" class="btn">查看试题</a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <? } ?>
                    </ul>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-table fa-fw"></i> 添加根类别
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form action="<?php echo site_url('backend/category_add')?>" method="post">
                        <input name="name" value="" class="form-control"/>
                        <input type="submit" value="提交" class="btn btn-primary"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->