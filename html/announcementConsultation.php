<!DOCTYPE HTML>
<html>

<head>
    <title>公告资讯</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../css/main.css" />
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../calendar/calendar-blue.css">
    <link rel="stylesheet" href="../css/file.css" />
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="../js/jquery.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="../js/bootstrap.js"></script>
    <script src="../calendar/calendar.js"></script>
</head>

<body>
    <!--头部-->
    <?php include("template_header.php") ?>
    <div class="container-fluid">
        <div class="row">
            <!--导航栏-->
            <?php include("template_sidebar.php") ?>
            <!--公告资讯-->
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <!--按钮-->
                <form class="row placeholders" id="search">
                    <?php
                    if($_SESSION['userrole']==1) {
                        echo "<button class=\"btn btn-info\" type=\"button\" data-toggle=\"modal\" data-target=\"#myModal\" id=\"notice_to_publish\">发布公告</button>
                <button class=\"btn btn-info\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" type=\"button\">删除公告</button>
                <button class=\"btn btn-info\" type=\"button\" data-toggle=\"modal\" data-target=\"#myModal\" id=\"notice_to_modify\">修改公告</button>
                <div class=\"navbar-form navbar-left\">
                    发布时间：
                    <input type=\"text\" class=\"form-control date\" name=\"time_start\" id=\"J_time_start\" size=\"12\">
                    至
                    <input type=\"text\" class=\"form-control date\" name=\"time_end\" id=\"J_time_end\" size=\"12\">
                    <button type=\"button\" class=\"btn btn-info\" id=\"time_search\">查询</button>
                </div>";
                    }
                    else {
                        echo "<div class=\"navbar-form navbar-left\">
                    发布时间：
                    <input type=\"text\" class=\"form-control date\" name=\"time_start\" id=\"J_time_start\" size=\"12\">
                    至
                    <input type=\"text\" class=\"form-control date\" name=\"time_end\" id=\"J_time_end\" size=\"12\">
                    <button type=\"button\" class=\"btn btn-info\" id=\"time_search\">查询</button>
                </div>";
                    }
                ?>
                </form>

                <!--页表-->
                <div class="table-responsive" id="notice_table">
                    <table class="table table-striped" id="list"></table>
                    <p id="pages" style="text-align: center;"></p>
                </div>
            </div>
        </div>
    </div>
    <!--模态框-->
    <?php include("template_modal.php") ?>
    <script src="../js/function.js"></script>
    <script src="../js/show_notice.js" class="wantDelete"></script>
    <script src="../js/selectToDel.js"></script>
    <script src="../js/publish.js"></script>
</body>

</html>