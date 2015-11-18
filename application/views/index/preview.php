<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>考试系统</title>
    <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="/assets/css/index.css?v=15">
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

    <div class="qlist">
        <a class="green" href="#">
            <p class="h2">科目一章节练习</p>
            (驾驶员考试网)
        </a>
        <a class="green" href="#">
            <p class="h2">科目一模拟考试</p>
            (驾驶员考试网)
        </a>
        <a class="red" href="#">
            <p class="h2">科目四章练习</p>
            (驾驶员考试网)
        </a>
        <a class="red" href="#">
            <p class="h2">科目四模拟考试</p>
            (驾驶员考试网)
        </a>
    </div>




</div>
<div style="clear:both"></div>
<div style="width:100%;height:165px;background-color:#858585;">
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