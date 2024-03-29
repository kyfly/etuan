<!doctype html>
<html>
@include('admin.layout.head')
<body>
@include('admin.layout.nav')
<div class="container">
    <div class="adminField clearfix">
        <!--侧边栏-->
@include('admin.layout.sidebar')

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
                                <td>
                                <a href="/baoming/{{$reglist[$i]['reg_id']}}" target="_blank">
                                    {{$reglist[$i]['name']}}
                                </a>
                                </td>
                                <td>{{$reglist[$i]['start_time']}}</td>
                                <td>{{$reglist[$i]['stop_time']}}</td>
                                <td id="reg{{$reglist[$i]['reg_id']}}">
                                    <img class="editbtn" data-toggle="tooltip" data-placement="bottom"
                                         title="编辑报名表" src="/img/editor.png">
                                    <img class="deletebtn" data-toggle="tooltip" data-placement="bottom"
                                         title="删除报名表"  src="/img/close.png">
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
                            <img src="http://{{{Config::get('oss.imgHost')}}}/etuan/weixin/qrcode/baoming/{{{$reglist[$i]['reg_id']}}}.jpg">
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-top: 20px">
                        <p class="listhead">{{$reglist[$i]['name']}}</p>
                        <a href="http://{{{Config::get('oss.imgHost')}}}/etuan/weixin/qrcode/baoming/{{$reglist[$i]['reg_id']}}.jpg"
                           target="_blank" class="btn btn-warning">下载二维码</a>
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
                    @if ($i % 2)
                        <div class="clearfix"></div>
                    @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.layout.footer')

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/admin.js"></script>
<script>
    $(document).ready(function () {
        $('.btnShare').click(function () {
            $(this).next().slideToggle();
        });

        $('.editbtn').click(function () {
            var id = $(this).parent().attr('id');
            id = id.substring(3);
            window.location.href = '/admin/register/newreg?type=1&activityId=' + id;
        });

        $('.deletebtn').click(function () {
            if (window.confirm('删除后所有报名数据（包括结果）将被清空，且不可恢复，您确定要删除？'))
            {
                var id = $(this).parent().attr('id');
                id = id.substring(3);
                $.getJSON('/registration/deleteactivity',
                    { activityId : id },
                    function (data, status){
                       if (status = 'success'){
                           if (data.status = 'success')
                           {
                               alert('删除成功');
                               document.location.reload(true);
                           }
                           else
                           {
                               alert(data.content);
                           }
                       }
                    });
            }
        })
    });

    window._bd_share_config = {
        share: [

        @for ($i = 0; $i < count($reglist); $i++)
                {
                    tag: 'share_{{$i}}',
                    bdText: '微信扫码参与报名：{{$reglist[$i]['name']}} - 团团一家',
                    bdDesc: '微信扫描，参与报名，还有大礼送，快来吧！',
                    bdUrl: 'http://www.etuan.org/baoming/{{$reglist[$i]['reg_id']}}',
                    bdPic: 'http://{{{Config::get('oss.imgHost')}}}/etuan/weixin/qrcode/baoming/{{$reglist[$i]['reg_id']}}.jpg'
                } @if($i < count($reglist) - 1) , @endif
        @endfor

            ]
        };


    with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src
        = 'http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=' + ~(-new Date() / 36e5)];
</script>
</body>
</html>
