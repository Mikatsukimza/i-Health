<!DOCTYPE HTML>
<html>

<head>
    <title>健康数据检测</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../css/main.css" />
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/file.css" />
    <link rel="stylesheet" href="../css/card.css" />
    <link rel="stylesheet" href="../css/home.css"/>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="../js/jquery.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
</head>

<body>
    <!--头部-->
    <?php include("template_header.php");
        include("template_modal.php");
    ?>
    <div class="container-fluid">
        <div class="row">
            <!--导航栏-->
            <?php include("template_sidebar.php") ?>
            <main class="main">
                <section class="list-item">
                    <div class="item-image" style="background:#d8f3dc">
                        <img src="../image/data.jpg">
                    </div>
                    <div class="item-text">
                        <div class="text-title">[数据评估]</div>
                        <div class="text-desc">
                            <div id="progressScore" style="margin-top:60px;"></div>
                        </div>
                    </div>
                </section>
                <section class="list-item">
                    <div class="item-image" style="background:#b8bedd">
                        <img src="../image/run4.jpg">
                    </div>
                    <div class="item-text">
                        <div class="text-title">[运动建议]</div>
                        <div class="text-desc">
                            <p  id="exercise"></p>
                        </div>
                    </div>
                </section>
                <section class="list-item">
                    <div class="item-image">
                        <img src="../image/food3.jpg">
                    </div>
                    <div class="item-text">
                        <div class="text-title">[饮食建议]</div>
                        <div class="text-desc" id="diet">
                            <p id="diet"></p>
                        </div>
                        <button type="button" class="btn btn-success" id="overbookss">立即下单</button>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script src="../js/function.js"></script>
    <script type="text/javascript">
        $.post("../php/getData.php", "", function (data) {
            var item = $.parseJSON(data);
            var str = "";
            var score = 0;
            var saves = new Object();
            if (item.heart_rate < 60) {
                score += 15;
                saves.heart_rate = 1;
            } else if (item.heart_rate >= 60 && item.heart_rate <= 100) {
                score += 25;
                saves.heart_rate = 2;
            } else if (item.heart_rate > 100 && item.heart_rate <= 135) {
                score += 15;
                saves.heart_rate = 3;
            } else if (item.heart_rate > 135 && item.heart_rate <= 155) {
                score += 10;
                saves.heart_rate = 4;
            } else if (item.heart_rate > 155) {
                score += 5;
                saves.heart_rate = 5;
            }
            //收缩压
            var systolic = item.blood_presure.substring(0, item.blood_presure.indexOf('/'));
            //舒张压
            var diastole = item.blood_presure.substring(item.blood_presure.indexOf('/') + 1, item.blood_presure
                .length);
            if (systolic >= 100 && systolic < 120 && diastole >= 60 && diastole < 80) { //正常血压
                score += 25;
                saves.blood_pressure = 1;
            } else if (systolic >= 120 && systolic <= 139 && diastole >= 80 && diastole <= 90) { //正常高压
                score += 20;
                saves.blood_pressure = 2;
            } else if (systolic > 139 && diastole > 90) { //高血压
                score += 5;
                saves.blood_pressure = 3;
            } else if (systolic > 139 && diastole < 90) { //单纯收缩期高血压
                score += 15;
                saves.blood_pressure = 4;
            } else { //低血压
                score += 15;
                saves.blood_pressure = 5;
            }
            //BMI
            var bmi = item.weight / (item.height * item.height);
            if (bmi < 18.5) {
                score += 25;
                saves.bmi = 1;
            } else if (bmi >= 18.5 && bmi < 23.9) {
                score += 15;
                saves.bmi = 2;
            } else if (bmi >= 23.9 && bmi < 28) {
                score += 10;
                saves.bmi = 3;
            } else if (bmi >= 28) {
                score += 5;
                saves.bmi = 4;
            }
            //体温
            if (item.temperature < 36.3) {
                score += 15;
                saves.temp = 1;
            } else if (item.temperature >= 36.3 && item.temperature <= 37.2) {
                score += 25;
                saves.temp = 2;
            } else if (item.temperature > 37.2 && item.temperature <= 39.1) {
                score += 10;
                saves.temp = 3;
            } else if (item.temperature > 39.1) {
                score += 5;
                saves.temp = 4;
            }
            str += "您的健康分数评估为" + score + "分";
            $("#progressScore").html(str);
            var food = [];
            $.ajax({
                type: 'post',
                url: '../php/getExercise.php',
                data: saves,
                success: function (data) {
                    var result = $.parseJSON(data);
                    var str = "",
                        food = [];
                    $.each(result, function (i, item) {
                        str += "<p>";
                        str += item.advice;
                        str += "</p>";
                        food.push(item.food_id);
                    });
                    $.post("../php/getDiet.php", {
                        food: food
                    }, function (data) {
                        var result = $.parseJSON(data);
                        var str = "";
                        var price = 0;
                        str += "<table>";
                        $.each(result, function (i, item) {
                            str += "<tr>";
                            str += " " + item.food_name + " ";
                            str += "</tr>";
                            price += item.food_price;
                        });
                        str += "<tr><td style='color:red'>价格:" + price + "</td></tr>";
                        // str += "<tr><td><button type='button' class='btn btn-default' href='foodMenu.php'>立即下单</button></td><tr>";
                        str += "</table>";
                        $("#diet").html(str);
                        $("#overbookss").click(function () {
                            // window.location.href = "../html/foodMenu.php";
                            var arr = [];
                            var sum = 0;
                            $.each(result, function (i, item) {
                                arr.push(item.food_name + "1 ");
                                sum += item.food_price;
                            });
                            if (sum == 0)
                                alert("请先正确输入食品数量后再下单");
                            else
                                $('#orderModal').modal();
                            $("#foodName").val(arr);
                            $("#price").val(sum);
                        });
                    });
                    $("#exercise").html(str);
                },
                error: function () {
                    alert("没有传到数据");
                }
            });
        })
    </script>
</body>

</html>