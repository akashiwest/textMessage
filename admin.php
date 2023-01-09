<!--
   项目名称：明石留言板
   版本：V2.2
   时间：2021-9-5
   
   Copyright©2021 | Akashi Tec.
   遵循 CC-BY-NC-SA 4.0版权协议
   
   admin.php
-->
   
 <?php 
	
    require_once( 'header.php'); 
	
    ?>
	 <div class="mdui-drawer" id="main-drawer">
      <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 68px;">
        <div class="mdui-list">
          <a href="./index.php" class="yuan mdui-list-item ">
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
	
	// 首先判断Cookie是否有记住了用户信息
	if (isset($_SESSION['ambadminlogin'])) {
		echo' <a href="./admin.php" class="yuan mdui-list-item mdui-list-item-active"><i class="mdui-list-item-icon mdui-icon material-icons">build</i>&emsp;后台管理';
	} else {
		
	}
 ?>
          </a>
        </div>
       
		
	
    <br>
		


        
      </div>
    </div>
    <br/>
	




    <?php
 
	// 首先判断Cookie是否有记住了用户信息
	
	if (isset($_SESSION['ambadminlogin'])) {
		
	} else {
    $urlerrlog = "./index.php?err=4";  
    echo "<script language='javascript' type='text/javascript'>window.location.href='$urlerrlog'</script>";
		exit();
	}
 ?>
 
 <div class="mdui-typo">


<!----------------------------GET传值的错误代码---------------------------->
<?php
if(isset($_GET['suc'])){
  $succode = $_GET['suc'];
  switch($succode){
    case 'yes':
  ?>
  <script>
mdui.snackbar({
message: '设置已成功应用！',
position:'top',
timeout:'3000'
});
</script>
<?php
break;
case '2':
  ?>
  <script>
mdui.snackbar({
message: '<?php echo $selfsettingout[7];  ?> ，欢迎回来！',
position:'top',
timeout:'3000'
});
</script>
<?php
break;
}
}


