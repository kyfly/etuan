<!DOCTYPE html>
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
        <div class="alert alert-dismissible" id="topAlert" role="alert">
            <button type="button" class="close" id="topAlertClose">
                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
            </button>
            <span id="topAlertStr"></span>
        </div>
        <h2>微信自动回复</h2>
        <hr>

        <div>
            <button type="button" class="btn btn-primary btn-lg" style="letter-spacing: 2px"
                    data-toggle="modal" data-target="#addrulebox" id="btnAddRule">+添加规则
            </button>
            &nbsp;&nbsp;
            <button type="button" class="btn btn-warning btn-lg" id="btnOneKeyReg">一键添加报名表</button>
        </div>


        <div class="modal fade" id="addrulebox">
            <div class="modal-dialog">
                <div class="modal-content margintop">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title">添加/修改规则</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="txtKeywords">关键词</label>

                                <div class="col-sm-8">
                                    <textarea class="form-control" id="txtKeywords"
                                              placeholder="请输入关键词"></textarea>

                                    <p class="help-block">输入回车可添加多个关键词，每个关键词少于30个字符。</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="response">回复</label>

                                <div class="msg_sender margintop col-md-8" id="response" style="margin-left: 2%;">
                                    <div class="msg_tab">
                                        <ul class="tab_navs list-unstyled">
                                            <li class="tab_nav">
                                                <a id="addText" class="colorBlack">&nbsp;
                                                    <span data-toggle="tooltip" data-placement="bottom" title="文字"
                                                          class="glyphicon glyphicon-pencil"></span>
                                                </a>
                                            </li>
                                            <li class="tab_nav">
                                                <a id="addReg">&nbsp;<span
                                                        data-toggle="tooltip" data-placement="bottom" title="报名"
                                                        class="glyphicon glyphicon-user"></span></a>
                                            </li>
                                            <li class="tab_nav">
                                                <a id="addNews">&nbsp;<span
                                                        data-toggle="tooltip" data-placement="bottom" title="图文"
                                                        class="glyphicon glyphicon-list-alt"></span></a>
                                            </li>
                                        </ul>

                                        <div class="tab_panel">
                                            <div class="tab_content" style="display: block;">
                                                <div class="emotion_editor">
                                                    <div class="edit_area js_editorArea" contenteditable="true"
                                                         style="overflow-y: auto; overflow-x: hidden;"
                                                         id="msgEditor">请在此处输入文字</div>
                                                    <div class="editor_toolbar">
                                                        <p class="editor_tip js_editorTip">文字回复不超过600字</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="setMsg">设置为</label>

                                <div class="col-sm-8" id="setMsg">
                                    <input type="checkbox" id="setAsWelcome">
                                    <label class="control-label" for="setAsWelcome">被添加自动回复</label>

                                    <p class="help-block">用户关注微信公众号后，将收到该消息</p>
                                    <input type="checkbox" id="setAsDefault">
                                    <label class="control-label" for="setAsDefault">默认消息自动回复</label>

                                    <p class="help-block">用户发送已定义的关键词以外的内容，将收到该消息</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnSave" type="button" class="btn btn-primary">保存</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bs-callout bs-callout-warning col-md-12" id="ruleDivTpl">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 text-right">
                        <h5>关键词</h5>
                    </div>
                    <div class="col-md-7">
                        <h5 id="ruleKeyTpl"></h5>
                    </div>
                    <div class="col-md-3 text-right">
                        <a class="colorGray btnEditReply" data-toggle="modal" data-target="#addrulebox"
                           rel="tooltip" data-placement="bottom" title="编辑">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>&nbsp;&nbsp;
                        <a class="colorGray btnDelReply" data-toggle="modal" data-target="#delMsgModal"
                           rel="tooltip" data-placement="bottom" title="删除">
                            <span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 text-right"><h5>回复</h5></div>
                    <div class="col-md-10" id="ruleContentTpl">
                        <h5></h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- 删除确认-->
        <div class="modal fade" id="delMsgModal" tabindex="-1" role="dialog" aria-labelledby="delMsgModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="delMsgModalLabel">确认删除？</h4>
                    </div>
                    <div class="modal-body">
                        <p>自动回复删除后，用户将不能收到该消息，确认删除？</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btnConfirmDel">确定</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

</div>

<footer id="footer" class="panel-footer margintop">
    <p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
</footer>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="../../../js/admin.js"></script>
<script src="../../../js/taffy-min.js"></script>
<script src="../../../js/admin/weixin/autoreply.js"></script>
</body>
</html>