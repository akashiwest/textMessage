<!--
   项目名称：明石留言板
   版本：V2.2
   时间：2021-9-5
   
   Copyright©2021 | Akashi Tec.
   遵循 CC-BY-NC-SA 4.0版权协议
   
   index.php
-->

<?php require_once( 'header.php');?>
 <div class="mdui-drawer" id="main-drawer">
      <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 68px;">
        <div class="mdui-list">
          <a href="./index.php" class="yuan mdui-list-item mdui-list-item-active">
            <i class="mdui-list-item-icon mdui-icon material-icons">filter_none</i>
            &emsp;主页
          </a>
		  
		  <?php
		  if (($selfsettingout[5] != 1)){
			   
		   echo "<a href=\"./about.php\" class=\"yuan mdui-list-item\">";
            echo "<i class=\"mdui-list-item-icon mdui-icon material-icons\">info_outline</i>";
            echo "&emsp;关于";
          echo "</a>  ";
		  }else{
			  
		  }
		  
		  ?>

         <?php 
	

 switch($_SESSION['ambadminlogin']){
   case '1':
    echo' <a href="./admin.php" class="yuan mdui-list-item"><i class="mdui-list-item-icon mdui-icon material-icons">build</i>&emsp;后台管理';
break;
 }

 ?>
          </a>
        </div>
      
    <br>
      </div>
    </div>
    <br/>


<div class="mdui-typo">




<?php  //////////////////////////////////////////////////////////////////////////////跳转链接
 
 if (isset($_GET['outlink'])) {
 $outlink = $_GET['outlink'];
  $replacelink=[
    "<"=>"《",
    ">"=>"》",
    "$"=>"￥",
    "{"=>"（",
    "}"=>"）",
    ";"=>"；",
    "?"=>"？",
    ":"=>"：",
    "\""=>"”",
    "'"=>"’",
    "("=>"（",
    ")"=>"）",
  ];
  foreach($replacelink as $klink => $vlink){
    $outlink=str_replace($klink,$vlink,$outlink);
  }

?>
<br>
	<div class="mdui-container" style="max-width: 88%; ">
        <div class="mdui-typo">
	<div style="padding-left: 6%;" class="mdui-card yuan">
          <h1>即将离开 <?php echo $selfsettingout[1]; ?></h1>
          <h4>将访问以下链接，请注意您的信息和财产安全。</h4>
          <h4>http://<?php echo $outlink; ?>/</h4>
          <br>
          <a class="mdui-btn mdui-color-blue-50 btyuan" href="http://<?php echo $outlink; ?>">继续访问</a>
          <a class="mdui-btn mdui-color-blue-100 btyuan" href="./">返回上一页</a>
          <br>
          <br>
       </div>
   </div>
 </div>

<?php
 exit();
}

 ?>





 <?php  //////////////////////////////////////////////////////////////////////////////添加留言
 
 if (isset($_POST['add'])) {
 
 //IP黑白名单检测
$ip=$_SERVER["REMOTE_ADDR"];

$addban=file_get_contents("./database/ban/addban.dat");

if(stripos($addban,$ip))
{
exit("<br><center><h1>你的IP地址 [$ip] 已被拉黑，禁止提交留言。</h1><h2>如果你有任何疑问，请联系网站管理者。</h2></center>");
}

  $addcaptchafinal = $_POST["addcaptcharesult"];
  $addcaptchauser = htmlspecialchars($_POST["addcaptchauser"]);
  
  if(($addcaptchafinal != $addcaptchauser))
  {
	?>
<script>
mdui.snackbar({
  message: '验证码错误，请重新输入！',
  position:'top',
  timeout:'2500'
});
</script>
<?php
  }
  elseif(($addcaptchauser == ''))
  {
    ?>
	  <script>
mdui.snackbar({
  message: '验证码不能为空，请重新输入！',
  position:'top',
  timeout:'2500'
});
</script>
<?php
  }
  elseif(($addcaptchauser = $addcaptchafinal))
  {
	  
$title = htmlspecialchars($_POST['title']); // 获取留言标题

$author = htmlspecialchars($_POST['author']); // 获取留言者

$content = $_POST["content"]; // 留言内容

if($title == null || $author == null){
  $urlnullcontent = "./?err=5";  
  echo "<script language='javascript' type='text/javascript'>window.location.href='$urlnullcontent'</script>"; 
exit();
}

	 $replaceadd=[
			"<"=>"《",
			">"=>"》",
			"$"=>"￥",
      "{"=>"（",
      "}"=>"）",
      ";"=>"；",
      "?"=>"？",
      ":"=>"：",
      "'"=>"’",
			"[li]"=>"<a href=\"./index.php?outlink=",
			"[nk]"=>"\"target=_blank\">链接<i class=\"mdui-icon material-icons\">link</i></a>",
			"[br]"=>"<br>",
      "("=>"（",
      ")"=>"）",
		];
		foreach($replaceadd as $kadd => $vadd){
			$content=str_replace($kadd,$vadd,$content);
		}

	if(( $author == '管理员' || $author == 'admin' || $author == $selfsettingout[7])){
   
	if (isset($_SESSION['ambadminlogin'])) {
		
	} else {
		// 若没有登录
    $urladminname = "./?err=1";  
                 echo "<script language='javascript' type='text/javascript'>window.location.href='$urladminname'</script>"; 
		exit();
	}
	}

if((mb_strlen($content) > $selfsettingout[3]*2) || (mb_strlen($author) > 18*2) || (mb_strlen($title) > 26*2)){
	exit("<br><h1><center>不要搞小聪明哦这位同学~ 字数超了</h1></center><br><br>");
}else{
	
}


  //限制同IP多次访问
if (!isset($_SESSION['ambadminlogin'])) {
define('TIME_OUT',"$selfsettingout[4]"); 

$time = time();
if( isset($_SESSION['time']) )
{
if( $time - $_SESSION['time'] <= TIME_OUT ) //判断超时
{
  $urltimeout = "./?err=3";  
                 echo "<script language='javascript' type='text/javascript'>window.location.href='$urltimeout'</script>"; 
  exit();
}
}
$_SESSION['time'] = $time;
}




date_default_timezone_set('PRC');



$ip = $_SERVER["REMOTE_ADDR"]; 
$addtime = date('Y-m-d H:i:s');
	 
	 

$message = "{$title}##{$author}##{$content}##{$ip}##{$addtime}@@@";

switch($_POST['secret']){
  case '1':
    $dbaction = $db2;
    break;
    case null:
    $dbaction = $db1;
    break;
}

$oldinfo = file_get_contents($dbaction); 

file_put_contents($dbaction,"$message".$oldinfo); 
   
?>
<script>
mdui.snackbar({
message: '留言发表成功！',
position:'top',
timeout:'2000'
});
</script>
<?php

}
 }
