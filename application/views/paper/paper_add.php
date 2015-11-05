<div id="page-wrapper" style="min-height: 854px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">试题编辑</h1>
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
                    试题主体
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo site_url('paper/paper_add');?>" method="post">
                            <div class="form-group">
                                <label>试题标题</label>
                                <input class="form-control" id="title" name="name" placeholder="试题标题">
                            </div>
                            <div class="form-group">
                                <label>所属分类</label>
                                <select name="category_id" id="category" class="form-control">
                                    <?php foreach($categories as $v) {?>
                                        <option value="<?php echo $v->id; ?>">
                                            <?php echo $v->name; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>考试限时</label>
                                <input class="form-control" placeholder="" type="number" value="45" id="answer_minutes" name="answer_minutes"/>
                            </div>
                            <div class="form-group">
                                <label>及格分数</label>
                                <input class="form-control" placeholder="" type="number" value="90" id="pass_score" name="pass_score"/>
                            </div>
                            <div class="form-group">
                                <label>是否发布</label>
                                <select id="publish" class="form-control" name="is_effect" disabled>
                                    <option value="1">是</option>
                                    <option value="0" selected="selected">否</option>
                                </select>
                            </div>
                                <div class="form-group"><input type="submit" class="btn btn-primary" value="提交"></div>
                            </form>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>