if(isset($_GET['err'])){
$errcode = $_GET['err'];
switch($errcode){
  case '1':
    ?>
	  <script>
mdui.snackbar({
  message: '您输入的旧密码不正确，密码更改失败。其它设置已保存。',
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
message: '新密码不能等于旧密码，密码更改失败。其它设置已保存。',
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
message: '发生其它错误，请稍后重试。',
position:'top',
timeout:'3000'
});
</script>
<?php
break;
case '4':
  ?>
  <script>
mdui.snackbar({
message: '管理员密码错误。',
position:'top',
timeout:'3000'
});
</script>
<?php
break;
case '5':
  ?>
  <script>
mdui.snackbar({
message: '文件不能为空，请重试！',
position:'top',
timeout:'3000'
});
</script>
<?php
break;
case '6':
  ?>
  <script>
mdui.snackbar({
message: '文件大小不能超过50Mb，请重试！',
position:'top',
timeout:'3000'
});
</script>
<?php
break;
case '7':
  ?>
  <script>
mdui.snackbar({
message: '文件类型只能为 .txt ，请重试！',
position:'top',
timeout:'3000'
});
</script>
<?php
break;
}
}
?>
<!----------------------------GET传值的错误代码---------------------------->


 <?php
	
	if (empty($_GET['mode'])) {
		
	} else {
		$_SESSION = array();
	session_destroy();
  $url111 = "./index.php?suc=1";  
  echo "<script language='javascript' type='text/javascript'>window.location.href='$url111'</script>";  
  exit();
	}
 ?>
 
 
 <?php  //////////////////////////////////////////////////////////////////////////////安全退出登录
	
	
	if (isset($_POST['logout'])) {
		$_SESSION = array();
	session_destroy();
  $url222 = "./index.php?suc=2";  
  echo "<script language='javascript' type='text/javascript'>window.location.href='$url222'</script>";  
  exit();

	} else {
		
	}
 ?>
 
 <?php  //////////////////////////////////////////////////////////////////////////////还原站点操作
	
	
	if (isset($_POST['allsite_re'])) {
		
		?>
		<br><center><h1>您是否要格式化本站点？</h1><h3>此操作会重置您站点的所有数据，<br>请您清楚此操作所带来的后果。<br>这是最后一个提示。</h3>
		
		<div style="max-width: 66%; ">
<form action="./delete.php" method="post" >
		<div class="mdui-textfield mdui-textfield-floating-label">
  <label class="mdui-textfield-label">输入管理员密码</label>
  <input class="mdui-textfield-input" type="password" name="allsiterepasswd" maxlength="18"/ required/>
  <div class="mdui-textfield-error">密码不能为空</div>
</div>

<button class="mdui-btn mdui-color-red-200 mdui-ripple btyuan" name="allsite_re" type="submit">格式化</button>
<a href="./admin.php">
<button class="mdui-btn mdui-color-blue-50 mdui-ripple btyuan" type="button">取消</button>
</a>
	</form>
	
<!--<button class="mdui-btn mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">lock_outline</i>使用 WebAuthn 认证</button>

	-->
	
	
  </div></center><br><br>
		<?php
	exit();
	}
		?>
 
 <?php  //////////////////////////////////////////////////////////////////////////////还原数据库1操作
	
	if (isset($_POST['data1_re'])) {
	
	$filename = $_FILES['file']['name'];
	//获取文件临时路径
	$temp_name = $_FILES['file']['tmp_name'];
	//获取大小
	if(empty($temp_name)){
		$urlfile = "./admin.php?err=5";  
                 echo "<script language='javascript' type='text/javascript'>window.location.href='$urlfile'</script>"; 
		exit();
	}
	$size = $_FILES['file']['size'];
	//获取文件上传码，0代表文件上传成功
	$error = $_FILES['file']['error'];
	//判断文件大小是否超过设置的最大上传限制
	if ($size > 50*1024*1024){
    $urlfilesize = "./admin.php?err=6";  
    echo "<script language='javascript' type='text/javascript'>window.location.href='$urlfilesize'</script>"; 
exit();
	}
	//phpinfo函数会以数组的形式返回关于文件路径的信息 
	//[dirname]:目录路径[basename]:文件名[extension]:文件后缀名[filename]:不包含后缀的文件名
	$arr = pathinfo($filename);
	//获取文件的后缀名
	$ext_suffix = $arr['extension'];
	//设置允许上传文件的后缀
	$allow_suffix = array('txt');
	//判断上传的文件是否在允许的范围内（后缀）==>白名单判断
	if(!in_array($ext_suffix, $allow_suffix)){
    $urlfiletype = "./admin.php?err=7";  
    echo "<script language='javascript' type='text/javascript'>window.location.href='$urlfiletype'</script>"; 
exit();
	}
	
	$new_filename = $db1name.'.'.$ext_suffix;
	//将文件从临时路径移动到磁盘
	if (move_uploaded_file($temp_name, './database/'.$new_filename)){
    $urlre1 = "./admin.php?suc=yes";  
    echo "<script language='javascript' type='text/javascript'>window.location.href='$urlre1'</script>";  
    exit();
  	}else{
		exit("<br><center><h1>文件上传失败！错误码 $error</h1></center><br><br>");
		}
	} else {
		
	}
 ?>
 
 <?php  //////////////////////////////////////////////////////////////////////////////还原数据库2操作

	if (isset($_POST['data2_re'])) {
	
    $filename = $_FILES['file']['name'];
    //获取文件临时路径
    $temp_name = $_FILES['file']['tmp_name'];
    //获取大小
    if(empty($temp_name)){
      $urlfile = "./admin.php?err=5";  
                   echo "<script language='javascript' type='text/javascript'>window.location.href='$urlfile'</script>"; 
      exit();
    }
    $size = $_FILES['file']['size'];
    //获取文件上传码，0代表文件上传成功
    $error = $_FILES['file']['error'];
    //判断文件大小是否超过设置的最大上传限制
    if ($size > 50*1024*1024){
      $urlfilesize = "./admin.php?err=6";  
      echo "<script language='javascript' type='text/javascript'>window.location.href='$urlfilesize'</script>"; 
  exit();
    }
    //phpinfo函数会以数组的形式返回关于文件路径的信息 
    //[dirname]:目录路径[basename]:文件名[extension]:文件后缀名[filename]:不包含后缀的文件名
    $arr = pathinfo($filename);
    //获取文件的后缀名
    $ext_suffix = $arr['extension'];
    //设置允许上传文件的后缀
    $allow_suffix = array('txt');
    //判断上传的文件是否在允许的范围内（后缀）==>白名单判断
    if(!in_array($ext_suffix, $allow_suffix)){
      $urlfiletype = "./admin.php?err=7";  
      echo "<script language='javascript' type='text/javascript'>window.location.href='$urlfiletype'</script>"; 
  exit();
    }
    
    $new_filename = $db2name.'.'.$ext_suffix;
    //将文件从临时路径移动到磁盘
    if (move_uploaded_file($temp_name, './database/'.$new_filename)){
      $urlre1 = "./admin.php?suc=yes";  
      echo "<script language='javascript' type='text/javascript'>window.location.href='$urlre1'</script>";  
      exit();
      }else{
      exit("<br><center><h1>文件上传失败！错误码 $error</h1></center><br><br>");
      }
    } else {
      
    }
 ?>
 
 
 </div>


