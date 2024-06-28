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
    <script src="../js/check.js"></script>
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
                <form style="width: 20vw;" class="container" id="uploadForm">
                    <div class="form-group">
                        <label for="exampleInputImg">头像上传<img class="thumbnail" id="IMAGE"
                                style="width: 200px;height: 200px" src=<?php echo $_SESSION["userimg"] ?>></label>
                        <input id="exampleInputImg" type="file" name="file">
                        <p class="help-block">
                            <button type="button" class="btn btn-warning" id="upload">上传</button>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">用户名</label>
                        <input type="text" class="form-control" id="exampleInputName" onblur="checkexampleInputName()"
                            placeholder="请输入你的用户名" value=<?php echo $_SESSION["username"] ?>>
                        <span id="exampleInputNameMsg"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">密码</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            onblur="checkexampleInputPassword1()" placeholder="请输入你的密码"
                            value=<?php echo $_SESSION["userpassword"] ?>>
                        <span id="exampleInputPassword1Msg"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone">手机号</label>
                        <input type="text" class="form-control" id="exampleInputPhone" onblur="checkexampleInputPhone()"
                            placeholder="请输入你的手机号" value=<?php echo $_SESSION["telephone"] ?>>
                        <span id="exampleInputPhoneMsg"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">邮箱</label>
                        <input type="email" class="form-control" id="exampleInputEmail"
                            onblur="checkexampleInputEmail()" placeholder="请输入你的邮箱"
                            value=<?php echo $_SESSION["email"] ?>>
                        <span id="exampleInputEmailMsg"></span>
                    </div>
                    <button type="button" class="btn btn-success" id="saveMsg">保存修改</button>
                    <button type="button" class="btn btn-primary" id="cancelMsg">重置</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $("#upload").click(function () {
                var formData = new FormData($('#uploadForm')[0]);
                $.ajax({
                    type: 'post',
                    url: "../php/upload_file.php",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                }).success(function (data) {
                    var rs = $.parseJSON(data);
                    $("#IMAGE").attr('src', rs.link);
                }).error(function () {
                    alert("上传失败");
                });
            });
            $("#saveMsg").click(function () {
                var tmp = {
                    image: $("#IMAGE")[0].src,
                    name: $("#exampleInputName").val(),
                    pwd: $("#exampleInputPassword1").val(),
                    phone: $("#exampleInputPhone").val(),
                    email: $("#exampleInputEmail").val()
                };
                $.post("../php/updateMsg.php", tmp, function (data) {
                    console.log(data);
                    var rs = $.parseJSON(data);
                    window.location.href = "homePage.php";
                });
            });
            $("#cancelMsg").click(function () {
                window.location.href = "personalMsg.php";
            });
        });
    </script>
</body>

</html>