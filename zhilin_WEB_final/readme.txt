这些就是我们所有的前端代码， 其中hy_开头的html文件以及base-class.php可以不用查看与编辑。那是没用的文件。
然后5个content内容对应的是一些广告。
两个index.html是比较重要的主页内容。
智邻小区阶段2源码.php是与微信服务器对接的主要文件。我在里面设置了相应的功能。
而wx_tpl.php是借口调用的文件。

需要开发的是jzfw.html(家政服务)
	    sjyh.html（商家优惠）
	    wywx.html（物业维修）
            ylfw.html（医疗服务）
            list.html(生活常识)
            list2.html（小区新闻）
以及对应value值 的小区通知，小区新闻，费用查询（貌似这个需求文档里不要求QAQ）和快件提醒，这些我在注释里应该标示了。

你们可以参照notice_add.php 和 notice_manager.php 进行修改 。 
我因为晚上有点其他的事儿，比较急促的先给出 这个readme.txt 和 不完善的一些注释。不好意思啊。。T.T
我会再增加一些注释方便你们的阅读 在晚一些 的时候 给你们第二个zhilin_web_final.rar

后端主要运用php进行开发。

2015.3.3 18:06 小虚。


****************************************************************************************************************************


这次增加了一些注释，关于接口方面 http://www.jb51.net/article/41750.html 该网站有很详尽的解释。 

简要的说一下 我之前做的那个notice_add.php 和 notice_manager.php 的用法

首先 将index.php 里小区通知 $form_EventKey=="wdxq_4" 
里的                                         
                    $msgType = "text";
            	    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, "2015年2月15日小区将进行水管维护，预计从上午10点至下午2点将停止供应热水，请业主提前准备。");
                    echo $resultStr;
                    exit; 

这段用 /*  */注释掉

接着打开下面的注释。
然后到http://1.devdtwechat.sinaapp.com/notice_add.php 里添加小区通知 即可在微信端显示出来。

如果需要类似的做一个 需要修改一下notice_add.php 和 notice_manager.php里的参数，并在saeMysql里 对应的建表等操作。

之前遇到一个问题就是重启微信服务器 自定义菜单丢失的问题。

如遇到该问题需要在重启微信服务器后 到 http://1.devdtwechat.sinaapp.com/make_menu.php 该网页重新填写key-value值。

2015.3.4. 19:30 小虚。