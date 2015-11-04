<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
<div id="left">


    <h2><span>试题选择(科目一)</span></h2>
    <ul>
        <li><a href="/exam/ks1.html" class="selected">小车试题 (C1,C2,C3)</a></li>
        <li><a href="/exam/ks2.html">货车试题 (A2,B2)</a></li>
        <li><a href="/exam/ks3.html">客车试题 (A1,A3,B1)</a></li>
    </ul>

    <h2><span>试题选择(科目四)</span></h2>
    <ul>
        <li><a href="/exam/ks4.html">安全文明试题(小车.货车.客车)</a></li>

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
                    <strong> 科目一_小车试题 (C1,C2,C3)</strong>
                    <hr size="1" color="#ff9900">
                </td>
            </tr>

            <tr>
                <td class="caption">姓名:</td>
                <td> <input class="text" style="width:80px" name="txtname" id="txtname" maxlength="6" value=""><font color="red">*</font></td>
                <td class="caption">性别:</td>
                <td><select class="text" style="width:50px;" name="txtsex" id="txtsex"><option>男</option><option>女</option></select><font color="red">*</font></td>

                <td class="caption">手机号码:</td>
                <td> <input class="text" style="width:200px;ime-mode:disabled" name="txtmobile" maxlength="11" value="" id="txtmobile"><font color="red">*</font></td>
            </tr>

            <tr>
                <td></td>
                <td colspan="5" style="color:rgb(183, 13, 13)">1.考试时间为45分钟<br>2.合格分数为90分.</td>
            </tr>

            <tr>
                <td colspan="6">
                    <a href="javascript:void(0)" class="btn" onclick="reStart();return false;">重考</a>
                    <a href="javascript:void(0)" class="btn" onclick="start(this);return false;">开始</a>

                </td>
            </tr>



            </tbody></table>
        <input type="hidden" id="cityID" value="200">
        <input type="hidden" id="ct" value="1">
    </form>

    <div class="examsv">
        模拟考试系统  <font size="2" id="examTimePlan">(剩余时间:45分00秒)</font>
    </div>
    <div class="examplan">
        <div class="esubject" id="esubject">1. 拼装的机动车只要认为安全就可以上路行驶。[单选题]</div>

        <div class="eselect" id="eselect">A. 正确<br>B. 错误<br></div>



        <div id="eimg" style="visibility: hidden;"><div id="flashdiv"></div></div>




        <script type="text/javascript" language="javascript">
            var esubtype="1";

            function showImg(ipath)
            {
                var cpath="/images/exam/2014/"+ipath;
                //alert(ipath)
                var cdiv=window.document.getElementById("eimg");
                if(ipath=="")
                {
                    cdiv.style.visibility="hidden";
                }else
                {
                    if(ipath.indexOf('.flv')>0)
                    {
                        showflash(cpath)
                        var a=window.document.getElementById("flashdiv_wrapper");
                        try{a.style.cssFloat="left";}catch(e){a.style.styleFloat="left"}
                    } else
                    {
                        cdiv.innerHTML='<div id="flashdiv"><img  src="'+cpath+'" height="185px" width="290px"/></div>'
                    }
                    cdiv.style.visibility="visible";
                }

            }
        </script>

        <div class="answerbar">
            <p class="eresult" id="eresult">您的回答: </p>
            <input type="button" onclick="toSelect('A',this)" id="bta" value="A">
            <input type="button" onclick="toSelect('B',this)" id="btb" value="B">
            <input type="button" onclick="toSelect('C',this)" id="btc" value="C">
            <input type="button" onclick="toSelect('D',this)" id="btd" value="D">


        </div>

        <div class="operbar">

            <a href="javascript:void(0)" class="btn" style="margin:0;" onclick="overExam();return false" id="overbtn">交卷</a>
            <a href="javascript:void(0)" class="btn" style="margin:0;" onclick="nextSelect();return false">下一题</a>
            <a href="javascript:void(0)" class="btn" style="margin:0;" onclick="preSelect();return false">上一题</a>


        </div>

    </div>

    <div class="card" id="card">
        <br>
        <font size="4">成绩卡:</font>
        <br>
        <br>
        <br>
        您的分数为<font color="red" id="fen">28分</font>
        <br><font id="overText">很遗憾您没有通过本次科目一理论考试</font>
        <br>合格分数为90分以上
        <br>
        <br>

        <a href="javascript:void(0);return false" class="btn" onclick="vAnswer()">查看答案</a>
        <br>  <br>
        背景红色为错误题目,点击题目编号查看正确答案
    </div>


</div>
</body>
</html>