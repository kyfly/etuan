该接口主要作用为社团公众号消息的创建和修改
---

	@mp_origin_id		//社团原始id
	@appid				//社团appid
	@secret				//社团appsecret
	@interface_url
		//社团微信接口地址 需要情面加上web域名 例：http://www.example.com/mp/{interface_url}社团公用
		//http://www.example.com/wx/{interface_url}团团一家地址
	@interface_token	//社团微信接口token
	
`/org/cwx`
---

请求方式：`post`
返回值：`bool`
参数：
      `appid`
      `secret`

		      
`/org/uwx`     
---

请求方式：`post`
返回值：`bool`
参数：  `mp_id`
        `appid`
        `secret`

`/org/swx`
---
~~~javascipt
请求方式：`get`
返回值：[
		    {
		        "mp_origin_id": "jjjjjjjjjjjjjjjjjjj", 
		        "interface_url": "KPWHZJ71J1MJKPBRKAKHKMZQI6T4NSZ0", 
		        "interface_token": "I1UV5VJAQQ04HVYWUCBANVKHAFD1IQNL"
		    }, 
		    {
		        "mp_origin_id": "kkkkkkkkkkkkkk", 
		        "interface_url": "SCNO3FGG7LO6OI05PG30FYW284FSTSFJ", 
		        "interface_token": "INHJNO4TEOV1U6F8SX5I8O28YSNX1P4T"
		    }, 
		    {
		        "mp_origin_id": "kkkkkkkkkkkkkk", 
		        "interface_url": "STC9YJL2ON2TET8PKM6SHCD44FS20ZEB", 
		        "interface_token": "ULT2IG6P527JJ26QEOKI1QN4N094ASZU"
		    }
		]
~~~