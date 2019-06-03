<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script language="javascript" src="https://jkwedu-new.oss-cn-beijing.aliyuncs.com/public-cdn/jquery/jquery-1.4.4.min.js"></script>
    <script language="javascript" src="https://jkwedu-new.oss-cn-beijing.aliyuncs.com/public-cdn/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script language="javascript" src="https://jkwedu-new.oss-cn-beijing.aliyuncs.com/public-cdn/jquery/jquery.jqprint-0.3.js"></script>
    <script language="javascript">
        function  a(){
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
<div class="border box">
    <div id="ddd">
        <div class="center font-24">{{ $orderItem->name }}</div>
        <div>保鲜日期:2017-12-11</div>
        <div>保鲜日期:2017-12-11</div>
        <div class="box">
            <div class="left">溯源地:山东青岛</div>
            <div class="right font-24">净含量:8KG</div>
            <div class="clear"></div>
        </div>

        <div>供应商:宁夏昌田农业发展有限公司</div>
        <div>热线:400-666-8683</div>
    </div>
</div>
<br>
<input type="button" onclick=" a()" value="打印"/>

</body>
</html>
