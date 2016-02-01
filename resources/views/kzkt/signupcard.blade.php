<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>完成报名</title>

    <link rel="stylesheet" href="/css/weui.min.css">
    <link rel="stylesheet" href="/css/volunteer.css">
    <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>

    <script type="application/javascript">
        var request = function (paras) {
            var url = location.href;
            var paraString = url.substring(url.indexOf("?") + 1, url.length).split("&");
            var paraObj = {}
            for (i = 0; j = paraString[i]; i++) {
                paraObj[j.substring(0, j.indexOf("=")).
                        toLowerCase()] = j
                        .substring(j.indexOf("=") + 1, j.length);

            }
            var returnValue = paraObj[paras.toLowerCase()];
            if (typeof(returnValue) == "undefined") {
                return "";
            } else {
                return returnValue;
            }
        }

        var getData = function (id){
            var requestUrl = '/activity/kzkt/findSingleRegister';
            $.ajax({
                type : "get",
                data: {
                    id: id
                },
                dataType : "json",
                url : requestUrl,
                success: function (json) {
                    if(json.result == '1') {
//                        $("#name1").val(json.data.name);
//                        $("#name2").val(json.data.name);
//                        $("#phone").val(json.data.phone);
//                        $("#pwd").val(json.data.password);
                        document.getElementById('name1').innerText = json.data.name;
                        document.getElementById('name2').innerText = json.data.name;
                        document.getElementById('phone').innerText = json.data.phone;
                        document.getElementById('pwd').innerText = json.data.password;
                        document.getElementById('class_type').innerText = json.className;
                    }
                },
                error: function (xhr, status, errorThrown) {
                    alert("Sorry, there was a problem!");
                    console.log("Error: " + errorThrown);
                    console.log("Status: " + status);
                    console.dir(xhr);
                },
                complete: function (xhr, status) {
//                    alert("The request is complete!");
                }
            });
        }

        $(document).ready(function(){
            var id = request("id");
            if(id != null) {
                getData(id);
            }
        });
    </script>
</head>
<body class="body-gray" ontouchstart>
<div class="container">

    <div class="learning_card">
        <div class="weui_cell ">
            <div class="weui_cell_bd">
                <p>听课证</p>
                <img src="/image/kzkt/class.png" alt="">
            </div>
        </div>
        <div class="weui_cell ">
            <div class="weui_cell_bd">
                <p><label id="name1"></label> 医生，欢迎你参加2016空中课堂-<label id="class_type"></label>，为方便接收课前通知和课后学习资料，请关注微信公众号。</p>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd qrcode">
                <img class="img_100" src="/image/kzkt/2dcode.png" alt="">
            </div>
            <div class="weui_cell_bd">
                <p>长按识别二维码</p>
                <p>学员：<label id="name2"></label></p>
                <p>账号：<label id="phone"></label></p>
                <p>登录密码：<label id="pwd"></label></p>
                <p>班级邀请码：12345678</p>
            </div>
        </div>
        <img class="img_100" src="/image/kzkt/introduce.png" alt="">
    </div>
    <div class="click_button">
        <img class="img_100" src="/image/kzkt/forward.png" alt="" id="onMenuShareAppMessage">
    </div>
</div>

<button class="weui_btn" id="checkJsApi">checkJsApi</button>

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo $js->config(array('checkJsApi','onMenuShareAppMessage'), true, true) ?>);


    wx.ready(function () {
        // 1 判断当前版本是否支持指定 JS 接口，支持批量判断
        document.querySelector('#checkJsApi').onclick = function () {
            wx.checkJsApi({
                jsApiList: [
                    'onMenuShareAppMessage',
                ],
                success: function (res) {
                    alert(JSON.stringify(res));
                }
            });
        };

        document.querySelector('#onMenuShareAppMessage').onclick = function () {
            var id = request("id");
            wx.onMenuShareAppMessage({
                title: '空中课堂报名',
                desc: '学员报名账户信息',
                link: 'http://volunteers.mime.org.cn/activity/kzkt/viewCard?id='+id,
                imgUrl: 'http://img6.cache.netease.com/photo/0008/2016-01-31/BEMQDIV02FKJ0008.jpg',
                trigger: function (res) {
                    alert('用户点击发送给朋友');
                },
                success: function (res) {
                    alert('已分享');
                },
                cancel: function (res) {
                    alert('已取消');
                },
                fail: function (res) {
                    alert("fail:" + JSON.stringify(res));
                }
            });
            alert('已注册获取“发送给朋友”状态事件');
        };

    });

    wx.error(function (res) {
        alert("error:" + res.errMsg);
    });
</script>
</body>
</html>