<?php
$textTpl = "<xml>\n
		  <ToUserName><![CDATA[%s]]></ToUserName>\n
		  <FromUserName><![CDATA[%s]]></FromUserName>\n
		  <CreateTime>%s</CreateTime>\n
	      <MsgType><![CDATA[%s]]></MsgType>\n
		  <Content><![CDATA[%s]]></Content>\n
		  <FuncFlag>0</FuncFlag>\n
		  </xml>";


$newsTpl = "<xml>\n
		  <ToUserName><![CDATA[%s]]></ToUserName>\n
          <FromUserName><![CDATA[%s]]></FromUserName>\n
          <CreateTime>%s</CreateTime>\n
          <MsgType><![CDATA[%s]]></MsgType>\n
          <ArticleCount>%s</ArticleCount>\n
          <Articles>\n
          <item>\n
          <Title><![CDATA[%s]]></Title>\n
          <Description><![CDATA[%s]]></Description>\n
          <PicUrl><![CDATA[%s]]></PicUrl>\n
          <Url><![CDATA[%s]]></Url>\n
          </item>\n
          </Articles>\n
          <FuncFlag>1</FuncFlag>\n
          </xml>";

$musicTpl = "<xml>
             <ToUserName><![CDATA[%s]]></ToUserName>
             <FromUserName><![CDATA[%s]]></FromUserName>
             <CreateTime>%s</CreateTime>
             <MsgType><![CDATA[%s]]></MsgType>
             <Music>
             <Title><![CDATA[%s]]></Title>
             <Description><![CDATA[%s]]></Description>
             <MusicUrl><![CDATA[%s]]></MusicUrl>
             <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
             </Music>
             <FuncFlag>0</FuncFlag>
             </xml>";
































/*
i am  


 ***************     *           *        ***********
        *            *           *        *
		*            *           *        *
		*            *           *        *
		*            *************        **********
		*            *           *        *
		*            *           *        *
		*            *           *        *
		*            *           *        ************
		
*           *              *                **********       **   ***        ***********        **********
*           *             * *              *                 **  **          *                  *         *
*           *            *   *            *                  ** **           *                  *          *
*           *           *     *           *                  ****            *                  *         *
*************          *********          *                  ***             **********         **********         
*           *         *         *         *                  ** **           *                  *               
*           *        *           *        *                  **  **          *                  * *
*           *        *           *         *                 **   **         *                  *   *
*           *        *           *          ***********      **    ***       ************       *     ******


  **********               *               ***************
 *                        * *                     *
*                        *   *                    *
*                       *     *                   *
*                      *********                  *
*                     *         *                 *
*                    *           *                *
 *                   *           *                *
  ***********        *           *                *                       
  
  

2015.2.1

——————————————————————————————————————————————————————————————————————————————————
——————————————————————————————————————————————————————————————————————————————————

给后端人员的一些话

微信端实现功能的网页，如：小区新闻，
我已经做了一个notice_add和notice_manager.php，可以查看源码参考来写快递的网页，希望对你们有帮助 ：） 
我对后端实在不同，都是照着大神的代码一步一步模仿过来的。。T.T
所以希望你们也加油哈！

2015.3.1

*/

?>