?> 





<?php //////////////////////////////////////////////////////////////////////////////登录
	
	
	if (isset($_POST['log_in'])) {
    
    

 //验证验证码

  $logincaptchauser = htmlspecialchars($_POST["logincap"]);
  
  if(($logincaptchauser != $_POST['logincaptcharesult']))
  {
    ?>
	  <script>
mdui.snackbar({
  message: '验证码错误，请重新输入！',
  position:'top',
  timeout:'3000'
});
</script>
<?php
  }
  elseif(($logincaptchauser == ''))
  {
    ?>
	  <script>
mdui.snackbar({
  message: '验证码不能为空，请重新输入！',
  position:'top',
  timeout:'3000'
});
</script>
<?php
  }
  elseif($logincaptchauser == $_POST['logincaptcharesult']){

  
       //验证密码
	
		$password = htmlspecialchars($_POST['passwd']);
		
   switch($password){
     case null:
      $urlpasswordnull = "./?err=2";  
                 echo "<script language='javascript' type='text/javascript'>window.location.href='$urlpasswordnull'</script>"; 
      exit();
      break;

      case $passwd:
        $_SESSION['ambadminlogin'] = 1;
			
        $url = "./admin.php?suc=2";  
                 echo "<script language='javascript' type='text/javascript'>window.location.href='$url'</script>";  
          
      exit();
      break;
   }
   ?>
   <script>
mdui.snackbar({
 message: '密码错误，请重新输入！',
 position:'top',
 timeout:'2500'
});
</script>
<?php
  }
}
 ?>
</div>






<div class="mdui-tab" mdui-tab>
 
		
	<a href="#show" class="mdui-ripple">
    <i class="mdui-icon material-icons">assignment</i>
  <label>主页</label>
  </a>
		 
		
  <a href="#add" class="mdui-ripple">
    <i class="mdui-icon material-icons">border_color</i>
    <label>添加留言</label>
  </a>
  
         <?php 
	
	// 首先判断Cookie是否有记住了用户信息
	if (isset($_SESSION['ambadminlogin'])) {
		
	} else {
 ?>
  <a href="#login" class="mdui-ripple">
    <i class="mdui-icon material-icons">assignment_ind</i>
    <label>管理员登录</label>
  </a>
  <?php
  		
	}
	?>


<!----------------------------GET传值的错误代码---------------------------->
  <?php
