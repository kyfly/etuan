<?php $orgInfo = Organization::where('org_uid', Auth::user()->org_uid)->first() ?>
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
                <a href="/admin/home"><img src="http://img.kyfly.net/common/logo/etuan-logo-word.png@30h.png" id="brandpic"></a>
            </div>
            <div class="collapse navbar-collapse" id="nav-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/user/set-organization"><img id="avatar"
                                                              src="{{$orgInfo->logo_url}}@20w_20h.png">
                            {{$orgInfo->name}}
                        </a>
                    </li>
                    <li><a href="/auth/logout"><span class="glyphicon glyphicon-off"></span>&nbsp;退出</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>