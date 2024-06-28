//日历插件的起始时间,截止时间的格式规范
Calendar.setup({
    inputField : "J_time_start",
    ifFormat   : "%Y-%m-%d",
    showsTime  : false,
    timeFormat : "24"
});
Calendar.setup({
    inputField : "J_time_end",
    ifFormat   : "%Y-%m-%d",
    showsTime  : false,
    timeFormat : "24"
});


//定义Edit类
class Edit {
    //绑定属性
    bindElem() {
        var toolbar = document.getElementById("toolbar");
        var tmp = toolbar.querySelectorAll('input,select');
        $.each(tmp,function (index,item) {
            //修改字体大小
            if(item.tagName.toLowerCase()=='select'){
                item.onchange=function () {
                    document.execCommand(this.name,true,this.value);
                }
            //下划线,粗体等样式
            }else if(item.tagName.toLowerCase()=='input') {
                item.onclick=function () {
                    //图片特殊处理
                    if(this.name!='insertImage')
                        document.execCommand(this.name,true,this.value);
                }
            }
        })
    }

    //构造函数
    constructor() {
        this.bindElem();
    }
}

//上传的是图片还是附件
function imageOrEnclosure() {
    //因为文件提交不使用submit,所以实例化文件对象
    var tmpFile = new FormData($("#FILE")[0]);
    var wantUploadLink;
    //debug
    $.ajaxSettings.async = false;
    $.ajax({
        type: 'post',//post形式
        url: "../php/upload_file.php",//请求的url
        data: tmpFile,//传递参数
        cache: false,
        processData: false,
        contentType: false,
    }).success(function (data) {//成功的回调函数
        //debug
        wantUploadLink = $.parseJSON(data);
    }).error(function () {//失败的回调函数
        alert("上传失败");
    });
    $.ajaxSettings.async = true;
    return wantUploadLink;
}

//自调用函数,页面启动就会调用
(function () {
    new Edit();
})();


//限制插入图片的高宽
$("#notice_img_insert").click(function () {
    var wantUploadLink=imageOrEnclosure();
    //debug
    if (wantUploadLink.type == 'picture') {//图片
        var SIZE = prompt("请输入图片的高和宽", "100,100");//限制图片大小
        if (SIZE != null && SIZE != "") {
            var tmpSIZE = SIZE.split(',');
            //插入图片的HTML标签元素
            document.execCommand('insertHTML', false, `<img src=${wantUploadLink.link} style='width:${tmpSIZE[0]}px;height:${tmpSIZE[1]}px'>`)
        }
    } else {//附件
        alert("请点击上传附件");
    }
});

//上传附件
var FILENAME;
$("#FILE").change(function () {
    FILENAME=$("#FILE")[0][0].files[0].name;
});
$("#notice_enclosure_insert").click(function () {
    var wantUploadLink=imageOrEnclosure();
    var tmpFile = new FormData($("#FILE")[0]);
    if (wantUploadLink.type == 'picture') {//图片
        alert("请点击插入图片");
    } else {//附件,注意是download形式,才可以下载
        document.execCommand('insertHTML', false, `<a style="color: red;" href=${wantUploadLink.link} download=${FILENAME}>${FILENAME}</a>`)
    }
});

//文字颜色确定
document.getElementById('changeColor').onchange = function(){
    this.click();
    this.style.background=this.value;
};

var flag=0,wantModifyId=0;//标记发布或修改
//发布或修改公告
$("#publish_or_modify").click(function () {
    var edit = document.getElementById('edit');
    var editDiv = $("#edit").children("div");
    if (editDiv[0].innerText == "" && editDiv[1].innerText == "") {
        alert("标题和正文不能为空");
        return;
    }
    $.post("../php/insert_notice.php", {
        editTitle: editDiv[0].innerText,
        editText: editDiv[1].innerHTML,
        insert_update: flag,//代码重用,插入或更新
        ID: wantModifyId//如果更新,还需知道ID
    }, function () {
        alert("公布成功！");
        window.location.reload();//公布公告后重加载页面
    })
});

//发布公告按钮
$("#notice_to_publish").click(function () {
    flag=1;//添加
    $("#publish_or_modify").text("发布");

});

//修改公告按钮
$("#notice_to_modify").click(function () {
    flag = 2;//修改
    $("#publish_or_modify").text("修改");
    var arr_select = [];
    $("input[name='announcement']:checked").each(function (index, item) {
        arr_select.push(item.parentNode.nextSibling.textContent);
    });
    if (arr_select.length >= 2 || arr_select.length == 0) {
        alert("修改只能选择一个");
        window.location.reload();
        return;
    }
    $.ajaxSettings.async = false;
    $.post("../php/modify_notice.php", {'arr_select': arr_select}, function (data) {
        var result = $.parseJSON(data);
        var editDiv = $("#edit").children("div");
        editDiv[0].innerText = result[0].notice_title;
        editDiv[1].innerHTML = result[0].notice_text;
        wantModifyId = result[0].notice_id;
    });
    $.ajaxSettings.async = true;
});

//点击公告标题
function jumpToText(rs) {
    var readID = rs.parentNode.previousSibling.firstChild.textContent;//希望阅读的通知的编号
    rs.href = "../html/aboutAnnouncement.php?readID=" + readID;//跳转到公告正文
}
    



