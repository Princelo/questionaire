<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">考试纪录</h1>
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
            setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
        </script>
    <?php } ?>
    <?php if($f['state'] == 'error') { ?>
        <script>
            $('#error-bar').show();
            setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
        </script>
    <?php } ?>
    <?php } ?>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DataTables Advanced Tables
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>试题名称</th>
                                <th>所属分类</th>
                                <th>考生姓名</th>
                                <th>考生性别</th>
                                <th>考生手机号</th>
                                <th>所得分数</th>
                                <th>完成时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($records as $k => $v) {?>
                                <?php if ($v->title != '') {?>
                                    <tr>
                                        <td><a href="<?php echo site_url('paper/paper_details/'.$v->id);?>"><?php echo $v->title; ?></a></td>
                                        <td><?php echo $v->category; ?></td>
                                        <td><?php echo $v->name;?></td>
                                        <td><?php echo $v->gender==0?'男':'女';?></td>
                                        <td><?php echo $v->mobile;?></td>
                                        <td><?php echo $v->score;?>分</td>
                                        <td><?php echo $v->start_time;?></td>
                                        <td><a onclick="confirm_delete(this)" bhref="<?php echo site_url('backend/session_delete/'.$v->id);?>" class="btn btn-danger">删除</a></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>