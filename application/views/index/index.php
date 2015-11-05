<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>考试系统</title>
    <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script>
        var paper = eval('(<?php echo $json_paper;?>)');
        var result = [];
        var draft = [];
        var submit = [];
        for (i = 1; i <= paper.length; i++) {
            result[i] = false;
        }
        for (i = 1; i <= paper.length; i++) {
            draft[i] = null;
        }
        for (i = 1; i <= paper.length; i++) {
            submit[i] = paper.questions[i].id+":"+0;
        }
        var convert_option_no = function(option_no) {
            switch(option_no) {
                case '1':
                    ret = 'A';
                    break;
                case '2':
                    ret = 'B';
                    break;
                case '3':
                    ret = 'C';
                    break;
                case '4':
                    ret = 'D';
                    break;
                case '5':
                    ret = 'E';
                    break;
                case '6':
                    ret = 'F';
                    break;
                case '7':
                    ret = 'G';
                    break;
                default :
                    ret = 'ERROR';
                    break;
            }
            return ret;
        }
        var nextSelect = function () {
            for(i = 1; i <= 7; i++) {
                $('#bt'+i).removeClass('selected');
            }
            $('#prevSelect').show();
            if (parseInt($('#current_select').val() + 1 == paper.length) {
                $('#nextSelect').hide();
            }
            $('#current_select').val(parseInt($('#current_select').val()) + 1)
            j = draft[parseInt($('#current_select').val())];
            $('#bt'+j).addClass('selected');
            question = paper.questions[parseInt($('#current_select').val())];
            $('#paper_name').html(paper.name);
            $('#esubject').html(question.question_no+'.'+question.title);
            $('#eselect').html('');
            $('#eimg').css('visibility', 'hidden');
            $('#eimg').html('');
            solution = 'ERROR';
            for(var o in question.options) {
                $('#eselect').html($('#eselect').html() + convert_option_no(o.option_no)+'.'+ o.content+'<br />');
                if(o.is_correct == '1') {solution = convert_option_no(o.option_no);}
            }
            if (question.image != '') {
                $('#eimg').html("<img src=\""+question.image+"\" style=\"width:300px;\" />");
            }
            $('#esolution').html('正确'+solution);
        }
        var prevSelect = function () {
            for(i = 1; i <= 7; i++) {
                $('#bt'+i).removeClass('selected');
            }
            $('#nextSelect').show();
            if (parseInt($('#current_select').val() == 2) {
                $('#prevSelect').hide();
            }
            $('#current_select').val(parseInt($('#current_select').val()) - 1)
            j = draft[parseInt($('#current_select').val())];
            $('#bt'+j).addClass('selected');
            question = paper.questions[parseInt($('#current_select').val())];
            $('#paper_name').html(paper.name);
            $('#esubject').html(question.question_no+'.'+question.title);
            $('#eselect').html('');
            $('#eimg').css('visibility', 'hidden');
            $('#eimg').html('');
            solution = 'ERROR';
            for(var o in question.options) {
                $('#eselect').html($('#eselect').html() + convert_option_no(o.option_no)+'.'+ o.content+'<br />');
                if(o.is_correct == '1') {solution = convert_option_no(o.option_no);}
            }
            if (question.image != '') {
                $('#eimg').html("<img src=\""+question.image+"\" style=\"width:300px;\" />");
            }
            $('#esolution').html('正确'+solution);
        }
        var subbar = function(i) {
            for(j = 1; j <= 7; j++) {
                $('#bt'+j).removeClass('selected');
            }
            $('#prevSelect').show();
            $('#nextSelect').show();
            if (i == paper.length) {
                $('#nextSelect').hide();
            }
            if (i == 1) {
                $('#nextSelect').hide();
            }
            $('#current_select').val(i);
            $('#bt'+i).addClass('selected');
            question = paper.questions[parseInt($('#current_select').val())];
            $('#paper_name').html(paper.name);
            $('#esubject').html(question.question_no+'.'+question.title);
            $('#eselect').html('');
            $('#eimg').css('visibility', 'hidden');
            $('#eimg').html('');
            solution = 'ERROR';
            for(var o in question.options) {
                $('#eselect').html($('#eselect').html() + convert_option_no(o.option_no)+'.'+ o.content+'<br />');
                if(o.is_correct == '1') {solution = convert_option_no(o.option_no);}
            }
            if (question.image != '') {
                $('#eimg').html("<img src=\""+question.image+"\" style=\"width:300px;\" />");
            }
            $('#esolution').html('正确'+solution);
        }
        var vAnswer = function () {
            for(i=1; i<=result.length; i++) {
                if(result[i] == true)
                    $('#bar'+i).addClass('correct');
                else
                    $('#bar'+i).addClass('wrong');
            }
            $('#current_mode').val('solution');
            $('#esolution').css('visibility', '');
        }
        var toSelect = function(i) {
            $('#bt'+i).addClass('selected');
            var current = $('#current_select').val();
            if (paper.questions[current].options[i].is_corrent == '1') {
                result[current] = true;
            } else {
                result[current] = false;
            }
            draft[current] = i;
            submit[current] = paper.questions[current].id+":"+i;
        }
        var estart = function() {
            var tel = $("#txtmobile").val(); //获取手机号
            var telReg = !!tel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
            if(telReg == false){
                alert('请输入正确手机号');
                return false;
            }
            $('#hiddenname').val($('#txtname').val());
            $('#hiddengender').val($('#txtsex').val());
            $('#hiddenmobile').val($('#txtmobile').val());
            countdown('countdown');
            $('.operbar').show();
        }
        var interval;
        var minutes = 45;
        var seconds = 0;
        window.onload = function() {
        }

        function countdown(element) {
            interval = setInterval(function() {
                var el = document.getElementById(element);
                if(seconds == 0) {
                    if(minutes == 0) {
                        el.innerHTML = "考试结束";
                        esubmit();
                        clearInterval(interval);
                        return;
                    } else {
                        minutes--;
                        seconds = 60;
                    }
                }
                if(minutes > 0) {
                    var minute_text = minutes + (minutes > 1 ? '分钟' : '分钟');
                } else {
                    var minute_text = '';
                }
                var second_text = seconds > 1 ? '秒' : '秒';
                el.innerHTML = minute_text + ' ' + seconds + ' ' + second_text + '';
                seconds--;
            }, 1000);
        }

        var esubmit = function(){
            alert('考试结束');
            $.ajax({
                'type': 'post',
                'url':  '<?php echo site_url('index/submit');?>',
                data : {
                   'paper_id' : <?php echo $paper->id;?>,
                    'submit': JSON.stringify(submit),
                    'name' : $('#hiddenname').val(),
                    'gender' : $('#hiddengender').val(),
                    'mobile_no' : $('#hiddenmobile').val()
                },
                success: function (response) {
                    if (response.state == 'success' ) {
                        console.log('success');
                    }
                }
            });
            $('#card').show();
            score = 0;
            for(i = 1; i <= result.length; i++) {
                if (result[i] == true) {
                    score += parseInt(paper.questions[i].score);
                }
                $('#fen').html(score);
                if (score >= <?php echo $paper->pass_score;?>) {
                    $('#overText').show();
                    $('#failText').hide();
                } else {
                    $('#overText').hide();
                    $('#failText').show();
                }
            }

        }
    </script>
</head>
<body>
<div id="left">
    <input id="current_select" value="1" type="hidden"/>
    <input id="current_mode" value="preparing" type="hidden"><!--ending solution running-->
    <input id="hiddenname" value="" type="hidden">
    <input id="hiddengender" value="" type="hidden">
    <input id="hiddenmobile" value="" type="hidden">

    <ul class="list-group">
        <?php foreach($roots as $l) {?>
            <li class="list-group-item">
                <h4><?php echo $l->name;?></h4>
                <ul class="paper-list">
                    <?php foreach($l->papers as $p) {?>
                        <li><a href="<?php echo site_url('index/paper/'.$p->id);?>"><?php echo $p->title; ?></a></li>
                    <?php } ?>
                </ul>
                <?php if ($l->has_sub_categories) { ?>
                    <ul class="list-group">
                        <?php foreach($l->roots as $l) {?>
                            <li class="list-group-item">
                                <h4><?php echo $l->name;?></h4>
                                <ul class="paper-list">
                                    <?php foreach($l->papers as $p) {?>
                                        <li><a href="<?php echo site_url('index/paper/'.$p->id);?>"><?php echo $p->title; ?></a></li>
                                    <?php } ?>
                                </ul>
                                <?php if ($l->has_sub_categories) { ?>
                                    <ul class="list-group">
                                        <?php foreach($l->roots as $l) {?>
                                            <li class="list-group-item">
                                                <h4><?php echo $l->name;?></h4>
                                                <ul class="paper-list">
                                                    <?php foreach($l->papers as $p) {?>
                                                        <li><a href="<?php echo site_url('index/paper/'.$p->id);?>"><?php echo $p->title; ?></a></li>
                                                    <?php } ?>
                                                </ul>
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


    <h2><span>最新考试</span></h2>
    <div class="newBm" style="background: #DBDBBE">
        <marquee direction="up" scrollamount="1" scrolldelay="20" height="200" width="230px" style="height: 200px; width: 230px;">
            <table class="ksjg">
                <tbody>
                <tr>
                    <td>来自 广东省深圳市  的 <font color="#ff69b4">唐先生</font> 朋友 考试成绩为<font color="DeepSkyBlue">72</font> 分 [时间: 2015-11-1   电话:1501365****]
                    </td>
                </tr>
                </tbody>
            </table>

        </marquee>
    </div>




    <br class="spacer">
</div>
<div id="allow">您所在的位置:<a href="/">首页</a>&gt;&gt;<a href="/exam/">模拟考试</a></div>
<div id="jx">

    <br>


    <form method="post" name="myfrom" id="myfrom">

        <table class="bm" style="margin-top:5px">
            <tbody><tr>
                <td colspan="6">
                    <strong id="paper_name"><?php echo $paper->title; ?></strong>
                    <hr size="1" color="#ff9900">
                </td>
            </tr>

            <tr>
                <td class="caption">姓名:</td>
                <td> <input class="text" style="width:80px" name="name" id="txtname" maxlength="6" value=""><font color="red">*</font></td>
                <td class="caption">性别:</td>
                <td><select class="text" style="width:50px;" name="gender" id="txtsex"><option value="0">男</option><option value="1">女</option></select><font color="red">*</font></td>

                <td class="caption">手机号码:</td>
                <td> <input class="text" style="width:200px;ime-mode:disabled" name="mobile_no" maxlength="11" value="" id="txtmobile" type="number"><font color="red">*</font></td>
            </tr>

            <tr>
                <td></td>
                <td colspan="5" style="color:rgb(183, 13, 13)">1.考试时间为<?php echo $paper->answer_minutes; ?>分钟<br>2.合格分数为<?php echo $paper->pass_score; ?>分.</td>
            </tr>

            <tr>
                <td colspan="6">
                    <a href="<?php echo site_url('index/paper/'.$paper->id); ?>" class="btn" onclick="">重考</a>
                    <a href="javascript:void(0)" class="btn" onclick="estart();return false;">开始</a>

                </td>
            </tr>



            </tbody></table>
        <input type="hidden" id="cityID" value="200">
        <input type="hidden" id="ct" value="1">
    </form>

    <div class="examsv">
        模拟考试系统  <font size="2" id="examTimePlan">(剩余时间:<span id="countdown"><?php echo $paper->answer_minutes;?>分00秒</span>)</font>
    </div>
    <div class="examplan">
        <div class="esubject" id="esubject"><?php echo $question->question_no; ?>. <?php echo $question->title; ?></div>

        <div class="eselect" id="eselect">
            <?php echo covert_option_no($question->options[0]->option_no) ;?>. <?php echo $question->options[0]->content; ?>
            <br>
            <?php echo covert_option_no($question->options[0]->option_no) ;?>. <?php echo $question->options[0]->content; ?>
            <br>
        </div>



        <div id="eimg" style="<?php echo $question->options[0]->image==''?"visibility: hidden;":'';?>"><div id="flashdiv"></div></div>





        <div class="answerbar">
            <?php $solution = 'ERROR'; ?>
            <?php foreach($question->options as $o) {?>
               <?php if ($o->is_correct == '1') {$solution = convert_option_no($o->option_no); break;}?>
            <?php } ?>
            <p class="eresult" id="eresult">您的回答: <br><span class="solution" id="esolution">正确<?php echo $solution;?></span></p>
            <input type="button" onclick="toSelect('1')" id="bt1" value="1">
            <input type="button" onclick="toSelect('2')" id="bt2" value="2">
            <input type="button" onclick="toSelect('3')" id="bt3" value="3">
            <input type="button" onclick="toSelect('4')" id="bt4" value="4">
            <input type="button" onclick="toSelect('5')" id="bt5" value="5">
            <input type="button" onclick="toSelect('6')" id="bt6" value="6">
            <input type="button" onclick="toSelect('7')" id="bt7" value="7">


        </div>

        <div class="operbar" style="display:none;">
            <a href="javascript:void(0)" class="btn" style="margin:0;" onclick="prevSelect();return false">上一题</a>
            <a href="javascript:void(0)" class="btn" style="margin:0;" onclick="nextSelect();return false" id="nextSelect">下一题</a>
            <a href="javascript:void(0)" class="btn" style="margin:0;" onclick="overExam();return false" id="overbtn">交卷</a>
        </div>

        <div class="esubbar">
            <?php foreach($questions as $k=>$q) { ?>
            <span onclick="subbar(<?php echo $k + 1; ?>)" id="bar<?php echo $k + 1; ?>"><?php echo $k + 1; ?></span>
            <?php } ?>
        </div>
    </div>

    <div class="card" id="card">
        <br>
        <font size="4">成绩卡:</font>
        <br>
        <br>
        <br>
        您的分数为<font color="red" id="fen"></font>
        <br><font id="failText">恭喜您通过本次考试</font>
        <br><font id="overText">很遗憾您没有通过本次考试</font>
        <br>合格分数为<?php echo $paper->pass_score;?>分以上
        <br>
        <br>

        <a href="javascript:void(0);return false" class="btn" onclick="vAnswer()">查看答案</a>
        <br>  <br>
        背景红色为错误题目,点击题目编号查看正确答案
    </div>


</div>
</body>
</html>