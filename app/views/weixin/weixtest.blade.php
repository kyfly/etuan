<!DOCTYPE html>
<html>
	<head>
		<title>微信Js API Demo</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0;">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<style type="text/css">
			button {
				margin: 10px;
			}
		</style>
		<script src="<?php echo URL::to('js/WeixinApi.js');?>"></script>
	</head>
	<body>
		<p>这是一个测试页面！请直接分享到微信好友、朋友圈、腾讯微博看效果吧！</p>
		<p>如果你是扫一扫过来的，可以复制连接，然后发给任何一个微信好友，再点击连接进入测试</p>
		<p>
		    <button id="optionMenu">WeixinApi.hideOptionMenu</button>
		</p>
		<p>
		    <button id="toolbar">WeixinApi.hideToolbar</button>
		</p>
		<p>
		    <button id="networkType">WeixinApi.getNetworkType</button>
		</p>
		<p>
		    <button id="imagePreview">WeixinApi.imagePreview</button>
		</p>
		<p>
		    <button id="closeWindow">WeixinApi.closeWindow</button>
		</p>

		<script type="text/javascript">
	//Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Mobile/10B329 MicroMessenger/5.0.1
//Mozilla/5.0 (Linux; U; Android 2.3.6; zh-cn; GT-S5660 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1 MicroMessenger/4.5.255
		    // 给按钮增加click事件：请不要太纠结这个写法，demo而已
		    var addEvent = function(elId,listener){
		        document.getElementById(elId)
		                .addEventListener('click',function(e){
		                    if(!window.WeixinApi || !window.WeixinJSBridge) {
		                        alert('请确认您是在微信内置浏览器中打开的，并且WeixinApi.js已正确引用');
		                        e.preventDefault();
		                        return false;
		                    }
		                    listener(this,e);
		                },false);
		    };

		    // 两个Flag
		    var optionMenuOn = true;
		    var toolbarOn = true;

		    // optionMenu的控制
		    addEvent('optionMenu',function(el,e){
		        if(optionMenuOn) {
		            el.innerHTML = "WeixinApi.showOptionMenu";
		            WeixinApi.hideOptionMenu();
		        }else{
		            el.innerHTML = "WeixinApi.hideOptionMenu";
		            WeixinApi.showOptionMenu();
		        }
		        optionMenuOn = !optionMenuOn;
		    });

		    // toolbar的控制
		    addEvent('toolbar',function(el,e){
		        if(toolbarOn) {
		            el.textContent = "WeixinApi.showToolbar";
		            WeixinApi.hideToolbar();
		        }else{
		            el.textContent = "WeixinApi.hideToolbar";
		            WeixinApi.showToolbar();
		        }
		        toolbarOn = !toolbarOn;
		    });

		    // 获取网络类型
		    addEvent('networkType',function(el,e){
		        WeixinApi.getNetworkType(function(network) {
		            alert("当前网络类型：" + network);
		        });
		    });


		    // 调起客户端的图片播放组件
		    addEvent('imagePreview',function(el,e){
		        location.href = "http://www.baidufe.com/wximage?tag=%E7%BE%8E%E5%A5%B3";
		    });

		    // 关闭窗口
		    addEvent('closeWindow',function(el,e){
		        WeixinApi.closeWindow();
		    });

		    // 需要分享的内容，请放到ready里
		    WeixinApi.ready(function(Api) {

		        // 微信分享的数据
		        var wxData = {
		            "appId": "", // 服务号可以填写appId
		            "imgUrl" : 'http://www.baidufe.com/fe/blog/static/img/weixin-qrcode-2.jpg',
		            "link" : 'http://www.baidufe.com',
		            "desc" : '大家好，我是Alien，Web前端&Android客户端码农，喜欢技术上的瞎倒腾！欢迎多交流',
		            "title" : "大家好，我是赵先烈"
		        };
		        

		        // 分享的回调
		        var wxCallbacks = {
		            // 分享操作开始之前
		            ready : function() {
		                // 你可以在这里对分享的数据进行重组
		                alert("准备分享");
		            },
		            // 分享被用户自动取消
		            cancel : function(resp) {
		                // 你可以在你的页面上给用户一个小Tip，为什么要取消呢？
		                alert("分享被取消");
		            },
		            // 分享失败了
		            fail : function(resp) {
		                // 分享失败了，是不是可以告诉用户：不要紧，可能是网络问题，一会儿再试试？
		                alert("分享失败");
		            },
		            // 分享成功
		            confirm : function(resp) {
		                // 分享成功了，我们是不是可以做一些分享统计呢？
		                //window.location.href='http://192.168.1.128:8080/wwyj/test.html';
		                alert("分享成功");
		            },
		            // 整个分享过程结束
		            all : function(resp) {
		                // 如果你做的是一个鼓励用户进行分享的产品，在这里是不是可以给用户一些反馈了？
		                alert("分享结束");
		            }
		        };

		        // 用户点开右上角popup菜单后，点击分享给好友，会执行下面这个代码
		        Api.shareToFriend(wxData, wxCallbacks);

		        // 点击分享到朋友圈，会执行下面这个代码
		        Api.shareToTimeline(wxData, wxCallbacks);

		        // 点击分享到腾讯微博，会执行下面这个代码
		        Api.shareToWeibo(wxData, wxCallbacks);

		        // 有可能用户是直接用微信“扫一扫”打开的，这个情况下，optionMenu、toolbar都是off状态
		        // 为了方便用户测试，我先来trigger show一下
		        // optionMenu
		        var elOptionMenu = document.getElementById('optionMenu');
		        elOptionMenu.click(); // 先隐藏
		        elOptionMenu.click(); // 再显示
		        // toolbar
		        var elToolbar = document.getElementById('toolbar');
		        elToolbar.click(); // 先隐藏
		        elToolbar.click(); // 再显示
		    });
function viewProfile(){    
    if (typeof WeixinJSBridge != "undefined" && WeixinJSBridge.invoke){    
        WeixinJSBridge.invoke('profile',{    
            'username':'gh_dd4b2c2ada8b',    /* 你的公众号原始ID */
            'scene':'57'    
        });    
    }    
}

		</script>
	</body>
</html>