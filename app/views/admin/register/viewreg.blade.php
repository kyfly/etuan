<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
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
                <a><img src="/img/brand.png" id="brandpic"></a>
            </div>
            <div class="collapse navbar-collapse" id="nav-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a><img id="avatar" class="img-circle" src="/img/avatar.jpg"> 用户</a></li>
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
                        @for ($i = 0; $i < count($reglist); $i++)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$reglist[$i]['name']}}</td>
                                <td>{{$reglist[$i]['start_time']}}</td>
                                <td>{{$reglist[$i]['stop_time']}}</td>
                                <td><img class="editbtn" src="/img/editor.png"><img class="deletebtn"
                                                                                            src="../../../img/close.png">
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
                <br>

                <h3>二维码&nbsp;&nbsp;
                    <small>微信扫码，快速报名</small>
                </h3>
                <hr>
                <div class="row" id="shareRow">
                    @for ($i = 0; $i < count($reglist); $i++)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="http://img.kyfly.net/etuan/weixin/qrcode/baoming/{{$reglist[$i]['reg_id']}}.jpg">
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-top: 20px">
                        <p class="listhead">{{$reglist[$i]['name']}}</p>
                        <a href="http://img.kyfly.net/etuan/weixin/qrcode/baoming/{{$reglist[$i]['reg_id']}}.jpg"
                           class="btn btn-warning">下载二维码</a>
                        <button class="btn btn-success btnShare"> 分享</button>
                        <div class="bdsharebuttonbox divShare" data-tag="share_{{$i}}">
                            <a class="bds_qzone" data-cmd="qzone" href="#"></a>
                            <a class="bds_tsina" data-cmd="tsina"></a>
                            <a class="bds_renren" data-cmd="renren"></a>
                            <a class="bds_sqq" data-cmd="sqq"></a>
                            <a class="bds_more" data-cmd="more"></a>
                            <a class="bds_count" data-cmd="count"></a>
                        </div>
                    </div>
                    @endfor
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
<script src="/js/admin.js"></script>
<script>
    $(document).ready(function () {
        $('.btnShare').click(function () {
            $(this).next().slideToggle();
        });
    });

    window._bd_share_config = {
        share: [

        @for ($i = 0; $i < count($reglist); $i++)
                {
                    tag: 'share_{{$i}}',
                    bdText: '微信扫码参与报名：{{$reglist[$i]['name']}} - 团团一家',
                    bdDesc: '微信扫描，参与报名，还有大礼送，快来吧！',
                    bdUrl: 'http://www.etuan.org/baoming/{{$reglist[$i]['reg_id']}}',
                    bdPic: 'http://img.kyfly.net/etuan/weixin/qrcode/baoming/{{$reglist[$i]['reg_id']}}.jpg'
                } @if($i < count($reglist) - 1) , @endif
        @endfor

            ]
        };


    with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src
        = 'http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=' + ~(-new Date() / 36e5)];
</script>
</body>
</html>