if(isset($_GET['suc'])){
  $succode = $_GET['suc'];
  switch($succode){
    case '1':
      ?>
      <script>
  mdui.snackbar({
    message: '密码修改成功！请重新登录。',
    position:'top',
    timeout:'4000'
  });
  </script>
  <?php
  break;
  case '2':
    ?>
    <script>
  mdui.snackbar({
  message: '已安全退出登录。',
  position:'top',
  timeout:'4000'
  });
  </script>
  <?php
  break;
  }
  }
?>

<?php
if(isset($_GET['err'])){
  $errcode = $_GET['err'];
  switch($errcode){
    case '1':
      ?>
      <script>
  mdui.snackbar({
    message: '非管理员不得使用此昵称！请重新输入。',
    position:'top',
    timeout:'4000'
  });
  </script>
  <?php
  break;
  case '2':
    ?>
    <script>
  mdui.snackbar({
    message: '密码不能为空！',
    position:'top',
    timeout:'4000'
  });
  </script>
  <?php
  break;
  case '3':
    ?>
    <script>
  mdui.snackbar({
    message: '<?php echo $selfsettingout[4]; ?>秒内只能提交一次留言，请稍后再试。',
    position:'top',
    timeout:'4000'
  });
  </script>
  <?php
  break;
  case '4':
    ?>
    <script>
  mdui.snackbar({
  message: '您还未登录',
  position:'top',
  timeout:'4000'
  });
  </script>
  <?php
  break;
  case '5':
    ?>
    <script>
  mdui.snackbar({
  message: '内容不为空，请重新填写！',
  position:'top',
  timeout:'4000'
  });
  </script>
  <?php
  break;
  }
  }


?>
<!----------------------------GET传值的错误代码---------------------------->



</div>
<!-- 显示留言界面开始 -->
 
<div id="show" class="mdui-p-a-2">
<div id="goTopBtn" style="position:relative;z-index:3">
<button class="mdui-fab mdui-color-theme-accent mdui-ripple mdui-fab-fixed" mdui-tooltip="{content: '返回顶部', position: 'top'}"><i class="mdui-icon material-icons">keyboard_arrow_up</i></button>
</div>
<div style="z-index:2" class="mdui-typo">
<h3>



   <?php
   $messagelistshow = file_get_contents($db1);

    
 
 
          // 获取留言
 
         $info = file_get_contents($db1);
 
         $info = rtrim($info, "@");
 
         if (strlen($info)>=8){
 
          // 拆分留言
           $messagelist = explode("@@@", $info);
 
           foreach ($messagelist as $key => $value) {
           $message = explode("##", $value); 

   if (($message[3] != null)){
    
    
             
       
       
   echo("<div class=\"yuan mdui-card\">");
   //卡片的标题和副标题
   echo("<div class=\"mdui-card-primary\">");
   echo("<div class=\"mdui-card-primary-title\">「" . $message[0] . "」</div>");
   echo("<div class=\"mdui-card-primary-subtitle\">来自 ["  . $message[1] . "]</div>");
   
   if (isset($_SESSION['ambadminlogin'])) {
   
   echo("<div class=\"mdui-card-primary-subtitle\">IP地址 ["  . $message[3] . "]</div>");
  } else {
      
  }
   
   echo("<div class=\"mdui-card-primary-subtitle\">" . $message[4] . "</div>");
   echo"<div class=\"mdui-card-content\"><h3>".$message[2] ."</h3></div>";
   echo("</div>");
   // 卡片的内容
     
     if (isset($_SESSION['ambadminlogin'])) {
   
     echo "<div style=\"float:right\" class=\"mdui-typo\"><a href=\"./delete.php?id={$key}&method=1\"><button class=\"mdui-btn mdui-color-blue-50 mdui-ripple btyuan\" type=\"submit\">删除</button></a></form></div>";
    } else {
      
    }
     echo("</div>");
   echo("<br/>");
 
     
          
			  
			  
		  }
      }
 
    

 

   }
?>
  
  


</h3>

</div>
</div>


<!-- 显示留言界面结束 -->

