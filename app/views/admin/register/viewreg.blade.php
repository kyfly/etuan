<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/admin.css" rel="stylesheet">
    <title>“团团一家”管理后台</title>
</head>
<body>
<nav id="nav" class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
                    <span class="sr-only">导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a><img src="../../../img/brand.png" id="brandpic"></a>
            </div>
            <div class="collapse navbar-collapse" id="nav-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a><img id="avatar" class="img-circle" src="../../../img/avatar.jpg"> 用户</a></li>
                    <li><a><span class="glyphicon glyphicon-off"></span>退出</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <div class="adminField clearfix">
    <!--侧边栏-->
    <div id="sidebar" class="col-lg-3 col-md-3"></div>

    <div id="main" class="col-lg-9 col-md-9">
        <div class="tab-content">
            <!--查看报名-->
            <h3>查看报名</h3>
            <hr>
            <div class="tab-pane active in" id="reglist">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>名称</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>编辑/删除</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>杭州电子科技大学学生会2014招新报名</td>
                        <td>2014/09/01 12:00</td>
                        <td>2014/09/05 12:00</td>
                        <td><img class="editbtn" src="../../../img/editor.png"><img class="deletebtn"
                                                                                    src="../../../img/close.png"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>杭州电子科技大学学生会2014招新报名</td>
                        <td>2014/09/01 12:00</td>
                        <td>2014/09/05 12:00</td>
                        <td><img class="editbtn" src="../../../img/editor.png"><img class="deletebtn"
                                                                                    src="../../../img/close.png"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>杭州电子科技大学学生会2014招新报名</td>
                        <td>2014/09/01 12:00</td>
                        <td>2014/09/05 12:00</td>
                        <td><img class="editbtn" src="../../../img/editor.png"><img class="deletebtn"
                                                                                    src="../../../img/close.png"></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>

            <h3>二维码&nbsp;&nbsp;
                <small>微信扫码，快速报名</small>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="../../../img/qrcode_etuan_344.jpg">
                    </div>
                </div>
                <div class="col-md-3" style="margin-top: 20px">
                    <p class="listhead">杭州电子科技大学学生会2014招新报名</p>
                    <button class="btn btn-warning">下载二维码</button>
                    <button class="btn btn-success" id="btnShare"> 分享</button>
                    <div class="bdsharebuttonbox" id="divShare" data-tag="share_1">
                        <a class="bds_qzone" data-cmd="qzone" href="#"></a>
                        <a class="bds_tsina" data-cmd="tsina"></a>
                        <a class="bds_renren" data-cmd="renren"></a>
                        <a class="bds_sqq" data-cmd="sqq"></a>
                        <a class="bds_more" data-cmd="more"></a>
                        <a class="bds_count" data-cmd="count"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<footer id="footer" class="panel-footer">
    <p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
</footer>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="../../../js/admin.js"></script>
<script>
    $(document).ready(function () {
        $('#btnShare').click(function () {
            $('#divShare').slideToggle();
        })
    });
    window._bd_share_config = {
        share : [{
            tag: 'share_1',
            bdText: '分享的内容',
            bdDesc: '分享的摘要',
            bdUrl: 'http://i.kyfly.net',
            bdPic: 'http://www.etuan.local/img/qrcode_etuan_344.jpg'
        }]
    };
    with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=' + ~(-new Date() / 36e5)];
</script>
</body>
</html>
