<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<input type="text" id="infotext">  <a href="javascript:;" id="subtext">发送</a>
<script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/socket-io-client/socket.io.js') ?>"></script>
<script src="/public/static/plugins/jquery/jquery-1.12.4.min.js"></script>
<script>
    var  socket = io('http://47.114.86.223:9501');
    socket.on('connection', function (data) {
        console.log(data);
        socket.emit('msg', { my: 'data' });
    });
</script>
</body>
</html>