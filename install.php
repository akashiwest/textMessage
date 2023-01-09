<!--
   项目名称：明石留言板
   版本：V2.2
   时间：2021-9-5
   
   Copyright©2021 | Akashi Tec.
   遵循 CC-BY-NC-SA 4.0版权协议
   
   install.php
-->


<html lang="zh-CN">
<title>明石软件安装系统</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/mdui/1.0.1/css/mdui.min.css">
  <script src="https://cdn.bootcdn.net/ajax/libs/mdui/1.0.1/js/mdui.min.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="https://pic.sevesum.com/2021/02/10/ac8f5736e9eb2.png" media="screen">
<style>
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
</style>
<body background="./assets/background1.jpg" class="mdui-theme-layout-light mdui-theme-primary-light-blue mdui-theme-accent-blue">
  
  <br />
  <div class="mdui-typo">
  <center><h2 style="color:CornflowerBlue">明石留言板自动安装界面</h2></center>
  <br>
  <?php
  error_reporting(0);/////////关掉错误提示
  
  $lockfile = "./database/installlock.amb";//检测安装锁文件
  if (file_exists($lockfile)) {
    exit("<center><h2>-错误信息-<br></h2><h3>您已经安装过了<br><br></center></h3>");
  }
  if (!isset($_POST['submit'])) { ////////////////////////提交前操作
    ?>
	
	<center>
	<div style="max-width: 800px; ">
	
	
	<?php //检测PHP环境

if ((version_compare(PHP_VERSION, '5.6.9') < 0)) {
  $versionwarn = '与此程序不兼容。<br>本程序兼容最低PHP版本为5.6.9。';
  $versionmode = 'no';
}elseif((version_compare(PHP_VERSION, '5.6.9') >= 0)){
  $versionwarn = '与此程序兼容。';
  $versionmode = 'yes';
}

?>
	
	<?php //检测服务器目录是否可写

$testfilename = './database/selfsetting/selfsetting.dat';
if (is_writable($testfilename)) {
  $versionwarn1 = '服务器目录可写。';
  $versionmode1 = 'yes';
} else {
  $versionwarn1 = '服务器目录不可写。无法进行安装。<br>请先检查您的服务器目录是否开启可写。';
  $versionmode1 = 'no';
}

?>

<div class="mdui-tab" mdui-tab>
  <a href="#situationdata" class="mdui-ripple">
    <i class="mdui-icon material-icons">all_inclusive</i>
    <label>检测信息</label>
  </a>
  <a href="#view-set" class="mdui-ripple" <?php if ($versionmode1 == 'no' || $versionmode == 'no'){ echo 'disabled';} ?>>
    <i class="mdui-icon material-icons">favorite</i>
    <label>外观设置</label>
  </a>
  <a href="#message-set" class="mdui-ripple" <?php if ($versionmode1 == 'no' || $versionmode == 'no'){ echo 'disabled';} ?>>
    <i class="mdui-icon material-icons">message</i>
    <label>留言设置</label>
  </a>
  <a href="#data-set" class="mdui-ripple" <?php if ($versionmode1 == 'no' || $versionmode == 'no'){ echo 'disabled';} ?>>
    <i class="mdui-icon material-icons">data_usage</i>
    <label>数据设置</label>
  </a>
  <a href="#copyright" class="mdui-ripple" <?php if ($versionmode1 == 'no' || $versionmode == 'no'){ echo 'disabled';} ?>>
    <i class="mdui-icon material-icons">assignment_turned_in</i>
    <label>使用协议</label>
  </a>
</div>



<div id="situationdata" class="mdui-p-a-2">

<div class="mdui-panel" mdui-panel>
      <div class="yuan mdui-panel-item mdui-panel-item-open">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">检测信息</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
    





    <div class="mdui-chip">
  <span class="mdui-chip-icon mdui-color-<?php if($versionmode == 'yes'){ echo 'green-300'; }else{ echo 'red-300'; } ?>"><i class="mdui-icon material-icons">memory</i></span>
  <span class="mdui-chip-title">服务器PHP版本</span>
</div><br>
您的PHP版本为<?php echo phpversion(); echo "，$versionwarn"; ?>
    <br>
    <br>
<div class="mdui-chip">
  <span class="mdui-chip-icon mdui-color-<?php if($versionmode1 == 'yes'){ echo 'green-300'; }else{ echo 'red-300'; } ?>"><i class="mdui-icon material-icons"><?php if($versionmode1 == 'yes'){ echo 'edit'; }else{ echo 'edit'; } ?></i></span>
  <span class="mdui-chip-title">服务器可写权限</span>
</div><br><?php echo "$versionwarn1"; ?>
<?php 
if($versionmode1 == 'no' || $versionmode == 'no'){
	echo '<br><br><b>安装进程暂时停止</b><br>问题排查完毕后请刷新本页面。';
}else{
	echo '<br><br><b>开始安装吧~</b>';
}
?>
      </div>
    </div>
	
  </div>
  </div>




<div id="view-set" class="mdui-p-a-2">


    <form action="" method="post" enctype="multipart/form-data">

    <div class="mdui-panel" mdui-panel>
      <div class="yuan mdui-panel-item mdui-panel-item-open">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">外观设置</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">站点名称</label>
        <input name="changewebname" type="text" maxlength="18" class="mdui-textfield-input" />
      </div>
      <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">站点图标（选填）</label>
        <input name="changewebsign" type="text" class="mdui-textfield-input" />
      </div>
      <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">站点主题色（选填）</label>
        <input name="themecolor" type="text" maxlength="10" class="mdui-textfield-input" />
      </div>
    
    

    </div>
  </div>
  </div>
  <br>
<div class="mdui-panel" mdui-panel>
      <div class="yuan mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">安装帮助</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
    <div class="mdui-typo">
    <h3 align="left">
外观设置
  </h3>
  <p align="left">
站点名称：设置站点的名称，建议不要超过十个字。您可在安装完毕后登录后台进行更改。
  </p>
  <p align="left">
站点图标：选填。设置网站的图标。请输入一个路径，例如：“./img.ico” 或 “http://a.cn/img.png”。您可在安装完毕后登录后台进行更改。
  </p>
  <p align="left">
站点主题色：选填。请参照 <a href="https://www.mdui.org/docs/color#color-primary" target="_blank">MDUI文档</a> 只填入颜色名。例如：“light-blue” 或 “grey” ，两个单词间须有 “-” 作连接。不填默认为透明色。您可在安装完毕后登录后台进行更改。
  </p>
  </div>

    </div>
  </div>
  </div>
</div>



<div id="message-set" class="mdui-p-a-2">

 <div class="mdui-panel" mdui-panel>
      <div class="yuan mdui-panel-item mdui-panel-item-open">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">留言设置</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">留言最大字数(默认为200)</label>
        <input name="set-maxlength" type="text" value="200" class="mdui-textfield-input" oninput = "value=value.replace(/[^\d]/g,'')"/>
      </div>
	  <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">您的昵称（选填）</label>
        <input name="adminname" type="text" class="mdui-textfield-input" />
      </div>
	  <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">限制留言间隔时间（单位：秒）</label>
        <input name="submittime" type="text" class="mdui-textfield-input" oninput = "value=value.replace(/[^\d]/g,'')"/>
      </div>

    
    </div>
  </div>
  </div>
  <br>
<div class="mdui-panel" mdui-panel>
      <div class="yuan mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">安装帮助</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
    <div class="mdui-typo">
<h3 align="left">
留言设置
  </h3>
  <p align="left">
留言最大字数：填写一个阿拉伯数字以设置留言最大提交字数。例如：如果你想限制最大提交字数为30个汉字，请输入30。您可在安装完毕后登录后台进行更改。
  </p>
  <p align="left">
管理员昵称：选填。输入你的昵称。只有处于登录状态时才能使用此名称发表留言。如不填，系统默认设置为 “管理员” 和 “admin” 。您可在安装完毕后登录后台进行更改。
  </p>
  <p align="left">
限制留言间隔时间：输入一个数字以限制相同用户提交两次留言的时间间隔，单位(秒)。您可在安装完毕后登录后台进行更改。
  </p>
  </div>

    </div>
  </div>
  </div>
</div>



<div id="data-set" class="mdui-p-a-2">

<div class="mdui-panel" mdui-panel>
      <div class="yuan mdui-panel-item mdui-panel-item-open">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">数据设置</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
   
	
    <div class="mdui-panel-item-body">
    <P>提示：建议您在填写此部分前先浏览安装帮助。</P>
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">设置数据库1的密码</label>
        <input name="db1" type="text" maxlength="18" class="mdui-textfield-input" />
      </div>
      <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">设置数据库2的密码</label>
        <input name="db2" type="text" maxlength="18" class="mdui-textfield-input" />
      </div>
      <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">设置管理员密码</label>
        <input name="passwd" type="text" maxlength="18" class="mdui-textfield-input" />
      </div>

    </div>
  </div>
  </div>
<br>
<div class="mdui-panel" mdui-panel>
      <div class="yuan mdui-panel-item mdui-panel-item-open">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">安装帮助</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
    <div class="mdui-typo">
<h3 align="left">
数据设置
  </h3>
  <p align="left">
  <b>旧版本用户升级？</b>如果你想还原你的数据，请在<b>完成安装进程后</b>，登录后台，<b>访问 高级设置-数据设置-还原数据</b>进行操作。<br><br>
设置数据库1密码：输入一个含有字母及数字的复杂组合，你无需记住它。<b>不要输入中文。</b>请勿和数据库2密码相同。此数据库为普通留言储存库。
  </p>
  <p align="left">
  设置数据库2密码：输入一个含有字母及数字的复杂组合，你无需记住它。<b>不要输入中文。</b>请勿和数据库1密码相同。此数据库为公开留言储存库。
  <p align="left">
管理员密码：设置登录后台的管理密码。建议不要设置得过于简单以提高安全性。<b>不要输入中文。</b>您可在安装完毕后登录后台进行更改。
  </p>
  </div>

    </div>
  </div>
  </div>
</div>



<div id="copyright" class="mdui-p-a-2">

<div class="mdui-panel" mdui-panel>
      <div class="yuan mdui-panel-item mdui-panel-item-open">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title">使用协议</div>
      <div class="mdui-panel-item-summary"></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
	
    <div class="mdui-panel-item-body">
    <b>“明石留言板”软件使用协议[2.2]</b>
	<br>
  <br>
  
  <p align="left">
  <b>Copyright&copy;<?php echo date("Y"); ?> Akashi | blog.imakashi.top</b><br>
  <br>
  <b>明石/Akashi/Akashi Soft/blog.imakashi.top 对此程序享有著作权。</b><br><br>
  <b>1.你可以在遵循 CC BY-NC-SA 4.0 版权协议的前提下使用或修改本程序。你可以进行基于本程序的非商业性自由创作，你需要至少保留底部原作者版权信息。请以相同方式共享。</b><br>
  <b>2.禁止使用本程序或本程序衍生程序进行商业性活动；禁止使用本程序或本程序衍生程序进行违法活动。由于不当使用本程序或本程序衍生程序而产生的一切后果，由使用者承担。</b><br>
  <b>3.本程序为个人业余作品，请勿在任何包括但不限于正式场合、高并发率场景下使用本程序或本程序衍生程序。由于不当使用本程序或本程序衍生程序而产生的一切后果，由使用者承担。</b><br>
  <b>4.请您不要移除底部的版权标识，作者也是尽量把版权标识弄得不太起眼，以免妨碍您的使用。互相理解吧！</b><br>
  <b>5.最终解释权归明石所有。</b><br><br>
  <b>只要您安装即默认您同意本“软件使用协议”</b><br>
  <b>最后，感谢您使用本程序，祝您使用愉快。</b><br><br>此版本修订日期：2021年9月4日。<br>
  </p>

      <div class="mdui-panel-item-actions">
      <h8 style="color:DarkGray">如果您不同意以上内容可关闭此页面。</h8>
      <input class="mdui-btn btyuan mdui-btn-raised mdui-ripple mdui-color-blue-100" type="submit" name="submit" value="同意以上内容，开始安装" />
   
       
      </div>
    </div>
  </div>
  </div>
       
      
    </form>

</div>



    <?php
  } else { ////////////////////////提交后操作
    if (empty($_POST['changewebname'])  ||  empty($_POST['db1'])  ||  empty($_POST['db2'])  ||   empty($_POST['passwd'])  ||   empty($_POST['set-maxlength'])  ||empty($_POST["submittime"]) ||  empty($_POST['changewebname'])) {
      exit("<br/><center><h2>-错误信息-<br></h2><h3>请检查您是否填写了所有内容</h3></center>");
    } else {
      $webname = $_POST['changewebname'];
      $websign = $_POST['changewebsign'];
      $commentmax = $_POST['set-maxlength'];
	  $color = $_POST['themecolor'];
	  $submittime = $_POST["submittime"];
	  $adminname = $_POST["adminname"];
    $adb1 = $_POST['db1'];
    $adb2 = $_POST['db2'];
    $passwd = $_POST['passwd'];

	  
	if(empty($color)){
$color = 'white';
	}	

  if($adb1 == $adb2){
    exit("<br/><center><h2>-错误信息-<br></h2><h3>数据库1密码不能与数据库2密码相等。</h3></center>");
      }	

  
	

$f1 = fopen("./database/".$adb1.".txt", "wb");
$text1 = utf8_encode("赶快##编码##给爷####变UTF8@@@");
 
//先用函数utf8_encode将所需写入的数据变成UTF编码格式。
 
$text1 = "\xEF\xBB\xBF".$text1;
 
//"\xEF\xBB\xBF",这串字符不可缺少，生成的文件将成为UTF-8格式，否则依然是ANSI格式。
 
fputs($f1, $text1);
 
//写入。
fclose($f1);

$f2 = fopen("./database/".$adb2.".txt", "wb");
$text2 = utf8_encode("赶快##编码##给爷####变UTF8@@@");
 
//先用函数utf8_encode将所需写入的数据变成UTF编码格式。
 
$text2 = "\xEF\xBB\xBF".$text2;
 
//"\xEF\xBB\xBF",这串字符不可缺少，生成的文件将成为UTF-8格式，否则依然是ANSI格式。
 
fputs($f2, $text2);
 
//写入。
fclose($f2);

  $passwdtxt = fopen('./database/logininfo.php','w');
    fwrite($passwdtxt,"<?php \n \$passwd ='".$passwd."'; \n?>");
    fclose($passwdtxt);

    $dbinfo = fopen('./database/dbinfo.php','w');
    fwrite($dbinfo,"<?php \n  \$db1name = '".$adb1."';  \n   \$db2name = '".$adb2."';   \n \$db1 = './database/".$adb1.".txt'; \n \$db2 = './database/".$adb2.".txt'; \n?>");
    fclose($dbinfo);



	   // 2.拼装（组装）信息
$selfsetting = "{$color}##{$webname}##{$websign}##{$commentmax}##{$submittime}## ## ##{$adminname}##@@@";


// 3.将信息追加到文件中
                                            
 $loadselfsetting = fopen("./database/selfsetting/selfsetting.dat", "w");
  $modifyselfsetting = $selfsetting;
  fwrite($loadselfsetting, $modifyselfsetting);
  fclose($loadselfsetting);
   
    }
 
    $fp2 = fopen($lockfile,'w');
    fwrite($fp2,'明石留言板 V2.1 \n 此为安装锁文件，请勿删除！ \n  否则您的站点将会被重置。');
    fclose($fp2);
    //写注册锁
 

exit("<br/><center><h2>-安装成功-<br></h2><h3>请牢记您的密码：".$passwd."<div class=\"mdui-typo\"><a href=\"./index.php\"><br>开始使用</a></div></h3></center>");


  }
  ?>
</div>
</center>
</div>
</html>