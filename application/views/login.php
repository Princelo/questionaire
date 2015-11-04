<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>考试系統管理后台</title>
    <link rel="stylesheet" href="/assets/css/login.css">

    <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body>

<script type="text/javascript" charset="utf-8">
</script>
<div class="page_margins">
    <div class="page">


        <!-- begin: main content area #main -->
        <div id="main">

            <!-- begin: #col5 static column -->
            <div id="col5" role="main" class="one_column">
                <div id="col5_content" class="clearfix"  align="center">


                    <!--<div style="background:url('includes/images/login_interface.jpg'); width:500px; height:300px;border:6px solid #fff">-->
                    <div>
                        <h1 class="title">管理员登录</h1>
                        <h2 class=""></h2>
                        <p style="width:100%; text-align:center; color:#f00;">
                            <?php if($this->session->flashdata('flashdata') != null) {$f = $this->session->flashdata('flashdata');echo $f['message'];}?>
                        </p>


                        <!-- begin: Login Form -->
                        <!--<div class="center" style="width:400px;padding-top:80px;">-->
                        <div class="center">



                            <div align="left">
                                <form action="<?php echo site_url('login/do_login')?>" method="post" class="yform columnar" id="frm">


                                    <div style="width:113px; margin:0 auto; margin-bottom: 10px;">
                                        <img src="/assets/images/photo.png" style="width:113px; margin:0 auto"/>
                                    </div>
                                    <input type="text" name="login_id" value="" id="login_id" class="google_textfield google_email" placeholder="登入帐号 "  />
                                    <input type="password" name="password" value="" id="password" class="google_textfield google_email" placeholder="密码 "  />

                                    <div class="info_msg">
                                    </div>

                                    <div class="type-button" align="right">

                                        <input type="submit" name="btnSubmit" value="登入 "  />										<input type="reset" value="重设 " class="reset" id="btnReset" name="btnReset" />
                                        <input type="hidden" value="" id="system" name="system" />
                                    </div>

                                </form>								</div>
                            <div align="" style="color:red;font-weight:bold">
                            </div>
                        </div>
                        <!-- end: Login Form -->



                    </div>


                </div>
                <!-- IE Column Clearing -->
                <div id="ie_clearing">&nbsp;</div>
            </div>
            <!-- end: #col5 -->

        </div>
        <!-- end: #main -->
    </div>
</div>
</body>
</html>
