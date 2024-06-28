<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/check.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <title>登录</title>
</head>
<body>
<!-- header -->
<?php include("template_header.php");?>

<!-- content -->
<?php include("template_login.php");?>

<!-- footer -->
<?php include("template_footer.php");?>

<!-- modal -->
<?php include("template_modal.php");?>


<script type="text/javascript">
    $("#navbar").remove();
    $(".navbar-brand").css("margin-bottom","10px");
    $(function(){
        $('#register').click(function(){
            $('#registerModal').modal();
        });
        $('#captcha').click(function(){
            $('#captchaModal').modal();
        });
    });
</script>
</body>
</html>