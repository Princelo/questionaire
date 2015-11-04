<div id="page-wrapper" style="min-height: 854px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">试题编辑</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php $f = $this->session->flashdata('flashdata'); ?>
    <div class="alert alert-success" id="success-bar" style="display:none; position:fixed;left:50%; margin-left: -100px; top: 40%; width: 200px; display:block;">
        <?php if($f['state'] == 'success') {?>
            <?php echo $f['message']; ?>
        <?php } ?>
    </div>
    <div class="alert alert-danger" id="error-bar" style="display: none; position:fixed; left:50%; margin-left: -100px; top: 40%; width: 200px; display:block;">
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
            setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
        </script>
    <?php } ?>
    <?php } ?>
    <script>
        var update_title = function() {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('paper/ajax_paper_update')?>',
                data: {
                    'name': $('#title').val(),
                    'id': '<?php echo $paper->id; ?>'
                },
                success: function (response) {
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

        var update_category = function() {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('paper/ajax_paper_update')?>',
                data: {
                    'category_id': $('#category').val(),
                    'id': '<?php echo $paper->id; ?>'
                },
                success: function (response) {
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
        var update_minutes = function() {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('paper/ajax_paper_update')?>',
                data: {
                    'answer_minutes': $('#answer_minutes').val(),
                    'id': '<?php echo $paper->id; ?>'
                },
                success: function (response) {
                    if (response.state == 'success') {
                        $('#answer_minutes').val(response.value);
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 1000)
                    }
                }
            });
        }
        var update_score = function() {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('paper/ajax_paper_update')?>',
                data: {
                    'pass_score': $('#pass_score').val(),
                    'id': '<?php echo $paper->id; ?>'
                },
                success: function (response) {
                    if (response.state == 'success') {
                        $('#pass_score').val(response.value);
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 1000)
                    }
                }
            });
        }
        var update_publish = function() {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('paper/ajax_paper_update')?>',
                data: {
                    'is_effect': $('#publish').val(),
                    'id': '<?php echo $paper->id; ?>'
                },
                success: function (response) {
                    if (response.state == 'success') {
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 1000)
                    }
                }
            });
        }
        var update_question_no = function(question_id) {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('question/ajax_question_update')?>',
                data: {
                    'question_no': $('#questionno'+question_id).val(),
                    'id': question_id,
                },
                success: function (response) {
                    if (response.state == 'success') {
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 1000)
                    }
                }
            });
        }

        var update_question_score = function(question_id) {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('question/ajax_question_update')?>',
                data: {
                    'score': $('#questionno'+question_id).val(),
                    'id': question_id,
                },
                success: function (response) {
                    if (response.state == 'success') {
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 1000)
                    }
                }
            });
        }
        var update_question = function(question_id) {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('question/ajax_question_update')?>',
                data: {
                    'title': $('#question'+question_id).val(),
                    'id': question_id,
                },
                success: function (response) {
                    if (response.state == 'success') {
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 1000)
                    }
                }
            });
        }

        var update_option_no = function(option_id) {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('question/ajax_option_update')?>',
                data: {
                    'option_no': $('#optionno'+option_id).val(),
                    'id': option_id
                },
                success: function (response) {
                    if (response.state == 'success') {
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 1000)
                    }
                }
            });
        }
        var update_option = function(option_id) {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('question/ajax_option_update')?>',
                data: {
                    'option': $('#option'+option_id).html(),
                    'id': option_id
                },
                success: function (response) {
                    if (response.state == 'success') {
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 1000)
                    }
                }
            });
        }
        var update_correct_option = function(question_id) {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('question/ajax_option_correct_update')?>',
                data: {
                    'correct_option_no': $('#correct'+question_id).html(),
                    'question_id': question_id
                },
                success: function (response) {
                    if (response.state == 'success') {
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 1000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 1000)
                    }
                }
            });
        }
    </script>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                试题主体<input type="hidden" id="paper_id" value="<?php echo $paper->id?>" />
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                                <div class="form-group">
                                    <label>试题标题</label><a href="#add">添加题目</a>
                                    <input class="form-control" id="title">
                                    <p class="help-block"><button onclick="update_title()">修改标题</button></p>
                                </div>
                                <div class="form-group">
                                    <label>所属分类</label>
                                    <select name="" id="category" class="form-control">
                                        <?php foreach($categories as $v) {?>
                                            <option value="<?php echo $v->id; ?>" <?php echo $paper->category_id==$v->id?"selected=\"selected\"":"";?>>
                                                <?php echo $v->name; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <p class="help-block"><button onclick="update_category()">修改类别</button></p>
                                </div>
                                <div class="form-group">
                                    <label>考试限时</label>
                                    <input class="form-control" placeholder="" type="number" value="" id="answer_minutes" />
                                    <p class="help-block"><button onclick="update_minutes()">修改限时</button></p>
                                </div>
                                <div class="form-group">
                                    <label>及格分数</label>
                                    <input class="form-control" placeholder="" type="number" value="" id="pass_score" />
                                    <p class="help-block"><button onclick="update_score()">修改及格分数</button></p>
                                </div>
                                <div class="form-group">
                                    <label>是否发布</label>
                                    <select id="publish" class="form-control">
                                        <option value="1">是</option>
                                        <option value="0">否</option>
                                    </select>
                                    <p class="help-block"><button onclick="update_publish()">修改发布状态</button></p>
                                </div>
                                <?php foreach($questions as $q) { ?>
                                <div class="form-group">
                                    <label>题号</label>
                                    <input id="questionno<?php echo $q->id; ?>" value="<?php echo $q->question_no; ?>" type="number" />
                                    <p class="help-block"><button onclick="update_question_no(<?php echo $q->id; ?>)">修改题号</button></p>
                                    <label>分值</label>
                                    <input id="score<?php echo $q->id; ?>" value="<?php echo $q->score; ?>" type="number" />
                                    <p class="help-block"><button onclick="update_question_score(<?php echo $q->id; ?>)">修改分数</button></p>
                                    <textarea class="form-control" rows="3" id="question<?php echo $q->id; ?>" ><?php echo $q->name; ?></textarea>
                                    <p class="help-block"><button onclick="update_question(<?php echo $q->id?>)">修改题目</button></p>
                                    <?php foreach($q->options as $o) {?>
                                        选项
                                        <select id="optionno<?php echo $o->id; ?>" disabled>
                                            <option value="1" <?php echo $o->option_no=='1'?"selected=\"selected\"":"";?>>A</option>
                                            <option value="2" <?php echo $o->option_no=='2'?"selected=\"selected\"":"";?>>B</option>
                                            <option value="3" <?php echo $o->option_no=='3'?"selected=\"selected\"":"";?>>C</option>
                                            <option value="4" <?php echo $o->option_no=='4'?"selected=\"selected\"":"";?>>D</option>
                                            <option value="5" <?php echo $o->option_no=='5'?"selected=\"selected\"":"";?>>E</option>
                                            <option value="6" <?php echo $o->option_no=='6'?"selected=\"selected\"":"";?>>F</option>
                                            <option value="7" <?php echo $o->option_no=='7'?"selected=\"selected\"":"";?>>G</option>
                                        </select>
                                        <input id="option<?php echo $o->id; ?>" value="<?php echo $o->name; ?>" class="form-control"/>
                                        <p class="help-block"><button onclick="update_option(<?php echo $o->id?>)">修改选项</button></p>
                                        正确答案
                                        <select id="correct<?php echo $q->id?>">
                                            <option value="1" <?php echo $o->is_correct=='1'&&$o->option_no=='1'?"selected=\"selected\"":"";?>>A</option>
                                            <option value="2" <?php echo $o->is_correct=='1'&&$o->option_no=='2'?"selected=\"selected\"":"";?>>B</option>
                                            <option value="3" <?php echo $o->is_correct=='1'&&$o->option_no=='3'?"selected=\"selected\"":"";?>>C</option>
                                            <option value="4" <?php echo $o->is_correct=='1'&&$o->option_no=='4'?"selected=\"selected\"":"";?>>D</option>
                                            <option value="5" <?php echo $o->is_correct=='1'&&$o->option_no=='5'?"selected=\"selected\"":"";?>>E</option>
                                            <option value="6" <?php echo $o->is_correct=='1'&&$o->option_no=='6'?"selected=\"selected\"":"";?>>F</option>
                                            <option value="7" <?php echo $o->is_correct=='1'&&$o->option_no=='7'?"selected=\"selected\"":"";?>>G</option>
                                        </select>
                                        <button onclick="update_correct_option(<?php echo $q->id;?>)">修改正确答案</button>
                                        <label>附图</label>
                                    <? } ?>
                                    <form action="<?php echo site_url('question/update_image');?>" method="post">
                                        <input type="hidden" value="<?php echo $q->id;?>" name="id">
                                        <input name="image" type="file">
                                        <img src="<?=$q->img?>" />
                                        <input type="submit" class="btn btn-primary" value="修改附图"/>
                                    </form>
                                </div>
                                <? } ?>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                    <div class="row" id="add">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-table fa-fw"></i> 添加题目
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <form action="<?php echo site_url('question_add')?>" method="post">
                                        <input type="hidden" name="paper_id" value="<?php echo $paper->id;?>" />
                                        <div class="form-group">
                                            <label>题号</label>
                                            <input name="question_no" value="" type="number" />
                                            <label>题目</label>
                                            <textarea class="form-control" rows="3" name="title"></textarea>
                                            <label>分值</label>
                                            <input name="score" value="" type="number" />
                                            选项A
                                            <input value="" name="option1" class="form-control" placeholder="选项描述"/>
                                            选项B
                                            <input value="" name="option2" class="form-control" placeholder="选项描述"/>
                                            选项C
                                            <input value="" name="option3" class="form-control" placeholder="选项描述"/>
                                            选项D
                                            <input value="" name="option4" class="form-control" placeholder="选项描述"/>
                                            选项E
                                            <input value="" name="option5" class="form-control" placeholder="选项描述"/>
                                            选项F
                                            <input value="" name="option6" class="form-control" placeholder="选项描述"/>
                                            选项G
                                            <input value="" name="option7" class="form-control" placeholder="选项描述"/>
                                            正确答案
                                            <select name="correct">
                                                <option value="1">A</option>
                                                <option value="2">B</option>
                                                <option value="3">C</option>
                                                <option value="4">D</option>
                                                <option value="5">E</option>
                                                <option value="6">F</option>
                                                <option value="7">G</option>
                                            </select>
                                            <label>附图</label>
                                            <input name="image" type="file">
                                        </div>
                                        <input type="submit" value="新增题目">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>