<div class="mdui-tab" mdui-tab>
  
  
  <a href="#info&action" class="mdui-ripple mdui-ripple-white">
    <i class="mdui-icon material-icons">folder_shared</i>
    <label>私信列表</label>
  </a>

  
  <a href="#selfchange" class="mdui-ripple mdui-ripple-white">
  <i class="mdui-icon material-icons">color_lens</i>
    <label>自定义</label>
  </a>
  <a href="#badword_and_action" class="mdui-ripple mdui-ripple-white">
    <i class="mdui-icon material-icons">business_center</i>
    <label>高级设置</label>
  </a>
  <a href="#fuction" class="mdui-ripple mdui-ripple-white">
    <i class="mdui-icon material-icons">info</i>
    <label>更多功能</label>
  </a>
</div>


<!--  编辑视图  -->
<div id="info&action" class="mdui-p-a-2">
<div id="goTopBtn" style="position:relative;z-index:3">
<button class="mdui-fab mdui-color-theme-accent mdui-ripple mdui-fab-fixed" mdui-tooltip="{content: '返回顶部', position: 'top'}"><i class="mdui-icon material-icons">keyboard_arrow_up</i></button>
</div>
<div class="mdui-typo">
<?php


   $messagelistshow = file_get_contents($db2);
    // 获取留言

    $info = file_get_contents($db2);

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
  echo("<div class=\"mdui-card-primary-subtitle\">IP地址 ["  . $message[3] . "]</div>");
  echo("<div class=\"mdui-card-primary-subtitle\">" . $message[4] . "</div>");
  echo"<div class=\"mdui-card-content\" ><h3>".$message[2] ."</h3></div>";
  echo("</div>");
  // 卡片的内容
    
  echo "<div style=\"float:right\" class=\"mdui-typo\"><a href=\"./delete.php?id={$key}&method=2\"><button class=\"mdui-btn mdui-color-blue-50 mdui-ripple btyuan\" type=\"submit\">删除</button></a></form></div>";
  echo("</div>");
  echo("<br/>");

		
         }
     }
    }else{
     
    }

?>

	
</div>
</div>



<div id="selfchange" class="mdui-p-a-2">

<div style="max-width: 600px; ">



<form action="./database/selfsetting/selfsetting.php" method="post">

<div class="mdui-panel" mdui-panel>
      <div class="yuan mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">外观设置</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
    <div class="mdui-textfield">
  <label class="mdui-textfield-label">站点主题色(填MDUI颜色名)</label>
    <textarea class="mdui-textfield-input" rows="1" name="themecolor">
<?php 

echo "$selfsettingout[0]";

?>
</textarea>
</div>
<div class="mdui-textfield">
  <label class="mdui-textfield-label">站点名称(建议十个字以内)</label>
    <textarea class="mdui-textfield-input" rows="1" name="changewebname">
<?php 

echo "$selfsettingout[1]";

?>
</textarea>
</div>
<div class="mdui-textfield">
  <label class="mdui-textfield-label">站点图标(填入一个图片链接)</label>
<textarea class="mdui-textfield-input" name="changewebsign">
<?php 

echo "$selfsettingout[2]";

?>
</textarea>
</div>
<br>
<label class="mdui-checkbox">
  <input type="checkbox" value="1" name="checkbox_select" 
  <?php
  if(($selfsettingout[5] != 1)){
	  
  }else{
	  echo 'checked';
  }
  ?>/>
  <i class="mdui-checkbox-icon"></i>
 隐藏“关于”界面的入口
