<?php
if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
    case 'logout':
        session_start();
        session_unset();
        session_destroy();
        header("location:./login.php");
	}
}
?>
<div id="profile-links">
你好， <?php echo $_SESSION['USERNAME']; ?>
<br />
<a target="_blank" href="http://218.199.196.7" title="访问前台页面">访问前台网站</a> | <a href="./index.php?action=logout" title="退出">退出</a>
</div>
     
<!---------------------------------------------------#main-nav ----------------------------------------------------------->
<ul id="main-nav">  <!-- Accordion Menu -->
				
<li> 
<a <?php if(isset($_GET['title'])&&($_GET['title'])=='soft') echo "class='nav-top-item current'"; else echo "class='nav-top-item'";?>>软件管理</a>
<ul>
<li><a href="index.php?title=soft&amp;list=view" onmouseover="this.className='current'" onmouseout="this.className='other'">软件管理</a></li>
<li><a href="index.php?title=soft&amp;list=softadd" onmouseover="this.className='current'" onmouseout="this.className='other'">软件上传</a></li>
</ul>
</li>
				
<li>
<a <?php if(isset($_GET['title'])&&($_GET['title'])=='sorts') echo "class='nav-top-item current'"; else echo "class='nav-top-item'";?>>栏目管理</a>
<ul>
<li><a href="index.php?title=sorts&amp;list=view" onmouseover="this.className='current'" onmouseout="this.className='other'">栏目管理</a></li>
</ul>
</li>
				
<li>
<a <?php if(isset($_GET['title'])&&($_GET['title'])=='users') echo "class='nav-top-item current'"; else echo "class='nav-top-item'";?>>用户管理</a>
<ul>
<li><a href="index.php?title=users&amp;list=view" onmouseover="this.className='current'" onmouseout="this.className='other'">用户管理</a></li>
</ul>
</li>

<li>
<a <?php if(isset($_GET['title'])&&($_GET['title'])=='discuss') echo "class='nav-top-item current'"; else echo "class='nav-top-item'";?>>
评论管理</a>
<ul>
<li><a href="index.php?title=discuss&amp;list=view" onmouseover="this.className='current'" onmouseout="this.className='other'">评论管理</a></li>
</ul>
</li>

<li>
<a <?php if(isset($_GET['title'])&&($_GET['title'])=='index') echo "class='nav-top-item current'"; else echo "class='nav-top-item'";?>>
首页管理</a>
<ul>
<li><a href="index.php?title=index&amp;list=view" onmouseover="this.className='current'" onmouseout="this.className='other'">首页管理</a></li>
</ul>
</li>
</ul> 
<!-- End #main-nav-->
</div>
</div><!-- End #sidebar -->
<div id="main-content"> <!-- Main Content Section with everything -->
<!-- Page Head -->
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
<div class="content-box-header">