<div class="col-sm-3 col-md-2 sidebar" style="color:#FFFFCC;">
    <ul class="nav nav-sidebar" id="sidebar">
        <!--头像-->
        <?php
        echo "<a href='personalMsg.php'><img src='".$_SESSION["userimg"]."' style='background: white;'></a>";
        ?>
        <!--用户名-->
        <h2 style="color: white">
            <?php
            echo $_SESSION["username"];
            ?>
        </h2>
        <!--个人健康数据-->
        <li><a href="personalHealthData.php">个人健康数据</a></li>
        <!--健康数据评估-->
        <li><a href="healthDataAssessment.php">健康数据评估</a></li>
        <!--食物健康管理-->
        <li class="dropdown">
            <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="true">
                食物健康管理
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="foodMenu.php" style="text-align:center">食谱</a></li>
                <li><a href="searchOrder.php" style="text-align:center">订单查询</a></li>
            </ul>
        </li>
        <!--公告资讯-->
        <li><a href="announcementConsultation.php" id="notice">公告资讯</a></li>
    </ul>
</div>