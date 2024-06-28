//删除公告
$('#delete_notice').click(function () {
    var arr_select = []; //要删除的公告
    $("input[name='announcement']:checked").each(function (index, item) {
        arr_select.push(item.parentNode.nextSibling.textContent);
    });
    if (arr_select.length == 0) {
        alert("请至少选中一个再删除");
        return;
    }
    $.post("../php/delete_notice.php", {
        'arr_select': arr_select
    }, function (data) {
        var result = $.parseJSON(data);
    });
    window.location = "../html/announcementConsultation.php"; //删除以后跳转到公告咨询
});