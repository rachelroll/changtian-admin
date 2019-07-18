<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script language="javascript"
            src="https://jkwedu-new.oss-cn-beijing.aliyuncs.com/public-cdn/jquery/jquery-1.4.4.min.js"></script>
    <script language="javascript"
            src="https://jkwedu-new.oss-cn-beijing.aliyuncs.com/public-cdn/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script language="javascript"
            src="https://jkwedu-new.oss-cn-beijing.aliyuncs.com/public-cdn/jquery/jquery.jqprint-0.3.js"></script>
    <script language="javascript">
        function a() {
            $("#ddd").jqprint();
        }
    </script>
    <title>打印</title>
    <style>
        .center {
            text-align: center;
        }

        .font-24 {
            font-size: 24px;
        }

        .box {
            width: 8cm;
        }

        .border {
            border: 1px solid red;
            padding: 2px;
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }

        /* clear float */
        .clear:after {
            display: block;
            clear: both;
            content: "";
            visibility: hidden;
            height: 0
        }

        .clear {
            zoom: 1

        }

        /* end clear float */
    </style>
</head>
<body>
<div class="box">
    <div id="ddd">
        <h4 class="center">产品追溯标签</h4>
        <div class="center font-24">{{ $orderItem->name }}</div>
        <div class="center">
            <img width="100" src="{{ (new chillerlan\QRCode\QRCode)->render($url) }}" alt=""/>
        </div>
        <div class="center">请使用微信扫码，体验可追溯产品</div>
        <div class="center">供应商:宁夏昌田农业发展有限公司</div>
        <div class="center">热线:400-666-8683</div>
    </div>
</div>
<br>
<input type="button" onclick=" a()" value="打印"/>

</body>
</html>
