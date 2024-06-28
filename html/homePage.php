<!DOCTYPE HTML>
<html>

<head>
    <title>首页</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../css/main.css" />
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include("template_header.php") ?>
    <div class="container-fluid">
        <div class="row">
            <?php include("template_sidebar.php") ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div style="font-size: 6rem;text-align: center;">
                    <p>i-Health,您的健康管家</p>
                </div>
                <div style="margin-left: 200px;margin-top: 100px;margin-right:200px;font-size: 3rem">
                    <p>欢迎来到i-Health智能社区健康管理平台。我们提供的服务有：记录您的身体健康
                        数据、能够对您的身体健康数据做出评估分析并且能够有针对性的提出合理建议，保障
                        您的每日营养所需，适当的监督运动提醒等服务。</p>
                </div>
                <div>
                    <div class="row" style="margin-left: 200px;margin-right: 200px;">
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="../image/icon.png" alt="..." style="width: 100px;">
                                <div class="caption">
                                    <h3>检测心率</h3>
                                    <p>看护您的身体</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="../image/shuju.png" alt="..." style="width: 100px;">
                                <div class="caption">
                                    <h3>数据评估</h3>
                                    <p>提供专业指导</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="../image/yundong1.png" alt="..." style="width: 100px;">
                                <div class="caption">
                                    <h3>运动监督</h3>
                                    <p>摆脱拖延焦虑</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="../image/shiwu.png" alt="..." style="width: 100px;">
                                <div class="caption">
                                    <h3>定制食谱</h3>
                                    <p>保证营养全面</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/function.js"></script>
</body>

</html>