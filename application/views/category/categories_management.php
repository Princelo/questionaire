<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">试题类别管理</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php $f = $this->session->flashdata('flashdata'); ?>
    <div class="alert alert-success" id="success-bar" style="display:none;">
        <?php if($f['state'] == 'success') {?>
            <?php echo $f['message']; ?>
        <?php } ?>
    </div>
    <div class="alert alert-danger" id="error-bar" style="display: none;">
        <?php if ( $f['state'] == 'error' ) { ?>
            <?php echo $f['message']; ?>
        <?php } ?>
    </div>
    <?php if (isset($f['message']) && $f['message'] != '') {?>
        <?php if($f['state'] == 'success') { ?>
        <script>
            $('#success-bar').show();
            setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
        </script>
    <?php } ?>
    <?php if($f['state'] == 'error') { ?>
        <script>
            $('#error-bar').show();
            setTimeout(function(){$('#error-bar').fadeOut()}, 1000)
        </script>
    <?php } ?>
    <?php } ?>
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
                                url: "<?php echo site_url('category/update_category')?>",
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
                                <input value="<?php echo $l->name;?>" id="input<?php echo $l->id?>" class="_form-control"/>
                                <button onclick="update_category(<?php echo $l->id?>)" id="button<?php echo $l->id?>" class="btn btn-primary">修改名称</button>
                                <a href="<?php echo site_url('paper/papers_list')?>?cid=<?php echo $l->id?>" class="btn btn-default">查看试题</a>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal<?php echo $l->id?>" class="btn btn-default">添加子类別</a>
                                <a href="<?php echo site_url('category/category_delete');?>?id=<?php echo $l->id; ?>" class="btn btn-danger">删除</a>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal<?php echo $l->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">添加子类别</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo site_url('category/category_add')?>" method="post" id="form<?php echo $l->id?>">
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
                                                <input value="<?php echo $l->name;?>" id="input<?php echo $l->id?>" class="_form-control"/>
                                                <button onclick="update_category(<?php echo $l->id?>)" id="button<?php echo $l->id?>" class="btn btn-primary">修改名称</button>
                                                <a href="<?php echo site_url('paper/papers_list')?>?cid=<?php echo $l->id?>" class="btn btn-default">查看试题</a>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal<?php echo $l->id?>" class="btn btn-default">添加子类別</a>
                                                <a href="<?php echo site_url('category/category_delete');?>?id=<?php echo $l->id; ?>" class="btn btn-danger">删除</a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal<?php echo $l->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel">添加子类别</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?php echo site_url('category/category_add')?>" method="post" id="form<?php echo $l->id?>">
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
                                                                <input value="<?php echo $l->name;?>" id="input<?php echo $l->id?>" class="_form-control"/>
                                                                <button onclick="update_category(<?php echo $l->id?>)" id="button<?php echo $l->id?>" class="btn btn-primary">修改名称</button>
                                                                <a href="<?php echo site_url('paper/papers_list')?>?cid=<?php echo $l->id?>" class="btn btn-default">查看试题</a>
                                                                <a href="<?php echo site_url('category/category_delete');?>?id=<?php echo $l->id; ?>" class="btn btn-danger">删除</a>
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
                    <form action="<?php echo site_url('category/category_add')?>" method="post">
                        <div class="form-group">
                            <input name="name" value="" class="form-control" placeholder="试题类别名"/>
                        </div>
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