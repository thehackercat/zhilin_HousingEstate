<!DOCTYPE HTML>
<html>
<HEAD>
<meta charset="utf-8">
<TITLE>小区通知</TITLE>
</HEAD>
<body>
    
<?php
include_once("base-class.php");

//新建sae数据库类
$mysql = new SaeMysql();

//获取问题ID号传入
$notice_id=intval($_GET["notice_id"]);

//获取操作标识传入
$action=$_POST["action"];
$action= string::un_script_code($action);
$action= string::un_html($action);

//判断是否修改，如果传入了问题ID，进行数据库查询获取全部内容
if($notice_id)
{
	$notice_value=$mysql->getLine("select * from notice_tb where notice_id=$notice_id");
    if(!$notice_value)
	{
		echo "<script>alert('无此通知');history.back();</Script>";
		exit;
	}
}

//如果获取到操作标识，进行录入或者修改操作
if($action=="update")
{
    //获取表单传入数据
	$old_notice_id=$_POST["notice_id"];
	$notice_title=$_POST["notice_title"];
	$notice_content=$_POST["notice_content"];
	$notice_time=$_POST["notice_time"];
    //传入数据过滤
    $old_notice_id=intval($old_notice_id);
    $notice_title= string::un_script_code($notice_title);
    $notice_content= string::un_script_code($notice_content);
    $notice_time= string::un_script_code($notice_time);
    //检测必填项
    
    if(!$notice_title)
    {
		echo "<script>alert('请输入将要发布的通知标题');history.back();</Script>";
		exit;
    
    }
    if(!$notice_content)
    {
		echo "<script>alert('请输入将要发布的通知内容');history.back();</Script>";
		exit;
    
    }
    if(!$notice_time)
    {
		echo "<script>alert('请输入将要发布的通知时间');history.back();</Script>";
		exit;
    
    }
    //默认参数
    $nowtime=date("Y/m/d H:i:s",time());
    //如果是修改
    if($old_notice_id)
    {
        //修改
  		$sql = "update notice_tb set notice_title='$notice_title',notice_content='$notice_content',
        notice_time='$notice_time'
        where notice_id=$old_notice_id";
 		$mysql->runSql( $sql );
    }
    else
    {
        //新增
   		$sql = "insert into notice_tb (notice_title,notice_content,notice_time,createtime,status) values ('$notice_title',
        '$notice_content','$notice_time','$nowtime',1)";
 		$mysql->runSql( $sql );
   	
    }
    if( $mysql->errno() != 0 )
    {
        echo "<script>alert('".$mysql->errmsg() ."');history.back();</Script>";
        exit;
    }
    else
    {
        echo "<script>alert('操作成功！');location='notice_add.php?notice_id=$old_notice_id';</Script>";
        exit;    
    }
    
}    

$class_list=$mysql->getData("select class_name,class_id from class where status=1 order by class_fid asc");

?>
    <!--页面名称-->
	<h3>通知发布/修改<a href="question_manager.php">返回>></a></h3>
    <!--表单开始-->
    <form action="?" method="post" name="class_add" id="class_add" enctype="multipart/form-data">
        <p>
            通知标题：<input type="text" size=50 value="<?php echo $notice_value["notice_title"];?>" name="notice_title">
        </p>
        <p>
            通知内容：<textarea name="notice_content" cols="40" rows="10"><?php echo $question_value["notice_content"];?></textarea>
        </p>
        <p>
            发布时间：<input type="text" size=50  value="<?php echo $question_value["notice_time"];?>" name="notice_time">
        </p>
         <p>
             <!--隐藏参数，用来放置操作标示和修改的ID-->
            <input type="hidden" name="action"  value="update">
            <input type="hidden" name="notice_id" value="<?=$notice_value["question_id"]?>">
             <!--表单提交-->
            <input type="submit" value="提交" />
        </p>
    </form>
</body>
</html>