</label>
    
    

    </div>
  </div>
  </div>


  <div class="mdui-panel " mdui-panel>
      <div class="yuan mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">留言设置</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
    
<div class="mdui-textfield">
  <label class="mdui-textfield-label">限制留言最大字数</label>
    <textarea class="mdui-textfield-input" rows="1" name="set-maxlength" oninput = "value=value.replace(/[^\d]/g,'')">
<?php 

echo "$selfsettingout[3]";

?>
</textarea>
</div>
<div class="mdui-textfield">
  <label class="mdui-textfield-label">限制发送留言间隔时间（单位：秒）</label>
    <textarea class="mdui-textfield-input" rows="1" name="submittime" oninput = "value=value.replace(/[^\d]/g,'')">
<?php 

echo "$selfsettingout[4]";

?>
</textarea>
</div>
<div class="mdui-textfield">
  <label class="mdui-textfield-label">设置发表留言前的确认协议内容。<br>：换行。如不填则不开启此功能。</label>
    <textarea class="mdui-textfield-input" rows="6" name="mustknow">
<?php 

echo "$selfsettingout[8]";

?>
</textarea>
</div>
    </div>
  </div>
  </div>



  <div class="mdui-panel " mdui-panel>
      <div class="yuan mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">个人设置</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
    <div class="mdui-textfield">
  <label class="mdui-textfield-label">您的昵称(只有您可以使用此发表评论)</label>
    <textarea class="mdui-textfield-input" rows="1" name="adminname">
<?php 

echo "$selfsettingout[7]";

?>
</textarea>
</div>
<br>
<div class="mdui-panel" mdui-panel>
      <div class="yuan mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">修改密码</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
   
  <label class="mdui-textfield-label">输入旧密码</label>
    <textarea class="mdui-textfield-input" rows="1" maxlength="18" name="getoldpasswd"></textarea>

<br>
  <label class="mdui-textfield-label">输入新密码</label>
    <textarea class="mdui-textfield-input" rows="1" maxlength="18" name="newpasswd"></textarea>
</div>

    </div>
  </div>
  </div>

    </div>
  </div>
  </div>

  




<br>
        <button class="mdui-btn mdui-color-blue-50 mdui-ripple btyuan" type="submit">保存修改</button>

</form>
  </div>

 </div>

<div id="badword_and_action" class="mdui-p-a-2">
<div style="max-width: 600px; ">



<div class="mdui-panel " mdui-panel>
      <div class="yuan mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">数据设置</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
    <div class="mdui-panel-item-body">

<div class="mdui-panel " mdui-panel>
      <div class="yuan mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">备份数据</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
   <div class="mdui-typo">
   <a href="<?php echo $db1; ?>" download="Amb_<?php $time = date('Ymd-Hi'); echo $time; ?>_数据库1.txt">下载 数据库1（公开留言数据库）</a>
  
<br><br>
   <a href="<?php echo $db2; ?>" download="Amb_<?php $time = date('Ymd-Hi'); echo $time; ?>_数据库2.txt">下载 数据库2（私信数据库）</a>
  
  </div>
