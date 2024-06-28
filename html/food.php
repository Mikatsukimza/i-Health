<div class="btn" style="display: flex;justify-content: flex-end;align-items: center;">
    <button id="order_btn" type="submit" class="btn btn-default"
        style="background-color: #A5BACC;color: #fff;">下单</button>
</div>
<!-- Table -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>编号</th>
            <th>食品</th>
            <th style="width: 30%;">单价/元</th>
            <th style="width: 30%;">数量</th>
        </tr>
    </thead>
    <tbody id="food-list">
    </tbody>
</table>
<p id="pagess" style="text-align: center;"></p>
<?php include("template_modal.php") ?>
<script type="text/javascript">
    const PAGE_SIZE = 20;
    var iCount = 0;
    var curPage = 1;
    var iSum = 0;
    var originData = "";
    var str = "";
    iCount = (curPage - 1) * PAGE_SIZE;
    $.post("../php/getFood.php", "", function (data) {
        result = $.parseJSON(data);
        originData = result;
        str = "";
        $.each(result, function (i, item) {
            if (iCount < curPage * PAGE_SIZE) {
                str += "<tr class='content'>";
                str += "<td>" + item.food_id + "</td>";
                str += "<td name='name'>" + item.food_name + "</td>";
                str += "<td name='price'>" + item.food_price + "</td>";
                str += "<td><input style='width:8%;border:1px solid black' value='0'></input></td>"
                str += "</tr>";
                iCount++;
            }
            iSum++;
        });
        $("#food-list").html(str);
        str = "";
        if (iSum % PAGE_SIZE == 0)
            pages = iSum / PAGE_SIZE;
        else
            pages = iSum / PAGE_SIZE + 1;
        for (i = 1; i <= pages; i++) {
            str += "<a href='#' data-id=" + i + " class='page_link btn btn-default' style='margin-left:5px'>" +
                i +
                "</a>";
        }
        $("#pagess").html(str);
    });
    $('#order_btn').click(function () {
        var arr = [];
        var sum = 0;
        $('table .content').each(function () {
            var name = $(this).children('td').eq(1).html();
            var price = $(this).children('td').eq(2).html();
            var num = $(this).children('td').eq(3).find("input").val();
            total = num;
            if (parseInt(num) > 0) {
                var str = name + num + " ";
                sum += parseFloat(price) * parseInt(num);
                arr.push(str);
            }
        });
        if (sum == 0)
            alert("请先正确输入食品数量后再下单");
        else
            $('#orderModal').modal();
        $("#foodName").val(arr);
        $("#price").val(sum);
    });
</script>