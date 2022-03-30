<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->params['system_name']??'b5YiiCMF' ?></title>
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .code {
            border-right: 2px solid;
            font-size: 26px;
            padding: 0 15px 0 15px;
            text-align: center;
        }

        .message {
            font-size: 18px;
            text-align: center;
            border: none;
        }
    </style>
</head>
<body style="background-color: #FFF">
<div class="flex-center position-ref full-height">
    <div class="code">
        <?=$code??200?>
    </div>

    <div class="message" style="padding: 10px;">
        <?=$msg??'操作成功'?>
    </div>
</div>
</body>
</html>
