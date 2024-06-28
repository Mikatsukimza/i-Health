<!DOCTYPE HTML>
<html>

<head>
    <title>菜谱</title>
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
            <!--食谱-->
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <?php include("food.php") ?>
            </div>
        </div>
    </div>
    <script src="../js/function.js"></script>
</body>

</html>