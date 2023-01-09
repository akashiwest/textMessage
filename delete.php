<!--
   项目名称：明石留言板
   版本：V2.2
   时间：2021-9-5
   
   Copyright©2021 | Akashi Tec.
   遵循 CC-BY-NC-SA 4.0版权协议
   
   delete.php
-->

<?php require_once( 'header.php'); ?>
<div class="mdui-drawer" id="main-drawer">
      <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 68px;">
        <div class="mdui-list">
		<a class="mdui-list-item mdui-list-item-active">
            <i class="mdui-icon material-icons">sentiment_dissatisfied</i>
            &emsp;错误页
          </a>
          <a href="./index.php" class="mdui-list-item">
            <i class="mdui-list-item-icon mdui-icon material-icons">filter_none</i>
            &emsp;返回主页
          </a>
		  
		  <?php
		  if (($selfsettingout[5] != 1)){
			   
		   echo "<a href=\"./about.php\" class=\"mdui-list-item\">";
            echo "<i class=\"mdui-list-item-icon mdui-icon material-icons\">info_outline</i>";
            echo "&emsp;关于";
          echo "</a>  ";
		  }else{
			  
		  }
		  
		  ?>

         <?php 
	
	// 首先判断Cookie是否有记住了用户信息
	if (isset($_SESSION['ambadminlogin'])) {
		echo' <a href="./admin.php" class="mdui-list-item"><i class="mdui-list-item-icon mdui-icon material-icons">build</i>&emsp;后台管理';
	} else {
		
	}
 ?>
          </a>
        </div>
       
		
	
    <br>
		




<script language="JavaScript">
var mess="";

day = new Date( )

hr = day.getHours( )
if (( hr >= 4) && (hr <= 6 ))
mess="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp天还没亮，<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp夜猫子，快休息啦！ "
if (( hr > 6 ) && (hr < 7))
mess="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp早上好，<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp起得真早呀 "
if (( hr >= 7 ) && (hr < 12))
mess="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp上午好！<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp从现在开始美好的一天吧"
if (( hr >= 12) && (hr <= 13))
mess="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp中午好呀！<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp别太为难自己的肚子哦！"
if (( hr > 13) && (hr <= 16))
mess="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp下午好，<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp喝杯茶再继续奋斗吧！ "
if (( hr > 16) && (hr <= 18))
mess="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp傍晚了呢，<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp我大概在吃晚饭了，你呢？"
if ((hr > 18) && (hr < 21))
mess="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp晚上了，<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp总结一下一天的收获吧！"
if ((hr >= 21) && (hr <= 23))
mess="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp夜已深，<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp该睡觉了呢！"
if ((hr > 23) && (hr < 4))
mess="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp很晚了哦，<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp注意休息呀！"
document.write(mess)
</script>


        
      </div>
    </div>
    <br/>
<div class="mdui-typo">
<?php

if($_SERVER['HTTP_REFERER'] == "" )
{

exit('<br><h1><center>非法操作，请勿直接访问本页面。</center></h1><br><br>');
}		

?>
</div>
<?php 
	
  
	

	if (isset($_SESSION['ambadminlogin'])) {
		
	} else {
		// 若没有登录
    $urlerrlog = "./index.php?err=4";  
    echo "<script language='javascript' type='text/javascript'>window.location.href='$urlerrlog'</script>";
		exit();
	}
 ?>


<?php
if (isset($_POST['allsite_re'])) {
	if($_POST['allsiterepasswd'] == $passwd){
	unlink('./database/installlock.amb');
	unlink("$db1");
	unlink("$db2");
	$allsiteurl = './index.php';
	echo "<script language='javascript' type='text/javascript'>window.location.href='$allsiteurl'</script>";  
	exit();
}else{
  $urlreerr = "./admin.php?err=4";  
  echo "<script language='javascript' type='text/javascript'>window.location.href='$urlreerr'</script>";
	exit();
}
}
?>


<?php

$id = htmlspecialchars($_GET["id"]); 
$method = htmlspecialchars($_GET["method"]); 

if(empty($method)){
  exit("<br><center><div class=\"mdui-typo\"><h1>错误：未检测到数据提交。请重试。</h1></div></center><br><br>");
  
  }
  if(empty($method)){
    exit("<br><center><div class=\"mdui-typo\"><h1>错误：未检测到数据提交。请重试。</h1></div></center><br><br>");
    
    }

if($method != 1){
    $dbaction = $db2;
	$url = "./admin.php"; 
  }else{
    $dbaction = $db1;
	$url = "./"; 
  }
                   
// 从message.txt获取留言信息
$info = file_get_contents($dbaction);

// 拆分留言信息
$messagelist = explode("@@@", $info);

// 使用unset删除留言
unset($messagelist[$id]);

// 写回message.txt
$messageinfo = implode("@@@", $messagelist);
file_put_contents($dbaction, $messageinfo);

               echo "<script language='javascript' type='text/javascript'>window.location.href='$url'</script>";  

exit();
?>