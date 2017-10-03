<div id="page-wrapper" style="min-height: 854px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">试题编辑</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php $f = $this->session->flashdata('flashdata'); ?>
    <div class="alert alert-success" id="success-bar" style="display:none; position:fixed;left:50%; margin-left: -100px; top: 40%; width: 200px;  z-index: 99;text-align: center;">
        <?php if($f['state'] == 'success') {?>
            <?php echo $f['message']; ?>
        <?php } ?>
    </div>
    <div class="alert alert-danger" id="error-bar" style="display: none; position:fixed; left:50%; margin-left: -100px; top: 40%; width: 200px;  z-index: 99;text-align: center;">
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
                        $('#title').val(response.value);
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
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
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
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
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
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
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
                    }
                }
            });
        }
        var update_is_test = function() {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('paper/ajax_paper_update')?>',
                data: {
                    'is_test': document.getElementById('is_test').checked,
                    'id': '<?php echo $paper->id; ?>'
                },
                success: function (response) {
                    if (response.state == 'success') {
                        $('#success-bar').html(response.message);
                        $('#success-bar').fadeIn();
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
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
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
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
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
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
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
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
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
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
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
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
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
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
                        setTimeout(function(){$('#success-bar').fadeOut()}, 3000)
                    } else {
                        $('#error-bar').html(response.message);
                        $('#error-bar').fadeIn();
                        setTimeout(function(){$('#error-bar').fadeOut()}, 3000)
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
                                    <input class="form-control" id="title" value="<?php echo $paper->title; ?>">
                                    <p class="help-block"><button onclick="update_title()" class="btn btn-default">修改标题</button></p>
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
                                    <p class="help-block"><button onclick="update_category()" class="btn btn-default">修改类别</button></p>
                                </div>
                                <div class="form-group">
                                    <label>考试限时</label>
                                    <input class="form-control" placeholder="" type="number" value="<?php echo $paper->answer_minutes;?>" id="answer_minutes" />
                                    <p class="help-block"><button onclick="update_minutes()" class="btn btn-default">修改限时</button></p>
                                </div>
                                <div class="form-group">
                                    <label>是否为练习题目</label>
                                    <input type="checkbox" class="form-control" id="is_test" name="is_test" <?php echo $paper->is_test == '1'?'checked':''?>/>
                                    <p class="help-block">(练习题目答题不限时)</p>
                                    <p class="help-block"><button onclick="update_is_test()" class="btn btn-default">修改</button></p>
                                </div>
                                <div class="form-group">
                                    <label>及格分数</label>
                                    <input class="form-control" placeholder="" type="number" value="<?php echo $paper->pass_score; ?>" id="pass_score" />
                                    <p class="help-block"><button onclick="update_score()" class="btn btn-default">修改及格分数</button></p>
                                </div>
                                <div class="form-group">
                                    <label>是否发布</label>
                                    <select id="publish" class="form-control">
                                        <option value="1" <?php echo $paper->is_effect =='1'?'selected="selected"':'';?>>是</option>
                                        <option value="0" <?php echo $paper->is_effect =='0'?'selected="selected"':'';?>>否</option>
                                    </select>
                                    <p class="help-block"><button onclick="update_publish()" class="btn btn-warning">修改发布状态</button></p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
                        <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            试卷题目
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                <tr>
                                                    <th>题号</th>
                                                    <th>题目</th>
                                                    <th>分值</th>
                                                    <th>修改</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($questions as $q) {?>
                                                    <?php if ($q->title != '') {?>
                                                        <tr>
                                                            <td><?php echo $q->question_no; ?></td>
                                                            <td>
                                                                <?php echo $q->title; ?>
                                                            </td>
                                                            <td><?php echo $q->score;?>分</td>
                                                            <td>
                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal<?php echo $q->id?>" class="btn btn-default" <?php if($q->video!='') echo "onclick=\"showflash('".$q->video."', ".$q->id.")\"";?>>
                                                                    修改
                                                                </a>
                                                                <a onclick="confirm_delete(this)" bhref="<?php echo site_url('question/question_delete/'.$q->id)?>?pid=<?php echo $paper->id ?>" class="btn btn-danger">删除</a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

            <?php foreach($questions as $q) { ?>
            <!-- Modal -->
            <div class="modal fade" id="myModal<?php echo $q->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">修改题目</h4>
                        </div>
                        <div class="modal-body">
                            <?php echo form_open_multipart('question/question_update',array('id'=>'form'.$q->id));?>
                            <div class="form-group">
                                <label>题号</label>
                                <input id="questionno<?php echo $q->id; ?>" value="<?php echo $q->question_no; ?>" type="number" class="form-control" name="question_no"/>
                            </div>
                            <div class="form-group">
                                <label>分值</label>
                                <input id="score<?php echo $q->id; ?>" value="<?php echo $q->score; ?>" type="number" class="form-control" name="score"/>
                            </div>
                            <div class="form-group">
                                <label>题目</label>
                                <textarea class="form-control" rows="3" id="question<?php echo $q->id; ?>" name="title"><?php echo $q->title; ?></textarea>
                            </div>
                            <div class="form-group">
                                <?php foreach($q->options as $o) {?>
                                    选项
                                    <select id="optionno<?php echo $o->id; ?>" disabled class="form-control">
                                        <option value="1" <?php echo $o->option_no=='1'?"selected=\"selected\"":"";?>>A</option>
                                        <option value="2" <?php echo $o->option_no=='2'?"selected=\"selected\"":"";?>>B</option>
                                        <option value="3" <?php echo $o->option_no=='3'?"selected=\"selected\"":"";?>>C</option>
                                        <option value="4" <?php echo $o->option_no=='4'?"selected=\"selected\"":"";?>>D</option>
                                        <option value="5" <?php echo $o->option_no=='5'?"selected=\"selected\"":"";?>>E</option>
                                        <option value="6" <?php echo $o->option_no=='6'?"selected=\"selected\"":"";?>>F</option>
                                        <option value="7" <?php echo $o->option_no=='7'?"selected=\"selected\"":"";?>>G</option>
                                    </select>
                                    <div class="form-group">
                                        <input id="option<?php echo $o->id; ?>" value="<?php echo $o->content; ?>" class="form-control" name="option<?php echo $o->option_no;?>"/>
                                    </div>
                                <? } ?>
                                <div class="form-group">
                                    正确答案
                                    <select id="correct<?php echo $q->id?>" class="form-control" name="correct">
                                        <option value="1" <?php echo $o->is_correct=='1'&&$o->option_no=='1'?"selected=\"selected\"":"";?>>A</option>
                                        <option value="2" <?php echo $o->is_correct=='1'&&$o->option_no=='2'?"selected=\"selected\"":"";?>>B</option>
                                        <option value="3" <?php echo $o->is_correct=='1'&&$o->option_no=='3'?"selected=\"selected\"":"";?>>C</option>
                                        <option value="4" <?php echo $o->is_correct=='1'&&$o->option_no=='4'?"selected=\"selected\"":"";?>>D</option>
                                        <option value="5" <?php echo $o->is_correct=='1'&&$o->option_no=='5'?"selected=\"selected\"":"";?>>E</option>
                                        <option value="6" <?php echo $o->is_correct=='1'&&$o->option_no=='6'?"selected=\"selected\"":"";?>>F</option>
                                        <option value="7" <?php echo $o->is_correct=='1'&&$o->option_no=='7'?"selected=\"selected\"":"";?>>G</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>附图(支援jpg/png/gif 图片格式)</label>
                                    <input name="image" type="file" class="delete-img<?php echo $q->id;?>">
                                    <?php if($q->image != '') { ?>
                                        <img src="<?=$q->image?>" style="width:300px;" class="delete-img<?php echo $q->id;?>"/>
                                        <a href="javascript:void(0);" class="btn btn-danger" onclick="delete_img(<?php echo $q->id;?>)">删除附图</a>
                                        <div class="delete-img-mark<?php echo $q->id;?>"></div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>附视频(支援MP4/FLV 视频格式)</label>
                                    <input type="hidden" value="<?php echo $q->id;?>" name="id" class="btn btn-default form-control">
                                    <input type="hidden" value="<?php echo $paper->id;?>" name="paper_id" class="btn btn-default form-control">
                                    <input name="video" type="file" class="delete-video<?php echo $q->id;?>">
                                    <?php if($q->video != '') { ?>
                                        <div id="flashdiv<?php echo $q->id;?>" style="width: 290px; height:185px;"></div>
                                        <a href="javascript:void(0);" class="btn btn-danger" onclick="delete_video(<?php echo $q->id;?>)">删除附附频</a>
                                        <div class="delete-video-mark<?php echo $q->id;?>"></div>
                                    <?php } ?>
                                </div>
                                <?php echo form_close(); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" <?php if($q->video!='') echo "onclick=\"closeFlash($q->id)\"";?>>取消</button>
                            <button type="button" class="btn btn-primary" onclick="$('#form<?php echo $q->id?>').submit()">保存</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            </div>
            <? } ?>
                    <!-- /.row (nested) -->
                    <div class="row" id="add">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-table fa-fw"></i> 添加题目
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <?php echo form_open_multipart('question/question_add');?>
                                        <input type="hidden" name="paper_id" value="<?php echo $paper->id;?>" />
                                        <div class="form-group">
                                            <label>题号</label>
                                            <input name="question_no" value="" type="number" data-validate="required,number"/>
                                        </div>

                                        <div class="form-group">
                                            <label>题目</label>
                                            <textarea class="form-control" rows="3" name="title" data-validate="required"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>分值</label>
                                            <input name="score" type="number" value="1" data-validate="required,number"/>
                                        </div>
                                        <div class="form-group">
                                            选项A
                                            <input value="" name="option1" class="form-control" placeholder="选项描述" data-validate="required" />
                                            选项B
                                            <input value="" name="option2" class="form-control" placeholder="选项描述" data-validate="required"/>
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
                                        </div>
                                        <div class="form-group">
                                            正确答案
                                            <select name="correct" class="form-control">
                                                <option value="1">A</option>
                                                <option value="2">B</option>
                                                <option value="3">C</option>
                                                <option value="4">D</option>
                                                <option value="5">E</option>
                                                <option value="6">F</option>
                                                <option value="7">G</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>附图(支援jpg/png/gif 图片格式)</label>
                                            <input name="image" type="file">
                                        </div>
                                        <div class="form-group">
                                            <label>附视频(支援MP4/FLV 视频格式)</label>
                                            <input name="video" type="file">
                                        </div>
                                        <input type="button" value="新增题目" class="btn btn-primary" onclick="confirmSubmit()">
                                    <?php echo form_close(); ?>
                                </div>
                                <script>
                                    function confirmSubmit(){
                                        $("form").verify();
                                        $("form").submit();
                                    }

                                </script>
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
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    var delete_img = function (i) {
        $('.delete-img'+i).each(function(){
            $(this).remove();
        });
        $('#delete-img-mark'+i).html("<input type=\"hidden\" name=\"delete-img-mark\" value=\"1\" />");
    }
    var delete_video = function (i) {
        closeFlash(i);
        $('.delete-video'+i).each(function(){
            $(this).remove();
        });
        $('#delete-video-mark'+i).html("<input type=\"hidden\" name=\"delete-video-mark\" value=\"1\" />");
    }
    function showflash(ipath, i){
        //alert('showflash')
        if(!jwplayer.utils.hasFlash()){
            alert("未安装Flash播放插件，请联系系统管理员！");
            return;
        }

        jwplayer("flashdiv"+i).setup({
            flashplayer: "/assets/swf/tmri-player.swf",
            file:ipath,
            type: "video",
            autostart:true,
            repeat:true,
            height: 185,
            width: 290,
            image:"/assets/images/loadvedio.jpg"
        });

    }
    function closeFlash(i) {
        $('#flashdiv'+i).hide();
        $('#flashdiv'+i+'_wrapper').hide();
    }

</script>
