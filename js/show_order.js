//显示订单
Calendar.setup({
    inputField: "J_time_start",
    ifFormat: "%Y-%m-%d",
    showsTime: false,
    timeFormat: "24"
});
Calendar.setup({
    inputField: "J_time_end",
    ifFormat: "%Y-%m-%d",
    showsTime: false,
    timeFormat: "24"
});
$("#time_search").click(function () {
    var date = {
        start: $("#J_time_start").val(),
        end: $("#J_time_end").val()
    };
    var reg = /^((((19|20)\d{2})-(0?[13-9]|1[012])-(0?[1-9]|[12]\d|30))|(((19|20)\d{2})-(0?[13578]|1[02])-31)|(((19|20)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|((((19|20)([13579][26]|[2468][048]|0[48]))|(2000))-0?2-29))$/;
    if (reg.test(date.start) == false) {
        alert("起始时间格式不正确");
        return;
    }
    if (reg.test(date.end) == false) {
        alert("截止时间格式不正确");
        return;
    }
    if (date.end < date.start) {
        alert("查询时间不正确");
        return;
    }
    $.ajaxSettings.async = false;
    $.post("../php/getOrder_time.php", date, function (data) {
        result = $.parseJSON(data);
        showTable_first_order(result);
    });
    $.ajaxSettings.async = true;
});
var result;
$.ajaxSettings.async = false;
$.post("../php/getOrder.php", "", function (data) {
    result = $.parseJSON(data);
    showTable_first_order(result);
});
$.ajaxSettings.async = true;
$(document).on("click", "a.page_link", function (e) {
    var curPage = $(this).attr("data-id");
    showTable_last_order(result, curPage);
});