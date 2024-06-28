<!DOCTYPE HTML>
<html>

<head>
    <title>个人健康数据</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../css/main.css" />
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/file.css" />
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="../js/jquery.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
</head>

<body>
    <!--头部-->
    <?php include("template_header.php") ?>
    <div class="container-fluid">
        <div class="row">
            <!--导航栏-->
            <?php include("template_sidebar.php") ?>
            <!--个人健康数据-->
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div>
                    <h2>个人健康数据</h2>
                </div>
                <hr>
                <div style="height: 50%;width: 100%;text-align: center">
                    <!--个人信息-->
                    <div style="height: 100%;width: 50%;float: left;">
                        <table class="table table-striped" style="height: 100%;">
                            <tbody id="user_information"></tbody>
                        </table>
                    </div>
                    <!--雷达图-->
                    <div id="chars_radio" style="height: 100%;width: 50%;float: left"></div>
                </div>
                <hr>
                <!--折线图选择按钮-->
                <div class="btn-group">
                    <button id="whichChars" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        请选择图表<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="item_chars">血压</a></li>
                        <li><a class="item_chars">心率</a></li>
                        <li><a class="item_chars">体温</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a class="item_chars">身高</a></li>
                        <li><a class="item_chars">体重</a></li>
                    </ul>
                </div>
                <!--折现图容器-->
                <div id="chars_line" style="height: 50%;width: 100%;"></div>
            </div>
        </div>
    </div>
    <script src="../js/function.js"></script>
    <script type="text/javascript" src="../js/drawChars.js"></script>
</body>

</html>