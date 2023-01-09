<!--
   项目名称：明石留言板
   版本：V2.2
   时间：2021-9-5
   
   Copyright©2021 | Akashi Tec.
   遵循 CC-BY-NC-SA 4.0版权协议
   
   header.php
-->

<?php
ob_start();
?>

<?php

header('Content-type:text/html;');
session_start();

?>

<?php 

if (!file_exists("./database/installlock.amb")) {
    $installurl = "./install.php";         
    exit("<script language='javascript' type='text/javascript'>window.location.href='$installurl'</script>");
}

?>

<?php 
  error_reporting(0);////////////////关掉错误提示

  include('./database/dbinfo.php');
  include('./database/logininfo.php');
?> 

<?php
// 获取设置信息
// selfsetting.dat
$infoselfsetting = file_get_contents("./database/selfsetting/selfsetting.dat");
$infoselfsetting = rtrim($infoselfsetting, "@");

if (strlen($infoselfsetting)>=8){
$selfsettinglist = explode("@@@", $infoselfsetting);
foreach ($selfsettinglist as $key => $value) {
    $selfsettingout = explode("##", $value); 
      }
  }

  //给开发者的注释
  
  //$selfsettingout[6] NULL(For your idea:) --Form Akashi)
  
  //$selfsettingout[8] 是自定义“使用条款”内容
  //$selfsettingout[7] 是管理者姓名
  //$selfsettingout[5] 是判断是否隐藏关于界面
  //$selfsettingout[4] 是留言间隔时间
  //$selfsettingout[3] 是最大留言字数
  //$selfsettingout[2] 是网站ICON
  //$selfsettingout[1] 是网站名称
  //$selfsettingout[0] 是网站主题色

  $selfsettingout[0] = htmlspecialchars($selfsettingout[0]);
  $selfsettingout[1] = htmlspecialchars($selfsettingout[1]);
  $selfsettingout[2] = htmlspecialchars($selfsettingout[2]);
  $selfsettingout[3] = htmlspecialchars($selfsettingout[3]);
  $selfsettingout[4] = htmlspecialchars($selfsettingout[4]);
  $selfsettingout[5] = htmlspecialchars($selfsettingout[5]);
  $selfsettingout[7] = htmlspecialchars($selfsettingout[7]);
?>

<html lang="zh-CN">
<head>
  <meta charset="utf8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <title><?php echo $selfsettingout[1]; ?></title>
  <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/mdui/1.0.1/css/mdui.min.css">
  <script src="https://cdn.bootcdn.net/ajax/libs/mdui/1.0.1/js/mdui.min.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo "$selfsettingout[2]"; ?>" media="screen" />
<style>  
.lightmode {  
  background:url(./assets/background1.jpg); 
  
} 
.darkmode {  
  background:url(./assets/background.jpg); 
  
} 
.yuan{  
    border-radius:15px;
    padding:10px; 

}
.btyuan {
    vertical-align:middle;
    text-align:center;
    line-height:18px;
    border-radius:10px;
    padding:10px; 

}
.icobtyuan {
    vertical-align:middle;
    text-align:center;
    line-height:18px;
    border-radius:10px;
    padding:0px; 

}
</style>

<!--[if lt IE 9]>
<style>.alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px } .alert-danger { background-color: #f2dede; border-color: #ebccd1; color: #a94442; border-bottom: 1px solid #ebccd1 } .alert-link { color: #843534; font-weight: bold } .topframe { margin: 0; padding-left: 15px; padding-right: 15px; text-align: center; border-radius: 0; position: fixed; left: 0; right: 0; top: 0; z-index: 1000 }
</style><div class="alert alert-danger topframe"><br><h1>本站点不支持IE9及以下浏览器访问</h1><br><h3>不会吧不会吧，都1202年啦，还在人在用 不安全、访问又慢的IE浏览器？？</h3><a class="alert-link" target="_blank" href="https://browsehappy.com">立即升级</a><br><br><br><br><br><br><br><br><br><br><br><br><br><br><h2>你还想继续用这个浏览器访问？</h2><br><h3>不好意思，没做适配，就这样的烂摊子看你愿意用不</h3></div><script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script><script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script><![endif]-->

</head>
<header class="mdui-appbar mdui-appbar-fixed ">
  <body class="mdui-theme-layout-<?php if($_COOKIE['dnmode'] != 1){ echo 'light lightmode'; }else{ echo 'dark darkmode'; } ?> mdui-drawer-body-left mdui-appbar-with-toolbar mdui-theme-primary-<?php if($_COOKIE['dnmode'] != 1){ echo $selfsettingout[0]; }else{ echo 'light-blue'; } ?>">
  <div class="mdui-typo">
  <?php   //IP黑白名单检测
$ip=$_SERVER["REMOTE_ADDR"];

$ban = file_get_contents("./database/ban/ban.dat");

if(stripos($ban,$ip))
{
exit("<br><br><center><div class=\"mdui-typo\"><h1>你的IP地址 [$ip] 已被拉黑，禁止访问本网站。</h1><h2>如果你有任何疑问，请联系网站管理者。</h2></div></center><br><br>");
}
?>

</div>
	
	
   
    <div class="mdui-toolbar mdui-color-theme">
      <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer'}">
        <i class="mdui-icon material-icons">menu</i>
      </span>
      <a href="" class="mdui-typo-title"><?php echo "$selfsettingout[1]"; ?></a>
	  
    <div class="mdui-toolbar-spacer"></div>


    <?php
	


     if($_COOKIE['dnmode'] != 1){ 
       
      echo '<form action="./database/selfsetting/selfsetting.php" method="post"><button class="mdui-btn mdui-btn-icon" mdui-tooltip="{content: \'深色模式\'}" name="dayornight" value="1"><i class="mdui-icon material-icons">brightness_4</i></button></form>';
       
       }else{ 
         
       echo'<form action="./database/selfsetting/selfsetting.php" method="post"><button class="mdui-btn mdui-btn-icon" mdui-tooltip="{content: \'浅色模式\'}" name="dayornight" value="2"><i class="mdui-icon material-icons">brightness_5</i></button></form>';
          } 
		  
	
	?>
    


    
    </div>





  </div>
    </header>
   
