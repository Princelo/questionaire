<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>考试系统后台</title>

    <!-- Bootstrap Core CSS -->
    <link href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/assets/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/assets/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="/assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/assets/libs/html5shiv.js"></script>
    <script src="/assets/libs/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/assets/js/jwplayer.js"></script>
    <script>
        var confirm_delete = function(_this) {
            var result = confirm("是否确认删除操作");
            if(result){
                var href = $(_this).attr('bhref');
                window.location.href=href;
            }
        }
    </script>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('backend/index') ?>">考试系统后台</a>
        </div>
        <!-- /.navbar-header -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="<?php echo site_url('category/categories_management') ?>"><i class="fa fa-table fa-fw"></i></i> 试题类别管理</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('paper/papers_list')?>"><i class="fa fa-edit fa-fw"></i> 试题管理</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('paper/paper_add')?>"><i class="fa fa-files-o fa-fw"></i> 新增试题</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('backend/report_sessions')?>"><i class="fa fa-bar-chart-o fa-fw"></i> 考生与成绩</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>


