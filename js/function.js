//修改信息上传头像
$("#uploadFile").click(function () {
    var tmpFile = new FormData($('#uploadForm')[0]);
    var wantUploadLink;
    $.ajaxSettings.async = false;
    $.ajax({
        type: 'post', //post形式
        url: "../php/upload_file.php", //请求的url
        data: tmpFile, //传递参数
        cache: false,
        processData: false,
        contentType: false,
    }).success(function (data) { //成功的回调函数
        wantUploadLink = $.parseJSON(data);
    }).error(function () { //失败的回调函数
        alert("上传失败");
    });
    $.ajaxSettings.async = true;
});
//打卡
$("#sign").click(function () {
    $.post("../php/signToday.php", function (data) {
        var rs = $.parseJSON(data);
        if (rs.success)
            alert("打卡成功,今日健康数据生成(数据来源于智能手表)");
        else
            alert("已打卡");
        $("#sign").text("已打卡");
        $("#sign").css('color', "grey");
    });
});
function showTable_first_notice(result) {
    const PAGE_SIZE = 20;
    var iCount = 0;
    var curPage = 1;
    var iSum = 0;
    var str = "";
    iCount = (curPage - 1) * PAGE_SIZE;

    str += "<thead>";
    str += "<tr>";
    str += "<th>#</th>";
    str += "<th>公告编号</th>";
    str += "<th>公告标题</th>";
    str += "<th>浏览次数</th>";
    str += "<th>发布时间</th>";
    str += "</tr>";
    str += "</thead>";
    str += "<tbody>";
    $.each(result, function (index, item) {
        if (iCount < curPage * PAGE_SIZE) {
            str += "<tr>";
            str += "<td><input type='checkbox' class='checkbox' name='announcement'/></td>";
            str += "<td>" + item.notice_id + "</td>";
            str += "<td><a href='javascript:void(0)' onclick='jumpToText(this)' class='jumpToText'>" + item.notice_title + "</a></td>";
            str += "<td>" + item.notice_views + "</td>";
            str += "<td>" + item.publish_time + "</td>";
            str += "</tr>";
            iCount++;
        }
        iSum++;
    });
    str += "</tbody>";
    $("#list").html(str);
    str = "";
    var pages = Math.ceil(iSum / PAGE_SIZE);
    for (var i = 1; i <= pages; i++) {
        str += "<a href='#' data-id=" + i + " class='page_link btn btn-default' style='margin-left:5px'>" + i + "</a>";
    }
    $("#pages").html(str);
}
//公告的后续页面显示
function showTable_last_notice(result, curPage) {
    const PAGE_SIZE = 20;
    var iCount = 0;
    var str = "";
    iCount = (curPage - 1) * PAGE_SIZE;
    str += "<thead>";
    str += "<tr>";
    str += "<th>#</th>";
    str += "<th>公告编号</th>";
    str += "<th>公告标题</th>";
    str += "<th>浏览次数</th>";
    str += "<th>发布时间</th>";
    str += "</tr>";
    str += "</thead>";
    str += "<tbody>";
    $.each(result, function (index, item) {
        if (index == iCount && iCount < curPage * PAGE_SIZE) {
            str += "<tr>";
            str += "<td><input type='checkbox' class='checkbox' name='announcement'/></td>";
            str += "<td>" + item.notice_id + "</td>";
            str += "<td><a href='javascript:void(0)' class='jumpToText'>" + item.notice_title + "</a></td>";
            str += "<td>" + item.notice_views + "</td>";
            str += "<td>" + item.publish_time + "</td>";
            str += "</tr>";
            iCount++;
        }
    });
    str += "</tbody>";
    $("#list").html(str);
    return false;
}
//订单的第一张页面显示
function showTable_first_order(result) {
    const PAGE_SIZE = 20;
    var iCount = 0;
    var curPage = 1;
    var iSum = 0;
    var str = "";
    iCount = (curPage - 1) * PAGE_SIZE;

    str += "<thead>";
    str += "<tr>";
    str += "<th>订单编号</th>";
    str += "<th>下单用户</th>";
    str += "<th>食物</th>";
    str += "<th>总价</th>";
    str += "<th>用户地址</th>";
    str += "<th>下单时间</th>";
    str += "</tr>";
    str += "</thead>";
    str += "<tbody>";
    $.each(result, function (index, item) {
        if (iCount < curPage * PAGE_SIZE) {
            str += "<tr>";
            str += "<td>" + item.order_id + "</td>";
            str += "<td>" + item.user_name + "</td>";
            str += "<td>" + item.foods_name + "</td>";
            str += "<td>" + item.order_price + "</td>";
            str += "<td>" + item.order_address + "</td>";
            str += "<td>" + item.order_date + "</td>";
            str += "</tr>";
            iCount++;
        }
        iSum++;
    });
    str += "</tbody>";
    $("#list").html(str);
    str = "";
    var pages = Math.ceil(iSum / PAGE_SIZE);
    for (var i = 1; i <= pages; i++) {
        str += "<a href='#' data-id=" + i + " class='page_link btn btn-default' style='margin-left:5px'>" + i + "</a>";
    }
    $("#pages").html(str);
}
//订单的后续页面显示
function showTable_last_order(result, curPage) {
    const PAGE_SIZE = 20;
    var iCount = 0;
    var str = "";
    iCount = (curPage - 1) * PAGE_SIZE;
    str += "<thead>";
    str += "<tr>";
    str += "<th>订单编号</th>";
    str += "<th>下单用户</th>";
    str += "<th>食物</th>";
    str += "<th>总价</th>";
    str += "<th>用户地址</th>";
    str += "<th>下单时间</th>";
    str += "</tr>";
    str += "</thead>";
    str += "<tbody>";
    $.each(result, function (index, item) {
        if (index == iCount && iCount < curPage * PAGE_SIZE) {
            str += "<tr>";
            str += "<td>" + item.order_id + "</td>";
            str += "<td>" + item.user_name + "</td>";
            str += "<td>" + item.foods_name + "</td>";
            str += "<td>" + item.order_price + "</td>";
            str += "<td>" + item.order_address + "</td>";
            str += "<td>" + item.order_date + "</td>";
            str += "</tr>";
            iCount++;
        }
    });
    str += "</tbody>";
    $("#list").html(str);
    return false;
}

function checkAdress() {
    var address = document.getElementById("address").value;
    var addressMsg = document.getElementById("adressMsg");
    if (/^\s*$/.test(address)) {
        addressMsg.innerHTML = "<font color='red'>地址不能为空</font>";
    }
}