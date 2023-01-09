<!--
   项目名称：明石留言板
   版本：V2.2
   时间：2021-9-5
   
   Copyright©2021 | Akashi Tec.
   遵循 CC-BY-NC-SA 4.0版权协议
   
   bandata.php
-->


<?php

header('Content-type:text/html; charset=utf-8');
session_start();

?>

<?php

error_reporting(0);/////////关掉错误提示

// 获取设置信息
// selfsetting.dat
$infoselfsetting = file_get_contents("../selfsetting/selfsetting.dat");

$infoselfsetting = rtrim($infoselfsetting, "@");

if (strlen($infoselfsetting)>=8){

// 拆分留言信息
$selfsettinglist = explode("@@@", $infoselfsetting);

foreach ($selfsettinglist as $key => $value) {
    $selfsettingout = explode("##", $value); 
      }
  }
?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <title>站点设置</title>
  <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/mdui/1.0.1/css/mdui.min.css">
  <script src="https://cdn.bootcdn.net/ajax/libs/mdui/1.0.1/js/mdui.min.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo "$selfsettingout[2]"; ?>" media="screen" />

  <style>
    a {
      text-decoration:none
    }
    a:hover {
      text-decoration:none
    }
  </style>

<style>  

.lightmode {  
  background:url(../../assets/background1.jpg); 
  
} 
.darkmode {  
  background:url(../../assets/background.jpg); 
  
} 


</style>

<!--[if lt IE 9]>
<style>.alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px } .alert-danger { background-color: #f2dede; border-color: #ebccd1; color: #a94442; border-bottom: 1px solid #ebccd1 } .alert-link { color: #843534; font-weight: bold } .topframe { margin: 0; padding-left: 15px; padding-right: 15px; text-align: center; border-radius: 0; position: fixed; left: 0; right: 0; top: 0; z-index: 1000 }
</style><div class="alert alert-danger topframe"><br><h1>本站点不支持IE9及以下浏览器访问</h1><br><h3>不会吧不会吧，都1202年啦，还在人在用 不安全、访问又慢的IE浏览器？？</h3><a class="alert-link" target="_blank" href="https://browsehappy.com">立即升级</a><br><br><br><br><br><br><br><br><br><br><br><br><br><br><h2>你还想继续用这个浏览器访问？</h2><br><h3>不好意思，没做适配，就这样的烂摊子看你愿意用不</h3></div><script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script><script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script><![endif]-->

</head>
<header class="mdui-appbar mdui-appbar-fixed ">
  <body class="mdui-theme-layout-<?php if($_COOKIE['dnmode'] != 1){ echo 'light lightmode'; }else{ echo 'dark darkmode'; } ?> mdui-drawer-body-left mdui-appbar-with-toolbar mdui-theme-primary-<?php if($_COOKIE['dnmode'] != 1){ echo $selfsettingout[0]; }else{ echo 'light-blue'; } ?>">
   
  <?php   //IP黑白名单检测
$ip=$_SERVER["REMOTE_ADDR"];

$ban = file_get_contents("./ban.dat");

if(stripos($ban,$ip))
{
exit("<br><br><center><h1>你的IP地址 [$ip] 已被拉黑，禁止访问本网站。</h1><h2>如果你有任何疑问，请联系网站管理者。</h2></center><br><br>");
}
?>


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

if (isset($_POST['siteban'])) {
	
  $loadbandat1 = fopen("ban.dat", "w");
  $modifybandat = $_POST['all-modifybandat'];
  fwrite($loadbandat1, "$modifybandat");
  fclose($loadbandat1);

  $url1 = "../../admin.php?suc=yes";  
               echo "<script language='javascript' type='text/javascript'>window.location.href='$url1'</script>";  
        
    exit();

}elseif(isset($_POST['addban'])){

   $loadbandat = fopen("addban.dat", "w");
   $modifybandat = $_POST['add-modifybandat'];
   fwrite($loadbandat, "$modifybandat");
   fclose($loadbandat);
 
   $url2 = "../../admin.php?suc=yes";  
               echo "<script language='javascript' type='text/javascript'>window.location.href='$url2'</script>";  
        
    exit();


}else{
  $url3 = "../../admin.php?err=3";  
  echo "<script language='javascript' type='text/javascript'>window.location.href='$url3'</script>";  
  exit();
}
?>
 
