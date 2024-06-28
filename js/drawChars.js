var dom_radio = document.getElementById("chars_radio"); //雷达图
var dom_line = document.getElementById("chars_line"); //折线图
var myChart_radio = echarts.init(dom_radio);
var myChart_line = echarts.init(dom_line);
var app = {};
var rs;
$.ajaxSettings.async = false; //关闭异步
//今日个人信息和健康数据的渲染
$.post("../php/getUserInformation.php", "", function (data) {
    var rs = $.parseJSON(data);
    if (rs.length == 0) {
        alert("请完成今日打卡才可查看数据!");
        window.location = "../html/homePage.php";
        return;
    }
    var str = "";
    str += "<tr><td>姓名</td><td>" + rs[0].user_name + "</td></tr>";
    str += "<tr><td>心率(次/分)</td><td>" + rs[0].heart_rate + "</td></tr>";
    str += "<tr><td>血压(mmHg)</td><td>" + rs[0].blood_presure + "</td></tr>";
    str += "<tr><td>体温(℃)</td><td>" + rs[0].temperature + "</td></tr>";
    str += "<tr><td>身高(m)</td><td>" + rs[0].height + "</td></tr>";
    str += "<tr><td>体重(kg)</td><td>" + rs[0].weight + "</td></tr>";
    str += "<tr><td>电话</td><td>" + rs[0].telephone + "</td></tr>";
    str += "<tr><td>电子邮箱</td><td>" + rs[0].email + "</td></tr>";
    if (rs[0].user_role == 1)
        str += "<tr><td>管理员</td><td>是</td></tr>";
    else
        str += "<tr><td>管理员</td><td>否</td></tr>";
    $("#user_information").html(str);
});
$.post("../php/getHealthData.php", "", function (data) {
    var systolic = [],
        diastole = [],
        time = [],
        heart_rate = [],
        temperature = [],
        height = [],
        weight = []; //收缩,舒张
    data = $.parseJSON(data);
    //获取个人健康数据以及个人信息
    $.each(data, function (index, item) {
        systolic.push(data[index].blood_presure.substring(0, data[index].blood_presure.indexOf('/')));
        diastole.push(data[index].blood_presure.substring(data[index].blood_presure.indexOf('/') + 1, data[index].blood_presure.length));
        time.push(data[index].date);
        heart_rate.push(data[index].heart_rate);
        temperature.push(data[index].temperature);
        height.push(data[index].height * 100);
        weight.push(data[index].weight * 2);
    });
    //实例化成对象
    rs = {
        systolic: systolic,
        diastole: diastole,
        time: time,
        heart_rate: heart_rate,
        temperature: temperature,
        height: height,
        weight: weight
    };
});
$.post("../php/getData.php", "", function (data) {
    var item = $.parseJSON(data);
    var saves = new Object();
    //心率
    if (item.heart_rate < 60) {
        saves.heart_rate = 1;
    } else if (item.heart_rate >= 60 && item.heart_rate <= 100) {
        saves.heart_rate = 2;
    } else if (item.heart_rate > 100 && item.heart_rate <= 135) {
        saves.heart_rate = 3;
    } else if (item.heart_rate > 135 && item.heart_rate <= 155) {
        saves.heart_rate = 4;
    } else if (item.heart_rate > 155) {
        saves.heart_rate = 5;
    }
    //收缩压
    var systolic = item.blood_presure.substring(0, item.blood_presure.indexOf('/'));
    //舒张压
    var diastole = item.blood_presure.substring(item.blood_presure.indexOf('/') + 1, item.blood_presure
        .length);
    if (systolic >= 100 && systolic < 120 && diastole >= 60 && diastole < 80) { //正常血压
        saves.blood_pressure = 1;
    } else if (systolic >= 120 && systolic <= 139 && diastole >= 80 && diastole <= 90) { //正常高压
        saves.blood_pressure = 2;
    } else if (systolic > 139 && diastole > 90) { //高血压
        saves.blood_pressure = 3;
    } else if (systolic > 139 && diastole < 90) { //单纯收缩期高血压
        saves.blood_pressure = 4;
    } else { //低血压
        saves.blood_pressure = 5;
    }
    //BMI
    var bmi = item.weight / (item.height * item.height);
    if (bmi < 18.5) {
        saves.bmi = 1;
    } else if (bmi >= 18.5 && bmi < 23.9) {
        saves.bmi = 2;
    } else if (bmi >= 23.9 && bmi < 28) {
        saves.bmi = 3;
    } else if (bmi >= 28) {
        saves.bmi = 4;
    }
    //体温
    if (item.temperature < 36.3) {
        saves.temp = 1;
    } else if (item.temperature >= 36.3 && item.temperature <= 37.2) {
        saves.temp = 2;
    } else if (item.temperature > 37.2 && item.temperature <= 39.1) {
        saves.temp = 3;
    } else if (item.temperature > 39.1) {
        saves.temp = 4;
    }
    res = {
        heart: saves.heart_rate,
        temp: saves.temp,
        bmi: saves.bmi,
        blood: saves.blood_pressure
    };
});
$.ajaxSettings.async = true; //开启异步
//雷达图样式
var option_radio = {
    color: {
        type: 'radial',
        colorStops: [{
            offset: 0,
            color: 'white' // 0% 处的颜色
        }, {
            offset: 1,
            color: 'red' // 100% 处的颜色
        }],
    },
    title: {
        text: '今日健康数据等级'
    },
    tooltip: {},
    radar: {
        name: {
            textStyle: {
                color: '#fff',
                backgroundColor: '#999',
                borderRadius: 3,
                padding: [3, 5]
            }
        },
        indicator: [{
                name: '心率',
                max: 5
            },
            {
                name: '血压',
                max: 5
            },
            {
                name: '体温',
                max: 5
            },
            {
                name: 'BMI',
                max: 5
            }
        ]
    },
    series: [{
        type: 'radar',
        data: [{
            value: [res.heart, res.blood, res.bmi, res.temp],
            name: '健康等级'
        }]
    }]
};
//血压折线图样式
var option_line_1 = {
    title: {
        text: '过去一周血压变化',
        subtext: '数据来源于运动智能手表'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data: ['收缩压', '舒张压']
    },
    toolbox: {
        show: true,
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            dataView: {
                readOnly: false
            },
            magicType: {
                type: ['line', 'bar']
            },
            restore: {},
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: rs.time
    },
    yAxis: {
        type: 'value',
        scale: true,
        axisLabel: {
            formatter: '{value} mmHg'
        }
    },
    series: [{
            name: '收缩压',
            type: 'line',
            data: rs.systolic,
            markPoint: {
                data: [{
                        type: 'max',
                        name: '最大值'
                    },
                    {
                        type: 'min',
                        name: '最小值'
                    }
                ]
            },
            markLine: {
                data: [{
                        yAxis: 140,
                        x: '10%',
                        symbolSize: 0.1,
                        label: {
                            fontFamily: 'DIN-Medium',
                            position: 'right',
                            formatter: '收缩上限'
                        }
                    },
                    {
                        yAxis: 90,
                        x: '10%',
                        symbolSize: 0.1,
                        label: {
                            fontFamily: 'DIN-Medium',
                            position: 'right',
                            formatter: '舒张(收缩)压正常上(下)限'
                        }
                    }
                ]
            }
        },
        {
            name: '舒张压',
            type: 'line',
            data: rs.diastole,
            markPoint: {
                data: [{
                        type: 'max',
                        name: '最大值'
                    },
                    {
                        type: 'min',
                        name: '最小值'
                    }
                ]
            },
            markLine: {
                data: [{
                        yAxis: 60,
                        x: '10%',
                        symbolSize: 0.1,
                        label: {
                            fontFamily: 'DIN-Medium',
                            position: 'right',
                            formatter: '舒张下限'
                        }
                    },
                    {
                        yAxis: 90,
                        x: '10%',
                        symbolSize: 0.1,
                        label: {
                            fontFamily: 'DIN-Medium',
                            position: 'right',
                            formatter: '舒张(收缩)压正常上(下)限'
                        }
                    }
                ]
            }
        }
    ]
};
//体温折线图样式
var option_line_2 = {
    title: {
        text: '过去一周体温变化',
        subtext: '数据来源于运动智能手表'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data: ['体温']
    },
    toolbox: {
        show: true,
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            dataView: {
                readOnly: false
            },
            magicType: {
                type: ['line', 'bar']
            },
            restore: {},
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: rs.time
    },
    yAxis: {
        type: 'value',
        scale: true,
        axisLabel: {
            formatter: '{value} ℃'
        }
    },
    series: [{
        name: '体温',
        type: 'line',
        data: rs.temperature,
        markPoint: {
            data: [{
                    type: 'max',
                    name: '最大值'
                },
                {
                    type: 'min',
                    name: '最小值'
                }
            ]
        },
        markLine: {
            data: [{
                    yAxis: 37.2,
                    x: '10%',
                    symbolSize: 0.1,
                    label: {
                        fontFamily: 'DIN-Medium',
                        position: 'right',
                        formatter: '正常体温上限'
                    }
                },
                {
                    yAxis: 36.3,
                    x: '10%',
                    symbolSize: 0.1,
                    label: {
                        fontFamily: 'DIN-Medium',
                        position: 'right',
                        formatter: '正常体温下限'
                    }
                }
            ]
        }
    }]
};
//心率折线图样式
var option_line_3 = {
    title: {
        text: '过去一周心率变化',
        subtext: '数据来源于运动智能手表'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data: ['心率']
    },
    toolbox: {
        show: true,
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            dataView: {
                readOnly: false
            },
            magicType: {
                type: ['line', 'bar']
            },
            restore: {},
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: rs.time
    },
    yAxis: {
        type: 'value',
        scale: true,
        axisLabel: {
            formatter: '{value} 次/分'
        }
    },
    series: [{
        name: '心率',
        type: 'line',
        data: rs.heart_rate,
        markPoint: {
            data: [{
                    type: 'max',
                    name: '最大值'
                },
                {
                    type: 'min',
                    name: '最小值'
                }
            ]
        },
        markLine: {
            data: [{
                    yAxis: 100,
                    x: '10%',
                    symbolSize: 0.1,
                    label: {
                        fontFamily: 'DIN-Medium',
                        position: 'right',
                        formatter: '正常心率上限'
                    }
                },
                {
                    yAxis: 60,
                    x: '10%',
                    symbolSize: 0.1,
                    label: {
                        fontFamily: 'DIN-Medium',
                        position: 'right',
                        formatter: '正常心率下限'
                    }
                }
            ]
        }
    }]
};
//体重折线图样式
var option_line_4 = {
    title: {
        text: '过去一周体重变化',
        subtext: '数据来源于运动智能手表'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data: ['体重']
    },
    toolbox: {
        show: true,
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            dataView: {
                readOnly: false
            },
            magicType: {
                type: ['line', 'bar']
            },
            restore: {},
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: rs.time
    },
    yAxis: {
        type: 'value',
        scale: true,
        axisLabel: {
            formatter: '{value} 斤'
        }
    },
    series: [{
        name: '体重',
        type: 'line',
        data: rs.weight,
        markPoint: {
            data: [{
                    type: 'max',
                    name: '最大值'
                },
                {
                    type: 'min',
                    name: '最小值'
                }
            ]
        }
    }]
};
//身高折线图样式
var option_line_5 = {
    title: {
        text: '过去一周身高变化',
        subtext: '数据来源于运动智能手表'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data: ['身高']
    },
    toolbox: {
        show: true,
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            dataView: {
                readOnly: false
            },
            magicType: {
                type: ['line', 'bar']
            },
            restore: {},
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: rs.time
    },
    yAxis: {
        type: 'value',
        scale: true,
        axisLabel: {
            formatter: '{value} 厘米'
        }
    },
    series: [{
        name: '身高',
        type: 'line',
        data: rs.weight,
        markPoint: {
            data: [{
                    type: 'max',
                    name: '最大值'
                },
                {
                    type: 'min',
                    name: '最小值'
                }
            ]
        }
    }]
};


//初始化
if (option_radio && typeof option_radio === "object") {
    myChart_radio.setOption(option_radio, true);
}
if (option_line_1 && typeof option_line_1 === "object") {
    myChart_line.setOption(option_line_1, true);
}

//选择折线图
$(".item_chars").click(function () {
    var str = this.text + "<span class='caret'></span>";
    $("#whichChars").html(str);
    if (this.text == "血压")
        myChart_line.setOption(option_line_1, true);
    else if (this.text == "体温")
        myChart_line.setOption(option_line_2, true);
    else if (this.text == "心率")
        myChart_line.setOption(option_line_3, true);
    else if (this.text == "体重")
        myChart_line.setOption(option_line_4, true);
    else if (this.text == "身高")
        myChart_line.setOption(option_line_5, true);
});