</div>

    </div>
  </div>
  
  <div class="mdui-panel" mdui-panel>
      <div class="yuan mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">还原数据</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
   <div class="mdui-typo">
   
  <form action="./admin.php" method="post" enctype="multipart/form-data">
		<input type="file" name="file"><br><br>

  <div class="mdui-panel-item-actions">
    
    <button class="mdui-btn mdui-color-theme-accent mdui-ripple btyuan" type="button" mdui-dialog="{target: '#data1'}">还原数据库1</button>
	<button class="mdui-btn mdui-color-theme-accent mdui-ripple btyuan" type="button" mdui-dialog="{target: '#data2'}">还原数据库2</button>
	
	
	<div class="mdui-dialog yuan" id="data1">
	<div class="mdui-dialog-title">还原 数据库1 注意事项</div>
  <div class="mdui-dialog-content">
  
  <p align="left">
  <br>
  <b>请确认您要进行操作的数据库是 数据库1（公开留言数据库）！
  </b><br><br>
  <b>还原后您的现有数据将会被覆盖，请谨慎操作！</b><br><br>
  <b>由于不遵守以上两点而产生的所有不良后果，本软件作者不承担任何责任。</b><br>
  </p>
  </div>
  <div class="mdui-dialog-actions">

  <button class="mdui-btn mdui-ripple mdui-color-blue-50 btyuan" type="button" mdui-dialog-close>取消</button>
   <button class="mdui-btn mdui-ripple mdui-color-red-200 btyuan" name="data1_re" type="submit">已了解，开始还原</button>
 <br> <br>
  </div>
  </div>
  
  <div class="mdui-dialog yuan" id="data2">
	<div class="mdui-dialog-title">还原 数据库2 注意事项</div>
  <div class="mdui-dialog-content">
  
  <p align="left">
  <br>
  <b>请确认您要进行操作的数据库是 数据库2（私信数据库）！
  </b><br><br>
  <b>还原后您的现有数据将会被覆盖，请谨慎操作！</b><br><br>
  <b>由于不遵守以上两点而产生的所有不良后果，本软件作者不承担任何责任。</b><br>
  </p>
  </div>
  <div class="mdui-dialog-actions">
  <button class="mdui-btn mdui-ripple mdui-color-blue-50 btyuan" type="button" mdui-dialog-close>取消</button>
   <button class="mdui-btn mdui-ripple mdui-color-red-200 btyuan" name="data2_re" type="submit">已了解，开始还原</button>
   <br> <br>
  </div>
  </div>
	
    </form>

  </div>
</div>

    </div>
  </div>
  
  </div>
  
  <div class="mdui-panel " mdui-panel>
      <div class="yuan mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">格式化站点</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
   <div class="mdui-typo">
  <form action="./admin.php" method="post">
 <br>
  <button class="mdui-btn mdui-color-red-200 mdui-ripple btyuan" type="button" mdui-dialog="{target: '#data3'}">格式化所有数据</button>
  
  
  <div class="mdui-dialog yuan" id="data3">
	<div class="mdui-dialog-title">警告！你正在进行格式化站点操作！</div>
  <div class="mdui-dialog-content">
  
  <p align="left">
  <br>
  
  <b>如果是误操作请单击取消以退出！
  </b><br><br>
  <b>你正在进行格式化站点数据操作！</b><br><br>
  <b>此操作会导致您的站点所有信息被重置，并进入到初始安装模式！</b><br>
  </p>
  </div>
  <div class="mdui-dialog-actions">
  <button class="mdui-btn mdui-ripple mdui-color-blue-50 btyuan" type="button" mdui-dialog-close>取消</button>
   <button class="mdui-btn mdui-ripple mdui-color-red-200 btyuan" name="allsite_re" type="submit">仍要格式化</button>
   <br> <br>
  </div>
  </div>
  </form>
  </div>
</div>

    </div>
  </div>
  
  
    </div>
  </div>
 

<div class="mdui-panel " mdui-panel>

<div class="yuan mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">禁止留言</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
	PS.一行只输入一个IP，空一行再输入下一个IP。
	<br>
	请在第一排单独输入“BEGIN”
    
    <form action="./database/ban/bandata.php" method="post">

    <textarea class="mdui-textfield-input" rows="10" name="add-modifybandat">
<?php 

$pathaddban='./database/ban/addban.dat'; //禁止提交留言小黑屋dat文件的路径
readfile($pathaddban); 

?>
</textarea>

      <div class="mdui-panel-item-actions">
       
        <button class="mdui-btn mdui-color-blue-50 mdui-ripple btyuan" name="addban" type="submit">保存修改</button>
        </form>
      </div>
    </div>
  </div>
<div class="yuan mdui-panel-item " mdui-panel>
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">全站封禁</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
    <div class="mdui-panel-item-body">
   PS.一行只输入一个IP，空一行再输入下一个IP。
   <br>
	请在第一排单独输入“BEGIN”
	
    <form action="./database/ban/bandata.php" method="post">

<textarea class="mdui-textfield-input" rows="10" name="all-modifybandat">
<?php 

$pathban='./database/ban/ban.dat'; //全站封禁小黑屋dat文件的路径
readfile($pathban); 

?>
</textarea>

  <div class="mdui-panel-item-actions">
    
    <button class="mdui-btn mdui-color-blue-50 mdui-ripple btyuan" name="siteban" type="submit">保存修改</button>
    </form>
      </div>
    </div>
  </div>
  
  
  
  
  </div>
  
