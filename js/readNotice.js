//获取当前页面url
var wantSearchNotice = window.location.search;
//获取url的变量值
wantSearchNotice = wantSearchNotice.substring(wantSearchNotice.indexOf('=') + 1, wantSearchNotice.length);
//从数据库获取作者和公布时间以及正文
$.post("../php/getNotice.php", {
    onlyOne: wantSearchNotice
}, function (data) {
    result = $.parseJSON(data);
    var Main = $(".main").children(); //获取.main的所有儿子
    var str = "<h3>" + result[0].notice_title + "</h3>";
    Main.eq(1).html(str); //第一个儿子
    str = "作者:" + result[0].notice_writer + " 公布时间：" + result[0].publish_time;
    Main.eq(2).html(str); //第二个儿子
    Main.eq(3).html(result[0].notice_text); //第三个儿子
});