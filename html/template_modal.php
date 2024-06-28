<!--删除公告的模态框-->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center">你确定要删除这些公告吗?</div>
            <div class="modal-footer" style="display: flex;justify-content: space-around;">
                <button class="btn btn-danger" id="delete_notice">确定</button>
                <button class="btn btn-info" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
<!--公布和修改公告的模态框-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div id="toolbar" style="text-align: center;margin:auto;">
                    <!--样式修改按钮-->
                    <div>
                        <div style="margin-bottom: 5px">
                            字体颜色
                            <input type="color" name="foreColor" value="颜色" class="btn btn-info" id="changeColor">
                            字体大小
                            <select name="fontSize" class="btn btn-info">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <input type="button" name="bold" value="加粗" class="btn btn-info">
                        <input type="button" name="italic" value="斜体" class="btn btn-info">
                        <input type="button" name="underline" value="下划线" class="btn btn-info">
                        <input type="button" name="justifyLeft" value='居左' class="justifyLeft btn btn-info">
                        <input type="button" name="justifyCenter" value='居中' class="justifyCenter btn btn-info">
                        <input type="button" name="justifyRight" value='居右' class="justifyRight btn btn-info">
                        <input type="button" name="selectAll" value='全选' class="selectAll btn btn-info">
                        <input type="button" name="undo" value='撤销' class="undo btn btn-info">
                    </div>
                    <!--图片,附件上传按钮-->
                    <div style="margin-top: 5px">
                        <form style="display: flex;justify-content: space-around;margin-top: 5px" id="FILE">
                            <input type="file" name="file" style="text-align: right;padding: 11px;width: 208px"
                                class="file">
                            <input type="button" name="insertImage" value='插入图片' class="insertImage btn btn-info"
                                id="notice_img_insert">
                            <input type="button" name="insertImage" value='上传附件' class="insertImage btn btn-info"
                                id="notice_enclosure_insert">
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="edit">
                <!--标题-->
                <p style="margin-top: 10px;">标题</p>
                <div style="border:1px solid gray;padding: 5px;overflow: auto;" contenteditable="true">
                </div>
                <!--正文-->
                <p style="margin-top: 10px;">*正文</p>
                <div style="height:500px;border:1px solid gray;padding: 5px;overflow: auto;" contenteditable="true">
                </div>
            </div>
            <div class="modal-footer" style="display: flex;justify-content: space-around;">
                <button type="button" class="btn btn-primary" id="publish_or_modify">发布</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="../js/check.js"></script>
<!--注册模态框-->
<div class="modal fade" tabindex="-1" role="dialog" id="registerModal">
    <form action="../php/checkRegister.php" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">用户注册</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="userName1">用户名</label>
                        <input type="text" class="form-control" name="userName1" id="userName1"
                            onblur="checkRegUsername()" placeholder="用户名">
                        <span id="usernameMsg1" style="font-size:15px">6~16个字符，可使用字母、数字、下划线，需以字母开头</span>
                    </div>
                    <div class="form-group">
                        <label for="userPwd1">密码</label>
                        <input type="password" class="form-control" name="userPwd1" id="userPwd1" onblur="checkRegPwd()"
                            placeholder="密码">
                        <span id="passwordMsg1" style="font-size:15px">6~20个字符，区分大小写</span>
                    </div>
                    <div class="form-group">
                        <label for="repeateuserPwd">确认密码</label>
                        <input type="password" class="form-control" name="repeateuserPwd" id="repeateuserPwd"
                            onblur="checkRegCfmPwd()" placeholder="确认密码">
                        <span id="pwdCfmMsg" style="font-size:15px">请再次填写密码</span>
                    </div>
                    <div class="form-group">
                        <label for="telephone1">手机号</label>
                        <input type="tel" class="form-control" name="telephone1" id="telephone1" onblur="checkRegTel()"
                            placeholder="手机号">
                        <span id="telMsg" style="font-size:15px">忘记密码可用手机号快速登录</span>
                    </div>
                    <div class="form-group">
                        <label for="email1">邮箱</label>
                        <input type="email" class="form-control" name="email1" id="email1" onblur="checkRegEmail()"
                            placeholder="邮箱">
                        <span id="emailMsg"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <input type="submit" id="Register" class="btn btn-primary" value="注册"></input>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="captchaModal">
    <form>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">手机验证码登录</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="telephone_">手机号</label>
                        <input type="tel" class="form-control" name="telephone" id="telephone_" placeholder="手机号"
                            onblur="checkRegTel()">
                        <span id="telMsg_"></span>
                    </div>
                    <div class="form-group">
                        <label for="captcha_">验证码</label>
                        <input type="text" class="form-control" name="captcha" id="captcha_" placeholder="验证码">
                        <button type="button" id="getCode" class="btn btn-primary"
                            style="margin-top: 1rem;">获取验证码</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="loginForCode">登录</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    //发送手机验证码
    $("#getCode").click(function () {
        $.post("phpsdk/api_demo/SmsDemo.php", {
            phone: $("#telephone_").val()
        }, function (data) {
            alert("发送成功!");
        })
    });
    //使用手机验证码登录
    $("#loginForCode").click(function () {
        $.post("../php/checkLogin.php", {
            code: $("#captcha_").val(),
            phone: $("#telephone_").val(),
            isPhone: true
        }, function (data) {
            var rs = $.parseJSON(data);
            if (rs.success == true)
                window.location.href = '../html/homePage.php';
            else
                alert("验证码错误!");
        })
    });
</script>

<div class="modal fade" tabindex="-1" role="dialog" id="orderModal">
    <form action="../php/insertOrder.php" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">食品下单</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="foodName">食品</label>
                        <input type="text" class="form-control" name="foodName" id="foodName" placeholder="请先选择食品"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="price">价格/元</label>
                        <input type="number" class="form-control" name="price" id="price" readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">收货地址</label>
                        <input type="text" class=" form-control" name="address" id="address" onblur="checkAdress()"
                            placeholder="请输入收货地址">
                        <span id="adressMsg"></span>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button id="order_confrim" type="submit" class="btn btn-primary">下单</button>
                </div>
            </div>
        </div>
    </form>
</div>