<br>

</div>

</div>

</div>


<div id="fuction" class="mdui-p-a-2">
<center>
<div class="mdui-typo">
<form action="" method="post">
<h2>安全退出
<div class="mdui-chip">

  <button class="mdui-btn mdui-color-blue-50 mdui-ripple icobtyuan" type="submit" name="logout">
 <i class="mdui-icon material-icons">exit_to_app</i>
  </button> 
</div>
</h2>
</form>

<h2>反馈问题
<div class="mdui-chip">
<form action="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=eBkTGQsQEQgZChM4HhcAFRkRFFYbFxU" method="post">
  <button class="mdui-btn mdui-color-blue-50 mdui-ripple icobtyuan">
 <i class="mdui-icon material-icons">bug_report</i>
  </button>
  </form>
</div>
</h2>

<h2>检查更新
<div class="mdui-chip">
<button class="mdui-btn mdui-ripple mdui-color-blue-50 icobtyuan" mdui-dialog="{target: '#version'}">
<i class="mdui-icon material-icons">autorenew</i>
</button>
</div>
</h2>


	<div class="mdui-dialog yuan" id="version">
	<div class="mdui-dialog-title">版本[V2.2] 软件更新须知</div>
  <div class="mdui-dialog-content">
  
  <p align="left">
  <b>Copyright&copy;<?php echo date("Y"); ?> Akashi | blog.imakashi.top</b><br>
  <br>
  <b>1.请您务必通过备份功能备份好您的留言数据文件。更新后需要您重新填写一些站点设置信息。如果您封禁过使用者IP，请备份好 database/ban 文件夹内的两个 .dat 文件，待更新完毕后进行替换。
  </b><br><br>
  <b>2.本程序为个人开发且免费公布源代码，有一些小瑕疵在所难免，请勿在包括但不限于高并发率、正式的、商业的情景下公开使用本程序。</b><br><br>
  <b>由于不遵守以上两点而产生的所有不良后果，本软件作者不承担任何责任。</b><br>
  </p>
  </div>
  <div class="mdui-dialog-actions">
  <a href="https://blog.imakashi.top/amb_downloadsoftware.html" target=_blank>
   <button class="mdui-btn mdui-ripple btyuan">我已了解并同意以上内容</button>
   </a>
    <br> <br>
  </div>
  </div>
  


<h2>程序声明
<div class="mdui-chip">
<button class="mdui-btn mdui-ripple mdui-color-blue-50 icobtyuan" mdui-dialog="{target: '#copyrightinfo'}">
<i class="mdui-icon material-icons">copyright</i>
</button>
</div>
</h2>


	<div class="mdui-dialog yuan" id="copyrightinfo">
	<div class="mdui-dialog-title">明石留言板[2.2] 程序声明</div>
  <div class="mdui-dialog-content">
  
  <p align="left">
  <b>Copyright&copy;<?php echo date("Y"); ?> Akashi | blog.imakashi.top</b><br>
  <br>
  <b>明石/Akashi/AKASHI Tec./blog.imakashi.top 对此程序享有著作权。</b><br><br>
  <b>1.你可以在遵循 CC BY-NC-SA 4.0 版权协议的前提下使用或传播本程序。你可以进行基于本程序的非商业性自由创作，你需要至少保留底部原作者版权信息，这样您才能使用这款程序。</b><br>
  <b>2.禁止使用本程序或本程序衍生程序进行商业性活动；禁止使用本程序或本程序衍生程序进行违法活动。由于不当使用本程序或本程序衍生程序而产生的一切后果，由使用者承担。</b><br>
  <b>3.请您不要移除底部的版权标识，作者也是尽量把版权标识弄得不太起眼，以免妨碍您的使用。互相理解吧！</b><br><br>
  <b>4.最终解释权归明石所有。</b><br><br>
  <b>最后，感谢您使用本程序，祝您使用愉快。</b><br>
  <br>
  此版本修订日期：2021年9月04日。
  </p>
  </div>
  <div class="mdui-dialog-actions">
   <button class="mdui-btn mdui-ripple btyuan" mdui-dialog-close>我已了解以上内容</button>
   <br> <br>
  </div>
  </div>
  </div>
</center>
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