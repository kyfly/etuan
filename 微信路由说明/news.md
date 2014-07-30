接口的主要作用为社团对图文信息的增删改查。
----
~~~javascipt
@news_id        //图文消息id	   		
@article_id     //图文消息id
@mp_id          //社团微信号在服务器上的id
@title          //标题   
@description    //描述
@pic_url        //图片地址（创建时可通过编辑器获得）
@url            //连接地址
@content        //内容地址（创建时可通过编辑器获得）
@news_from      //图文消息来源（好像暂时没什么用）
~~~

创建消息： `/news/create`
---

请求方式：`post`
返回值：
    `$arr[]="创建消息失败，请修改部分内容，可能该消息已存在。";
    bool`
参数： 
~~~javascipt
多图文：
[
{
    "title": "test11",
    "description": "ddssnddddd",
    "pic_url": "kkkkkkkkkk",
    "url": "llllllll",
    "content": "kk",
  	"news_from":"sucai",
    "mp_id": 1
},
{
    "title": "test22",
    "description": "ffffffffff",
    "pic_url": "rrrrrrrr",
    "url": "222222222",
    "content": "dd",
  "news_from":"sucai",
    "mp_id": 1
},
{
    "title": "test33",
    "description": "gggggggggg",
    "pic_url": "fffffccffff",
    "url": "333333333",
    "content": "ddd",
  "news_from":"sucai",
    "mp_id": 1
}
]

单图文：
{
"title": "test", 
"description": "ddssnddddd", 
"pic_url": "kkkkkkkkkk", 
"url": "llllllll", 
"content": "kk", 
	"news_from":"sucai",
"mp_id": 1
}
~~~

跟新图文消息内容：  `/news/update `
--

该接口为图文消息更新接口：
返回值：`0 说明成功；`
请求方式：`post`
参数：
~~~javascipt        
          多图文：
            "[
    {
        "news_id": 10,
        "article_id": 1,
        "title": "test",
        "description": "dddddddddd",
        "pic_url": "kkkkkkkkkk",
        "url": "etuan/mp/sucai/gh_f53d79a8e7ce/14072913185863912.html",
        "content": "fffffffkk",
        "act_id": "4",
        "news_from": "url"
    },
    {
        "news_id": 10,
        "article_id": 2,
        "title": "test1",
        "description": "aaaaaaaaaaaaa",
        "pic_url": "ddddddk",
        "url": "etuan/mp/sucai/gh_f53d79a8e7ce/14072913185918355.html",
        "content": "dggrdsr",
        "act_id": "4",
        "news_from": "url"
    },
    {
        "news_id": 10,
        "article_id": 3,
        "title": "test",
        "description": "ffffffff",
        "pic_url": "ccccccccck",
        "url": "etuan/mp/sucai/gh_f53d79a8e7ce/14072913185929300.html",
        "content": "iiifffffiiiii",
        "act_id": "4",
        "news_from": "url"
    }
]"
		单图文：
			{
			    "news_id": 19, 
			    "article_id": 1, 
			    "title": "test", 
			    "description": "5555555555555", 
			    "pic_url": "555555555555", 
			    "url": "llllllll", 
			    "content": "fffffffkk", 
			    "act_id": "4",
			    "news_from": "sucai"
			}
~~~

活动信息：  `/news/cact`
---

该接口为社团活动信息图文消息创建接口,在社团选择此图文消息时调用。
请求方式：post
~~~javascipt
参数：
"{
    "title": "test11",
    "description": "dddddddddd",
    "pic_url": "kkkkkkkkkk",
    "url": "llllllll",
    "news_from": "vote",
    "mp_id": 1,
    "act_id": 3
}"
返回值：bool
~~~

查出图文消息：  `/news/show`
	---

查出所有已存在的图文消息
请求方式：`get`
参数：`mp_id`
返回值：
~~~javascipt
{
    "news": {
        "63": [
            {
                "mp_id": 1,
                "news_id": 63,
                "article_id": 1,
                "title": "1gdgfffggfgtgfhrffvff1",
                "description": "ggfffffggdh",
                "pic_url": "kkkkkkhkkkk",
                "url": "etuan/mp/sucai/gh_f53d79a8e7ce/14072923111013636.html",
                "news_from": "sucai",
                "act_id": 0,
                "content": "<script></script>"
            },
            {
                "mp_id": 1,
                "news_id": 63,
                "article_id": 2,
                "title": "tesdsgt22",
                "description": "fffffffffffff",
                "pic_url": "rrrrrrrr",
                "url": "etuan/mp/sucai/gh_f53d79a8e7ce/14072923111163407.html",
                "news_from": "sucai",
                "act_id": 0,
                "content": "dd"
            },
            {
                "mp_id": 1,
                "news_id": 63,
                "article_id": 3,
                "title": "testffdg33",
                "description": "gggffggggggg",
                "pic_url": "fffffccffff",
                "url": "etuan/mp/sucai/gh_f53d79a8e7ce/14072923111242019.html",
                "news_from": "sucai",
                "act_id": 0,
                "content": "ddd"
            }
        ],
        "64": [
            {
                "mp_id": 1,
                "news_id": 64,
                "article_id": 1,
                "title": "test",
                "description": "dddddddddd",
                "pic_url": "kkkkkkkkkk",
                "url": "etuan/mp/url/gh_f53d79a8e7ce/14072923131527111.html",
                "news_from": "url",
                "act_id": 0,
                "content": "ffffgnhdfffkk"
            },
            {
                "mp_id": 1,
                "news_id": 64,
                "article_id": 2,
                "title": "test1",
                "description": "aaaaaaaaaaaaa",
                "pic_url": "ddddddk",
                "url": "etuan/mp/url/gh_f53d79a8e7ce/14072923131655590.html",
                "news_from": "url",
                "act_id": 0,
                "content": "dgdngrdsr"
            },
            {
                "mp_id": 1,
                "news_id": 64,
                "article_id": 3,
                "title": "test",
                "description": "ffffffff",
                "pic_url": "ccccccccck",
                "url": "etuan/mp/url/gh_f53d79a8e7ce/14072923131664678.html",
                "news_from": "url",
                "act_id": 0,
                "content": "iiiffdfnjfffiiiii"
            }
        ]
    },
    "act": {
        "1": [
            {
                "title": "gggggggg",
                "description": "点击进入gggggggg>>",
                "pic_url": null,
                "url": "ffffffffffffff",
                "news_from": "registration",
                "act_id": "reg_id"
            },
            {
                "title": "fffffffffffffffff",
                "description": "点击进入fffffffffffffffff>>",
                "pic_url": null,
                "url": "dddddddddddddd",
                "news_from": "registration",
                "act_id": "reg_id"
            }
        ],
        "2": [
            {
                "title": "kkkkkkkk",
                "description": "点击进入kkkkkkkk>>",
                "pic_url": null,
                "url": "kkkkkkkkkkkkk",
                "news_from": "ticket",
                "act_id": "ticket_id"
            }
        ]
    }
}
~~~

删除某条图文消息：   `/news/destory	`
---

删除某条图文消息	
请求方式：`get`
参数：`news_id`
返回值：`bool`
	

