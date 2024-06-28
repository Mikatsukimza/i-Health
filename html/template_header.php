<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--Logo-->
            <a class="navbar-brand" href="homePage.php" style="color: white;">i-Health</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a>
                        <?php
                        session_start();
                        if($_SESSION["issign"]==1)
                            echo "<button class=\"btn btn-info\" id=\"sign\" style=\"color: gray\">已打卡</button>";
                        else
                            echo "<button class=\"btn btn-info\" type='submit' id=\"sign\">今日打卡</button>";
                        ?>
                    </a>
                </li>
                <li><a href="login.php"><button class="btn btn-warning">退出登录</button></a></li>
            </ul>
        </div>
    </div>
</nav>