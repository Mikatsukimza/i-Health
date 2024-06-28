<div id="content">
    <form class="login" method="post">
        <div class="form-group">
            <label for="userName">用户名</label>
            <input type="text" class="form-control" id="userName" name="userName" onblur="checkUsername()"
                placeholder="用户名">
            <span id="usernameMsg"></span>
        </div>
        <div class="form-group">
            <label for="userPwd">密码</label>
            <input type="password" class="form-control" id="userPwd" name="userPwd" onblur="checkPassword()"
                placeholder="密码">
            <span id="passwordMsg"></span>
        </div>
        <a id="captcha" data-toggle="modal" style="font-size: 0.9em; color: dodgerblue;">忘记密码?手机验证码登录</a>
        <button id="login_btn" type="button" class="btn btn-success" style="width: 50%;">登录</button>
        <a id="register" data-toggle="modal" href="" style="font-size: 0.9em; color: dodgerblue;">立即注册</a>
    </form>
</div>
<script type="text/javascript">
    $("#login_btn").click(function () {
        if (!checkUsername() || !checkPassword()) return;
        var tmp = {
            userName: $("#userName").val(),
            userPwd: $("#userPwd").val()
        };
        $.post("../php/checkLogin.php", tmp, function (data) {
            var rs = $.parseJSON(data);
            if (rs.success == true)
                window.location.href = "../html/homePage.php";
        });
    });
</script>