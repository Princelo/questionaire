<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>考试系统</title>
    <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/assets/js/jwplayer.js"></script>
    <link rel="stylesheet" href="/assets/css/index.css?v=10">
    <script>
        function showflash(ipath){
            //alert('showflash')
            if(!jwplayer.utils.hasFlash()){
                alert("未安装Flash播放插件，请联系系统管理员！");
                return;
            }

            jwplayer("flashdiv").setup({
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
        }
        var paper = eval('(<?php echo $paper_json;?>)');
        var result = [];
        var draft = [];
        var submit = [];
        for (i = 0; i < paper.questions.length; i++) {
            result[i] = false;
        }
        for (i = 0; i < paper.questions.length; i++) {
            draft[i] = null;
        }
        for (i = 0; i < paper.questions.length; i++) {
            submit[i] = '';
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
            $('#current_select').val(parseInt($('#current_select').val()) + 1)
            if (parseInt($('#current_select').val()) == paper.questions.length) {
                $('#nextSelect').hide();
            }
            j = draft[parseInt($('#current_select').val()) - 1];
            if (parseInt(draft[j-1])>0 && parseInt(draft[j-1]) <8)
                $('#bt'+draft[j-1]).addClass('selected');
            question = paper.questions[parseInt($('#current_select').val()) - 1];
            $('#paper_name').html(paper.name);
            $('#esubject').html(question.question_no+'.'+question.title+' (分值:'+question.score+')');
            $('#eselect').html('');
            $('#eimg').css('visibility', 'hidden');
            $('#eimg').html('<div id="flashdiv"></div>');
            solution = 'ERROR';
            for(i=0;i<question.options.length;i++) {
                o = question.options[i];
                $('#eselect').html($('#eselect').html() + convert_option_no(o.option_no)+'.'+ o.content+'<br />');
                if(o.is_correct == '1') {solution = convert_option_no(o.option_no);}
            }
            if (question.image != null) {
                $('#eimg').html("<img src=\""+question.image+"\" style=\"width:300px;\" /><div id=\"flashdiv\"></div>");
                $('#eimg').css('visibility', '');
            }
            if (question.video != null) {
                showflash(question.video);
                $('#eimg').css('visibility', '');
                $('#eimg').show();
            }
            $('#esolution').html('正确'+solution);
        }
        var prevSelect = function () {
            for(i = 1; i <= 7; i++) {
                $('#bt'+i).removeClass('selected');
            }
            $('#nextSelect').show();
            $('#current_select').val(parseInt($('#current_select').val()) - 1)
            if (parseInt($('#current_select').val()) == 1) {
                $('#prevSelect').hide();
            }
            j = draft[parseInt($('#current_select').val()) - 1];
            if (parseInt(draft[j-1])>0 && parseInt(draft[j-1]) <8)
                $('#bt'+draft[j-1]).addClass('selected');
            question = paper.questions[parseInt($('#current_select').val()) -1];
            $('#paper_name').html(paper.name);
            $('#esubject').html(question.question_no+'.'+question.title+' (分值:'+question.score+')');
            $('#eselect').html('');
            $('#eimg').css('visibility', 'hidden');
            $('#eimg').html('<div id="flashdiv"></div>');
            solution = 'ERROR';
            for(i=0;i<question.options.length;i++) {
                o = question.options[i];
                $('#eselect').html($('#eselect').html() + convert_option_no(o.option_no)+'.'+ o.content+'<br />');
                if(o.is_correct == '1') {solution = convert_option_no(o.option_no);}
            }
            if (question.image != null) {
                $('#eimg').html("<img src=\""+question.image+"\" style=\"width:300px;\" /><div id=\"flashdiv\"></div>");
                $('#eimg').css('visibility', '');
            }
            if (question.video != null) {
                showflash(question.video);
                $('#eimg').css('visibility', '');
                $('#eimg').show();
            }
            $('#esolution').html('正确'+solution);
        }
        var subbar = function(i) {
            if ($('#current_mode').val() != 'running' && $("#current_mode").val() != 'solution') {
                if ($('#current_mode').val() == 'ending') {
                    alert('考试已结束');
                } else
                    alert('请先选择开始');
                return false;
            } else {
                for (j = 1; j <= 7; j++) {
                    $('#bt' + j).removeClass('selected');
                }
                $('#prevSelect').show();
                $('#nextSelect').show();
                if (i == paper.questions.length) {
                    $('#nextSelect').hide();
                }
                if (i == 1) {
                    $('#nextSelect').hide();
                }
                $('#current_select').val(i);
                if (parseInt(draft[i - 1]) > 0 && parseInt(draft[i - 1]) < 8)
                    $('#bt' + draft[i - 1]).addClass('selected');
                question = paper.questions[parseInt($('#current_select').val()) - 1];
                $('#paper_name').html(paper.name);
                $('#esubject').html(question.question_no + '.' + question.title + ' (分值:' + question.score + ')');
                $('#eselect').html('');
                $('#eimg').css('visibility', 'hidden');
                $('#eimg').html('<div id="flashdiv"></div>');
                solution = 'ERROR';
                for (i = 0; i < question.options.length; i++) {
                    o = question.options[i];
                    $('#eselect').html($('#eselect').html() + convert_option_no(o.option_no) + '.' + o.content + '<br />');
                    if (o.is_correct == '1') {
                        solution = convert_option_no(o.option_no);
                    }
                }
                if (question.image != null) {
                    $('#eimg').html("<img src=\"" + question.image + "\" style=\"width:300px;\" /><div id=\"flashdiv\"></div>");
                    $('#eimg').css('visibility', '');
                }
                if (question.video != null) {
                    showflash(question.video);
                    $('#eimg').css('visibility', '');
                    $('#eimg').show();
                }
                $('#esolution').html('正确' + solution);
            }
        }
        var vAnswer = function () {
            $('#card').hide();
            for(i=0; i<result.length; i++) {
                j = i+1;
                if(result[i] == true)
                    $('#bar'+j).addClass('correct');
                else
                    $('#bar'+j).addClass('wrong');
            }
            $('#current_mode').val('solution');
            $('#esolution').css('visibility', '');
            $('#esolution').show();
        }
        var toSelect = function(i) {
            if ($('#current_mode').val() != 'running') {
                if ($('#current_mode').val() == 'ending' || $("#current_mode").val() == 'solution') {
                    alert('考试已结束');
                } else
                    alert('请先选择开始');
                return false;
            } else {
                for(j=1;j<=7;j++)
                    $('#bt'+j).removeClass('selected');
                $('#bt'+i).addClass('selected');
                var current = parseInt($('#current_select').val());
                var options = paper.questions[current-1].options;
                for (j=0; j<options.length; j++) {
                    if (options[j].option_no == i) {
                        submit[current - 1] = options[j].id;
                        if(options[j].is_correct == '1')
                            result[current - 1] = true;
                        else
                            result[current - 1] = false;
                    }
                }
                draft[current - 1] = i;
            }
        }
        var estart = function() {
            if ($('#current_mode').val()=='solution' || $('#current_mode').val() == 'ending') {
                alert('请重新开始或另选试题');
                return false;
            }
            if ($('#current_mode').val() != 'running') {
                var tel = $("#txtmobile").val(); //获取手机号
                var telReg = !!tel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
                if(telReg == false){
                    alert('请输入正确手机号');
                    return false;
                }
                $('#current_mode').val('running');
                $('#hiddenname').val($('#txtname').val());
                $('#hiddengender').val($('#txtsex').val());
                $('#hiddenmobile').val($('#txtmobile').val());
                //countdown('countdown');
                $('.operbar').show();
            } else if ($('#current_mode').val()=='solution'){
                alert('请重新开始或另选试题');
                return false;
            } else {
                return false;
            }
        }
        var interval;
        var minutes = <?php echo $paper->answer_minutes; ?>;
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
            $('#current_mode').val('ending');
            for(i=0; i<=65535; i++)
                clearInterval(i);
            alert('考试结束');
            score = 0;
            for(i = 0; i < result.length; i++) {
                if (result[i] == true) {
                    score += parseInt(paper.questions[i].score);
                }
            }
            $.ajax({
                'type': 'post',
                'url':  '<?php echo site_url('index/submit');?>',
                data : {
                    'paper_id' : <?php echo $paper->id;?>,
                    'submit': JSON.stringify(submit),
                    'name' : $('#hiddenname').val(),
                    'gender' : $('#hiddengender').val(),
                    'mobile_no' : $('#hiddenmobile').val(),
                    'score': score
                },
                success: function (response) {
                    if (response.state == 'success' ) {
                        console.log('success');
                    }
                }
            });
            for(i = 0; i < result.length; i++) {
                $('#fen').html(score);
                if (score >= <?php echo $paper->pass_score;?>) {
                    $('#overText').show();
                    $('#failText').hide();
                } else {
                    $('#overText').hide();
                    $('#failText').show();
                }
            }
            $('#card').show();
            $('#card').css('visibility', '');

        }
    </script>
</head>
<body>
<div class="header" style="width:1000px; margin: 0 auto;">
    <p><span style="font-family: 微软雅黑, 'Microsoft YaHei'; line-height:28px; color: rgb(127, 127, 127);    font-size: 12px; float: right; padding-right: 12px;">城市站点：深圳站 &nbsp; 厦门站 &nbsp; &nbsp;广州站 &nbsp; &nbsp;泉州站</span></p>
    <img class="lazyload" src="http://img.wezhan.cn/content/sitefiles/31602/images/4607700_学车网12_8fb49409-dc80-4b20-b27d-9a44b5744b44_resize_picture.jpeg" data-original="http://img.wezhan.cn/content/sitefiles/31602/images/4607700_学车网12_8fb49409-dc80-4b20-b27d-9a44b5744b44_resize_picture.jpeg" alt="" style="border: none; position: relative; display: inline;">
    <div class="header-col">
        <img class="lazyload" src="http://img.wezhan.cn/content/sitefiles/31602/images/4496903_logo_f082f0b4-89ac-4944-8a8e-31d72cce0938_resize_picture.png" data-original="http://img.wezhan.cn/content/sitefiles/31602/images/4496903_logo_f082f0b4-89ac-4944-8a8e-31d72cce0938_resize_picture.png" alt="" style="border: none; position: relative; display: inline; float:left;">
        <a target="_self" href="/xctj" class="w_button_wrap" style="width: 284px; height: 61px; margin-top:12px;margin-left:50px; line-height: 63px   ;     background-image: url(http://img.wezhan.cn/content/sitefiles/31602/images/4498233_学车推荐12.png); display:block; float:left;">
            <span class="w_button_position">
            <span class="w_button_text editableContent"></span>
            </span>
        </a>
        <div class="tel" style="float:right; height:59px; width: 253px; font-size:12px; margin-top:24px;">
            <img class="lazyload" src="http://img.wezhan.cn/content/sitefiles/31602/images/4496910_电话图标_079c2c8d-1c5c-40f3-843b-43d021681dd9_resize_picture.png" data-original="http://img.wezhan.cn/content/sitefiles/31602/images/4496910_电话图标_079c2c8d-1c5c-40f3-843b-43d021681dd9_resize_picture.png" alt="" style="border: none; position: relative; display: inline; float:left;">
            <p  style="margin-left: 16px; margin-bottom: 8px;float:left;">报名电话：<label style="color:red">0755-33293160</label></p>
            <p style=" margin-left: 16px;float:left;">客服QQ：<label style="color:red">1065200315</label></p>
        </div>
    </div>
</div>
<div style="clear:both"></div>
<style>p{padding:0; margin:0;}</style>
<style>.menuuuu >ul >li >a {color:#fff; text-decoration:none; font-size:14px; line-height:42px; text-align:center; width:142px; height:42px; display:block;}</style>
<style>.menuuuu >ul >li:hover {color:#fff; background: #0162b4;text-decoration:none; font-size:14px;font-weight:bold; width: 142px; height:42px;}</style>
<style>.menuuuu >ul >li {color:#fff; _background: #0162b4;text-decoration:none; font-size:14px;font-weight:bold; float:left;width: 142px; height:42px;}</style>
<div class="menuuuu" style="100%; background:#0476d6" >
    <ul style="width:1000px; margin: 0 auto; height:42px;">
        <li><a href="#">首页</a></li>
        <li><a href="#">学车推荐</a></li>
        <li><a href="#">新闻资讯</a></li>
        <li><a href="#">经验交流</a></li>
        <li><a href="#">模拟考试</a></li>
        <li><a href="#">促销活动</a></li>
        <li><a href="#">学车报名</a></li>
    </ul>
</div>
<div class="bread" style="height:35px;font-size:12px; padding-top:4px;">
    <span style="width:1000px; margin:0 auto;font-size:12px;display:block; line-height:22px;">您当前的位置:首页&nbsp;>&nbsp;深圳站&nbsp;>&nbsp;考试模拟</span>
</div>
<input id="current_select" value="1" type="hidden"/>
<input id="current_mode" value="preparing" type="hidden"><!--ending solution running-->
<input id="hiddenname" value="" type="hidden">
<input id="hiddengender" value="" type="hidden">
<input id="hiddenmobile" value="" type="hidden">
<!--<div id="allow">您所在的位置:<a href="/">首页</a>&gt;&gt;<a href="/exam/">模拟考试</a></div>-->
<div id="jx">
    <div id="left">
        <ul class="list-group">
            <?php foreach($roots as $l) {?>
                <li class="list-group-item">
                    <h4><span><?php echo $l->name;?></span></h4>
                    <ul class="paper-list">
                        <?php foreach($l->papers as $p) {?>
                            <li><a href="<?php echo site_url('index/paper/'.$p->id);?>"><?php echo $p->title; ?></a></li>
                        <?php } ?>
                    </ul>
                    <?php if ($l->has_sub_categories) { ?>
                        <ul class="list-group">
                            <?php foreach($l->roots as $l) {?>
                                <li class="list-group-item">
                                    <h4><span><?php echo $l->name;?></span></h4>
                                    <ul class="paper-list">
                                        <?php foreach($l->papers as $p) {?>
                                            <li><a href="<?php echo site_url('index/paper/'.$p->id);?>"><?php echo $p->title; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                    <?php if ($l->has_sub_categories) { ?>
                                        <ul class="list-group">
                                            <?php foreach($l->roots as $l) {?>
                                                <li class="list-group-item">
                                                    <h4><span><?php echo $l->name;?></span></h4>
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
        <br class="spacer">
    </div>


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
        模拟考试系统  <font size="2" id="examTimePlan" style="display:none;">(剩余时间:<span id="countdown"><?php echo $paper->answer_minutes;?>分00秒</span>)</font>
    </div>
    <div class="examplan">
        <div class="esubject" id="esubject"><?php echo $question->question_no; ?>. <?php echo $question->title; ?> (分值:<?php echo $question->score;?>)</div>

        <div class="eselect" id="eselect" style="font-size:13px;">
            <?php $options = $question->options; ?>
            <?php foreach ($options as $o) {?>
                <?php echo convert_option_no($o->option_no) ;?>. <?php echo $o->content; ?>
                <br>
            <?php } ?>
        </div>



        <div id="eimg" style="<?php echo $question->image==''?"visibility: hidden;":'';?>"><div id="flashdiv"></div></div>





        <div class="answerbar">
            <?php $solution = 'ERROR'; ?>
            <?php foreach($options as $k => $o) {
                if ($o->is_correct == '1') {
                    $solution = convert_option_no($o->option_no);
                    break;
                }
            } ?>
            <p class="eresult" id="eresult">您的回答: <br><span class="solution" id="esolution" style="display:none;">正确<?php echo $solution;?></span></p>
            <input type="button" onclick="toSelect('1')" id="bt1" value="A">
            <input type="button" onclick="toSelect('2')" id="bt2" value="B">
            <input type="button" onclick="toSelect('3')" id="bt3" value="C">
            <input type="button" onclick="toSelect('4')" id="bt4" value="D">
            <input type="button" onclick="toSelect('5')" id="bt5" value="E">
            <input type="button" onclick="toSelect('6')" id="bt6" value="F">
            <input type="button" onclick="toSelect('7')" id="bt7" value="G">


        </div>

        <div class="operbar" style="display:none;">
            <a href="javascript:void(0)" class="btn" style="margin:0;display:none;" onclick="prevSelect();return false" id="prevSelect">上一题</a>
            <a href="javascript:void(0)" class="btn" style="margin:0;" onclick="nextSelect();return false" id="nextSelect">下一题</a>
            <a href="javascript:void(0)" class="btn" style="margin:0;" onclick="esubmit();return false" id="overbtn">交卷</a>
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
        <br><font id="overText">恭喜您通过本次考试</font>
        <br><font id="failText">很遗憾您没有通过本次考试</font>
        <br>合格分数为<?php echo $paper->pass_score;?>分以上
        <br>
        <br>

        <a href="javascript:void(0);" class="btn" onclick="vAnswer()">查看答案</a>
        <br>  <br>
        背景红色为错误题目,点击题目编号查看正确答案
    </div>


</div>
<div style="clear:both"></div>
<div style="width:100%;height:165px;background-color:#858585; margin-top:22px;">
    <div class="footer page_footer" style="width:1000px;height:165px;margin:0 auto;">
        <div class="runTimeflowsmartView"><div id="view_image_33_277117750" class="yibuSmartViewMargin absPos" oldbottom="134">
                <div class="yibuFrameContent overflow_hidden image_Style1_Item0" style="height:84px;width:124px; float:left; margin-top:45px;">    <div class="megwh" style="height:100%; width:100%;">
                        <a id="autosize_view_image_33_277117750" href="javascript:void(0);" target="_self" style="cursor:default;">
                            <img class="lazyload" src="http://img.wezhan.cn/content/sitefiles/31602/images/4231881_QQ图片20150906205946_95e0cee3-faaf-43b5-b6d6-c474016e8282_resize_picture.png" data-original="http://img.wezhan.cn/content/sitefiles/31602/images/4231881_QQ图片20150906205946_95e0cee3-faaf-43b5-b6d6-c474016e8282_resize_picture.png" alt="" style="border: none; position: relative; display: inline;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="textttt" style="font-size:12px; color:#fff; float:left; width: 800px; margin-left:15px; margin-top:22px; line-height: 22px;">
            关于我们  | 广告服务 | 诚聘英才 |  客服中心<br>
            友情链接：广东交管局 |  深圳车管所  |   广州车管所  |  厦门交警网  |   泉州交警网<br>
            公司其他网站：e家邦（完善的家政管理服务系统+好域名，诚招城市加盟，联系电话：13823501956）<br>
            咨询热线：0755-33293160 业务洽谈： 13823501956<br>
            快乐学车网（深圳市易联星空网络科技有限公司旗下）版权所有并保留所有权利 （粤ICP备15077356号）<br>
        </div>
    </div>
</div>
</body>
</html>