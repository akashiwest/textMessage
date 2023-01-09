<!--
   项目名称：明石留言板
   版本：V2.2
   时间：2021-9-5
   
   Copyright©2021 | Akashi Tec.
   遵循 CC-BY-NC-SA 4.0版权协议
   
   about.php
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
			   
		   echo "<a href=\"./about.php\" class=\"yuan mdui-list-item mdui-list-item-active\">";
            echo "<i class=\"mdui-list-item-icon mdui-icon material-icons\">info_outline</i>";
            echo "&emsp;关于";
          echo "</a>  ";
		  }else{
			  
		  }
		  
		  ?>

         <?php 
	
	// 首先判断Cookie是否有记住了用户信息
	if (isset($_SESSION['ambadminlogin'])) {
		echo' <a href="./admin.php" class="yuan mdui-list-item"><i class="mdui-list-item-icon mdui-icon material-icons">build</i>&emsp;后台管理';
	} else {
		
	}
 ?>
          </a>
        </div>
       
		
	
    <br>


        
      </div>
    </div>
    <br/>

<div id="about" class="mdui-p-a-2">

<div class="mdui-card yuan">

  <!-- 卡片头部，包含头像、标题、副标题 -->
  <div class="mdui-card-header">
    <img class="mdui-card-header-avatar" src="https://pic.sevesum.com/2021/02/16/fdb4775fb21aa.png"/>
    <div class="mdui-card-header-title">明石 AKASHI Tec.</div>
    <div class="mdui-card-header-subtitle">青春无悔热爱！</div>
  </div>

  <!-- 卡片的媒体内容，可以包含图片、视频等媒体内容，以及标题、副标题 -->
  <div class="mdui-card-media">

    <!-- 卡片中可以包含一个或多个菜单按钮 -->
    <div class="mdui-card-menu">
    <div class="mdui-typo">

<a class="mdui-btn mdui-ripple mdui-color-blue-50 btyuan" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=eBkTGQsQEQgZChM4HhcAFRkRFFYbFxU" target="_blank" >反馈问题</a>

  </div>
    </div>
  </div>

  <!-- 卡片的标题和副标题 -->
  <div class="mdui-card-primary">
    <div class="mdui-card-primary-title">明石留言板 [V2.2]</div>
    <div class="mdui-card-primary-subtitle">Akashi Messagebox(Without database)</div>
  </div>

  

  <blockquote>
  <div class="mdui-typo"><h3> 作者：明石  </h3></div>    
  <div class="mdui-card-actions">
    <a class="mdui-btn mdui-ripple btyuan" href="https://github.com/akashipark" target="_blank" >GITHUB</a>
    <a class="mdui-btn mdui-ripple btyuan" href="https://blog.imakashi.top" target="_blank" >BLOG</a>
  </div>  



<br>
<hr>
<br>
<div class="mdui-typo">
  <h4>
明石 版权所有       <br>   <br> 
遵循 CC-BY-NC-SA 版权协议<br>
非商业性使用 - 原作者署名 - 相同方式共享<br><br>

     样式为MDUI             <br>  <br>     
	    
		 此网页背景图片来自 <a href="http://www.tuquu.com/" target="_blank" >图趣网</a>      <br>   <br> 
     </div>
<br> 
</h4>
</div>

</div>
</div>


<?php include 'footer.php';?>