<div class="mdui-typo">
<?php 
	
	// 首先判断Cookie是否有记住了用户信息
	if (isset($_SESSION['ambadminlogin'])) {
		
	} else {
 ?>
<!-- 登录界面开始 -->

<div id="login" class="mdui-p-a-2">
<div style="max-width: 600px; ">
<div class="yuan mdui-card">
<br>
<center>
  <div style="max-width: 90%; ">
<form action="" method="post" >
		<div class="mdui-textfield mdui-textfield-floating-label">
  <label class="mdui-textfield-label">密码</label>
  <input class="mdui-textfield-input" type="password" name="passwd" maxlength="18" required/>
  <div class="mdui-textfield-error">密码不能为空</div>
</div>

<?php
$adCAPTCHAnum1 = mt_rand(1,20);
$adCAPTCHAnum2 = mt_rand(1,20);

$logincap = $adCAPTCHAnum1 + $adCAPTCHAnum2;


?>


<div class="mdui-textfield mdui-textfield-floating-label">
  <label class="mdui-textfield-label">请输入<?php echo "$adCAPTCHAnum1" ;echo'+';echo"$adCAPTCHAnum2" ?>的值</label>
  <input class="mdui-textfield-input" type="text" name="logincap" maxlength="3" required/>
  <div class="mdui-textfield-error">验证码不能为空</div>
  <input type="hidden" name="logincaptcharesult" value="<?php echo "$logincap"; ?>">
</div>

<button class="mdui-btn mdui-color-blue-50 mdui-ripple btyuan" name="log_in" type="submit">登录</button>
	</form>

<!--<button class="mdui-btn mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">lock_outline</i>使用 WebAuthn 认证</button>

	-->
	
	
  </div>
  </center>
</div>
</div>
</div>

<?php
  		
	}
	?>
<!-- 登录界面结束 -->

<!-- 提交界面开始 -->

<div id="add" class="mdui-p-a-2">
<div class="mdui-typo">
<div style="max-width: 600px; ">
<div style="padding: 20px; " class="mdui-card yuan">
<h4> 发送特殊符号</h4>
<p> 1.换行： [br] <br>
 2.发送链接： [li]网站域名.后缀[nk] <b>(不加请求头)</b><br>
 3.发送html标记符号或其它自动转义。

</p></div><br>
<?php
if(($selfsettingout[8] != null)){

	?>
<div style="padding: 20px; " class="mdui-card yuan">
<h4>“<?php echo "$selfsettingout[1]"; ?>” 使用协议</h4>
<?php 

echo "$selfsettingout[8]";

?>
</div><br>
<?php
  }
?>
<div class="yuan mdui-card">
<br>
<center>
  <div style="max-width: 90%; ">
  
  <form action="" method="post">
		<div class="mdui-textfield mdui-textfield-floating-label">

  <label class="mdui-textfield-label">您的称呼</label>
  <input class="mdui-textfield-input" <?php if (!isset($_SESSION['ambadminlogin'])){ }else{ echo'value="'.$selfsettingout[7].'"'; } ?> {type="text" name="author" maxlength="18"/ required/>
  <div class="mdui-textfield-error">您的名称不能为空</div>
</div>

<div class="mdui-textfield mdui-textfield-floating-label">
  <label class="mdui-textfield-label">标题</label>
  <input class="mdui-textfield-input" type="text" maxlength="26" name="title">

</div>

<div class="mdui-textfield mdui-textfield-floating-label">
  <label class="mdui-textfield-label">留言内容</label>
  <textarea class="mdui-textfield-input" name="content" maxlength="<?php echo "$selfsettingout[3]"; ?>"></textarea>
</div>
<?php
$addCAPTCHAnum1 = mt_rand(1,20);
$addCAPTCHAnum2 = mt_rand(1,20);

$addcaptcharesult = $addCAPTCHAnum1 + $addCAPTCHAnum2;
?>


<div class="mdui-textfield mdui-textfield-floating-label">
  <label class="mdui-textfield-label">请输入<?php echo "$addCAPTCHAnum1" ;echo'+';echo"$addCAPTCHAnum2" ?>的值</label>
  <input class="mdui-textfield-input" type="text" name="addcaptchauser" maxlength="3" required/>
  <div class="mdui-textfield-error">验证码不能为空</div>
  <input type="hidden" name="addcaptcharesult" value="<?php echo "$addcaptcharesult"; ?>">
</div>

<label class="mdui-checkbox">
  <input type="checkbox" value="1" name="secret" />
  <i class="mdui-checkbox-icon"></i>
 发送私信（仅管理员可见）
</label>
<br>
<br>
<button class="mdui-btn mdui-ripple mdui-color-blue-50 btyuan" name="add" type="submit">送信</button>
<button class="mdui-btn mdui-color-theme-accent mdui-ripple btyuan" type="reset">重置</button>
	</form>
  </div>
  </center>
</div>
</div>
</div>
</div>
<!-- 提交界面结束 -->
</div>

<?php include 'footer.php';?>

<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
/*返回顶部*/
$(window).scroll(function(){
   var sc=$(window).scrollTop();
   var rwidth=$(window).width()
   if(sc>0){
    $("#goTopBtn").css("display","block");
    $("#goTopBtn").css("left",(rwidth-36)+"px")
   }else{
   $("#goTopBtn").css("display","none");
   }
 })
 $("#goTopBtn").click(function(){
   var sc=$(window).scrollTop();
   $('body,html').animate({scrollTop:0},500);
 })
   </script>

</body>

</html>