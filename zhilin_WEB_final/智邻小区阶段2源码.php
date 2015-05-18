<?php
/*
surprise in wx_tpl.
*/




//装载模板文件
include_once("wx_tpl.php");
include_once("base-class.php");


//新建sae数据库类
$mysql = new SaeMysql();

//新建Memcache类
$mc=memcache_init();

//获取微信发送数据
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

//操作菜单
$help_menu="回复“1”获取 商家优惠\n回复“2”进入 物业维修\n回复“3”进入 快件提醒\n回复“4”进入 医疗服务 \n回复“5”进入 家政服务\n回复“6”进入 费用查询\n\n输入'help'回到主菜单\n";

$notice_nums=1;

//返回回复数据
if (!empty($postStr))
{
          
    	//解析数据
          $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    	//发送消息方ID
          $fromUsername = $postObj->FromUserName;
    	//接收消息方ID
          $toUsername = $postObj->ToUserName;
		//消息类型
          $form_MsgType = $postObj->MsgType;
    
    
		//事件消息
         if($form_MsgType=="event")
		{
            //获取事件类型
            $form_Event = $postObj->Event;
              
              
            //关注语  
            if($form_Event=="subscribe")
			{
				/*
                $welcome_str="感谢关注智邻小区，我是萌萌哒关注语！(可修改)\n\n";  //mengmengda =3=
                
				以下是第二次修改关注语。
				*/
				
				$welcome_str="感谢关注智邻小区。\n智邻微信公众平台是一款面向现代城市智能小区构建，为小区居民、物业管理和周边商家三方提供互动交流平台。\n\n点击下方按钮获取更多功能。\n";
				
				//指定消息类型（查看wx_tpl.php）
                $msgType = "text";
				
				//$resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $welcome_str); <-----$welcome_str可改成任意字段
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $welcome_str);
               	echo $resultStr;
                exit;  
			}
			
            //获取自定义菜单点击事件
              
            if($form_Event=="CLICK")
            {
               
                //获取菜单key值
                $form_EventKey = trim($postObj->EventKey);
                
                //周边服务-商家优惠-跳转网页
                if($form_EventKey=="zbfw_1") //与make_menu.php里的key值对应
                {
                    
					/*
                    $msgType = "news";
                    $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, time(), $msgType, 1,"周边服务-商家优惠",
                                         "商家优惠",
                                         "http://devdtwechat-image.stor.sinaapp.com/index_img5_2345%E7%9C%8B%E5%9B%BE%E7%8E%8B.jpg",
                                         "http://1.devdtwechat.sinaapp.com/zhilin_web/sjyh.html");
					
					第一阶段修改，改为下拉菜单多图文模式.
					*/
					
					/*
					解释一下该图文模板：
					<ToUserName> 这里填入每个微信公众账号传回来的fromUsername的值</ToUserName>
					<FromUserName> 这里是我根据模板获取的每个向该公众账号发送消息的用户的UserName  </FromeUserName>
					<CreateTime>".time()"获取当前时间 </CreateTime>
					<MsgType>图文为news 文字为text </MsgType>
					<ArticleCount>下拉列表的个数 </ArticleCount>
					
					<Title>标签名</Title>
					<Description> 对该标签的描述，一般不填写.</Description>
					<PicUrl>图文样式里 图片的url</PicUrl>
					<Url></Url>
					
					<Funcflag>标记星标的字段个数 </Funcflag>
					
					在该网站有详细解释 http://www.jb51.net/article/41750.html  :)
					*/
					
					$resultStr="<xml>\n
								<ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
								<FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
								<CreateTime>".time()."</CreateTime>\n
								<MsgType><![CDATA[news]]></MsgType>\n
								<ArticleCount>3</ArticleCount>\n
								<Articles>\n";
              
					$resultStr.="<item>\n
								<Title><![CDATA[商家优惠-主页]]></Title> \n
								<Description><![CDATA[]]></Description>\n
								<PicUrl><![CDATA[http://devdtwechat-image.stor.sinaapp.com/index_img5_2345%E7%9C%8B%E5%9B%BE%E7%8E%8B.jpg]]></PicUrl>\n
								<Url><![CDATA[http://1.devdtwechat.sinaapp.com/zhilin_web/sjyh.html]]></Url>\n
								</item>\n";
              
					$resultStr.="<item>\n
								<Title><![CDATA[家乐福超市优惠活动]]></Title> \n
								<Description><![CDATA[]]></Description>\n
								<PicUrl><![CDATA[http://devdtwechat-image.stor.sinaapp.com/%E5%AE%B6%E4%B9%90%E7%A6%8F%E6%A0%87%E5%BF%97.jpg]]></PicUrl>\n
								<Url><![CDATA[http://1.devdtwechat.sinaapp.com/zhilin_web/content2.html]]></Url>\n
								</item>\n";
              
					$resultStr.="<item>\n
								<Title><![CDATA[小米手机优惠活动]]></Title> \n
								<Description><![CDATA[]]></Description>\n
								<PicUrl><![CDATA[http://devdtwechat-image.stor.sinaapp.com/%E5%B0%8F%E7%B1%B3%E5%9B%BE%E6%A0%87.jpg]]></PicUrl>\n
								<Url><![CDATA[http://1.devdtwechat.sinaapp.com/zhilin_web/content3.html]]></Url>\n
								</item>\n";

					$resultStr.="</Articles>\n
								<FuncFlag>0</FuncFlag>\n
								</xml>";
					
                    echo $resultStr;
                    exit;  
                }              
                
                //周边服务-物业维修-跳转网页
                if($form_EventKey=="zbfw_2")
                {
                    /*
                    $msgType = "news";
                    $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, time(), $msgType, 1,"周边服务-物业维修",
                                         "物业维修",
                                         "http://devdtwechat-image.stor.sinaapp.com/index_img6_2345%E7%9C%8B%E5%9B%BE%E7%8E%8B.jpg",
                                         "http://1.devdtwechat.sinaapp.com/zhilin_web/wywx.html");
					*/
					
					$resultStr="<xml>\n
								<ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
								<FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
								<CreateTime>".time()."</CreateTime>\n
								<MsgType><![CDATA[news]]></MsgType>\n
								<ArticleCount>2</ArticleCount>\n
								<Articles>\n";
              
					$resultStr.="<item>\n
								<Title><![CDATA[物业维修-主页]]></Title> \n
								<Description><![CDATA[]]></Description>\n
								<PicUrl><![CDATA[http://devdtwechat-image.stor.sinaapp.com/index_img6_2345%E7%9C%8B%E5%9B%BE%E7%8E%8B.jpg]]></PicUrl>\n
								<Url><![CDATA[http://1.devdtwechat.sinaapp.com/zhilin_web/wywx.html]]></Url>\n
								</item>\n";
              
					$resultStr.="<item>\n
								<Title><![CDATA[不用中介找物业，上58同城]]></Title> \n
								<Description><![CDATA[]]></Description>\n
								<PicUrl><![CDATA[http://devdtwechat-image.stor.sinaapp.com/58%E5%90%8C%E5%9F%8Elogo.png]]></PicUrl>\n
								<Url><![CDATA[http://1.devdtwechat.sinaapp.com/zhilin_web/content5.html]]></Url>\n
								</item>\n";

					$resultStr.="</Articles>\n
								<FuncFlag>0</FuncFlag>\n
								</xml>";
					
                    echo $resultStr;
                    exit;  
                }              
				
				//周边服务-快件提醒-文字类回复
                if($form_EventKey=="zbfw_3")
                {
                    
                    $msgType = "text";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, "您的有新快递。所属快递公司:顺丰快递。取件地点:电子科技大学社区院门口。取件时间:下午18:00前。快递员名称:张有智。电话18782136948。");
                    echo $resultStr;
                    exit;  
                }
          
                //周边服务-医疗服务-跳转网页 
                if($form_EventKey=="zbfw_4")
                {
                    /*
                    $msgType = "news";
                    $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, time(), $msgType, 1,"周边服务-医疗服务",
                                         "医疗服务",
                                         "http://devdtwechat-image.stor.sinaapp.com/index_img7_2345%E7%9C%8B%E5%9B%BE%E7%8E%8B.jpg",
                                         "http://1.devdtwechat.sinaapp.com/zhilin_web/ylfw.html");
					*/
					$resultStr="<xml>\n
								<ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
								<FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
								<CreateTime>".time()."</CreateTime>\n
								<MsgType><![CDATA[news]]></MsgType>\n
								<ArticleCount>2</ArticleCount>\n
								<Articles>\n";
              
					$resultStr.="<item>\n
								<Title><![CDATA[医疗服务-主页]]></Title> \n
								<Description><![CDATA[]]></Description>\n
								<PicUrl><![CDATA[http://devdtwechat-image.stor.sinaapp.com/index_img7_2345%E7%9C%8B%E5%9B%BE%E7%8E%8B.jpg]]></PicUrl>\n
								<Url><![CDATA[http://1.devdtwechat.sinaapp.com/zhilin_web/ylfw.html]]></Url>\n
								</item>\n";
              
					$resultStr.="<item>\n
								<Title><![CDATA[中国平安医疗保险]]></Title> \n
								<Description><![CDATA[]]></Description>\n
								<PicUrl><![CDATA[http://devdtwechat-image.stor.sinaapp.com/%E5%B9%B3%E5%AE%89%E5%8C%BB%E7%96%97%E4%BF%9D%E9%99%A9logo.jpg]]></PicUrl>\n
								<Url><![CDATA[http://1.devdtwechat.sinaapp.com/zhilin_web/content4.html]]></Url>\n
								</item>\n";

					$resultStr.="</Articles>\n
								<FuncFlag>0</FuncFlag>\n
								</xml>";
					
                    echo $resultStr;
                    exit;  
                }              
           
				//周边服务-家政服务-跳转网页
				if($form_EventKey=="zbfw_5")
                {
                    /*
                    $msgType = "news";
                    $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, time(), $msgType, 1,"周边服务-家政服务",
                                         "家政服务",
                                         "http://devdtwechat-image.stor.sinaapp.com/index_img8_2345%E7%9C%8B%E5%9B%BE%E7%8E%8B.jpg",
                                         "http://1.devdtwechat.sinaapp.com/zhilin_web/jzfw.html");
					*/
					$resultStr="<xml>\n
								<ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
								<FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
								<CreateTime>".time()."</CreateTime>\n
								<MsgType><![CDATA[news]]></MsgType>\n
								<ArticleCount>2</ArticleCount>\n
								<Articles>\n";
              
					$resultStr.="<item>\n
								<Title><![CDATA[家政服务-主页]]></Title> \n
								<Description><![CDATA[]]></Description>\n
								<PicUrl><![CDATA[http://devdtwechat-image.stor.sinaapp.com/index_img8_2345%E7%9C%8B%E5%9B%BE%E7%8E%8B.jpg]]></PicUrl>\n
								<Url><![CDATA[http://1.devdtwechat.sinaapp.com/zhilin_web/jzfw.html]]></Url>\n
								</item>\n";
              
					$resultStr.="<item>\n
								<Title><![CDATA[不用中介找家政，上58同城]]></Title> \n
								<Description><![CDATA[]]></Description>\n
								<PicUrl><![CDATA[http://devdtwechat-image.stor.sinaapp.com/58%E5%90%8C%E5%9F%8Elogo.png]]></PicUrl>\n
								<Url><![CDATA[http://1.devdtwechat.sinaapp.com/zhilin_web/content5.html]]></Url>\n
								</item>\n";

					$resultStr.="</Articles>\n
								<FuncFlag>0</FuncFlag>\n
								</xml>";
					
					
                    echo $resultStr;
                    exit;  
                }  
				
				//我的小区-小区社交-跳转网页
				if($form_EventKey=="wdxq_1")
                {
                    
                    $msgType = "text";
            	    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, "本功能正在申请开放中。");
                    echo $resultStr;
                    exit; 
                }  
				
				//我的小区-小区新闻-文字类回复
				if($form_EventKey=="wdxq_2")
                {
                    
                    $msgType = "text";
            	    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, "热烈庆祝欣荣社区在我市的“全市文明社区评定竞赛”中获得市文明先进奖。社区物业经研究决定于2015年3月14日开展庆祝活动，欢迎大家参与。");
                    echo $resultStr;
                    exit;  
                }  
				
				//我的小区-生活常识-跳转网页
				if($form_EventKey=="wdxq_3")
                {
                    /*
                    $msgType = "news";
                    $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, time(), $msgType, 1,"我的小区-生活常识",
                                         "生活常识",
                                         "http://devdtwechat-image.stor.sinaapp.com/index_img3_2345%E7%9C%8B%E5%9B%BE%E7%8E%8B.jpg",
                                         "http://1.devdtwechat.sinaapp.com/zhilin_web/list.html");
					*/
					
					$resultStr="<xml>\n
								<ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
								<FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
								<CreateTime>".time()."</CreateTime>\n
								<MsgType><![CDATA[news]]></MsgType>\n
								<ArticleCount>2</ArticleCount>\n
								<Articles>\n";
              
					$resultStr.="<item>\n
								<Title><![CDATA[生活常识-主页]]></Title> \n
								<Description><![CDATA[]]></Description>\n
								<PicUrl><![CDATA[http://devdtwechat-image.stor.sinaapp.com/index_img3_2345%E7%9C%8B%E5%9B%BE%E7%8E%8B.jpg]]></PicUrl>\n
								<Url><![CDATA[http://1.devdtwechat.sinaapp.com/zhilin_web/list.html]]></Url>\n
								</item>\n";
              
					$resultStr.="<item>\n
								<Title><![CDATA[中国平安医疗保险]]></Title> \n
								<Description><![CDATA[]]></Description>\n
								<PicUrl><![CDATA[http://devdtwechat-image.stor.sinaapp.com/%E5%B9%B3%E5%AE%89%E5%8C%BB%E7%96%97%E4%BF%9D%E9%99%A9logo.jpg]]></PicUrl>\n
								<Url><![CDATA[http://1.devdtwechat.sinaapp.com/zhilin_web/content4.html]]></Url>\n
								</item>\n";

					$resultStr.="</Articles>\n
								<FuncFlag>0</FuncFlag>\n
								</xml>";
								
                    echo $resultStr;
                    exit;  
                }  
				
				//我的小区-小区通知-文字类回复
				if($form_EventKey=="wdxq_4")
                {
                    
                                        
                    $msgType = "text";
            	    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, "2015年2月15日小区将进行水管维护，预计从上午10点至下午2点将停止供应热水，请业主提前准备。");
                    echo $resultStr;
                    exit; 
                    
                    
                    
                    /*
					//获取通知消息（返回一个数组）
					$notice_list=$mysql->getData("select *
                                from notice_tb 
                                where notice_id >=
                                (select floor(rand()*((select max(notice_id) from notice_tb)-(select min(notice_id) from notice_tb)) + 
                                (select min(notice_id) from notice_tb)))
                                order by notice_id limit ".$notice_nums);
								
					//将数组序列化存放到缓存，创建当前通知消息容器，保存时间设定10分钟
                    $mc->set($fromUsername."_notice_data", serialize($notice_list), 0, 600);
					
					//设定通知次序
                    $mc->set($fromUsername."_notice_order", "num_1", 0, 600);
					
					//从memcache获取当前通知消息
					$notice_data=unserialize($mc->get($fromUsername."_notice_data"));
					
					//从memcache获取历史数据
					$notice_order=$mc->get($fromUsername."_notice_order");
					
					//获取当前通知的序号
                    $now_order=explode("_",$notice_order);
                    $now_order=intval($now_order[1])-1;
					.
					//提取通知信息
                    $notice_out=$notice_data[$now_order]["notice_title"]."\n\n".$notice_data[$now_order]["notice_content"];
					
					//输出通知
                  	$msgType = "text";
                  	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $notice_out);
               	  	echo $resultStr;
                    exit;  
                    */
 
                }  
				
				
				//个人中心-费用查询-文字类回复
				if($form_EventKey=="grzx_1")
                {
                    
                    $msgType = "text";
            	    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, "本功能正在开发中。");
                    echo $resultStr;
                    exit; 
                }  
				
				
				
				

				//获取广告案例
                if($form_EventKey=="AD_1")
                {
                         
                    $msgType = "text";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType,"智邻小区广告案例");
                    echo $resultStr;
                    exit;  
                }
                
            }
		}
		else 
		{
			echo "";
			exit;
		}
}
?>