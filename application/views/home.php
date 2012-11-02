<!DOCTYPE html>
<html dir="ltr" lang="zh-CN">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>华中师范大学下载中心</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="all">
</head>
<body>
<!-- 页面头部 开始 -->
  <header>
    <h1 class="logo">华中师范大学下载中心</h1>
    <nav>
      <a href="#" id="home" class="current">首页</a>
      <a href="#" id="categories">资源分类</a>
      <a href="#" id="referrals">软件推介</a>
      <a href="#" id="ranklist">排行榜</a>
    </nav>
  </header>
<!-- 页面头部 结束 -->

<!-- 首页末版 开始 -->
  <div class="wrap">
    <div class="scroll_images">
      <img id="sol_img_1" class="current" src="images/scroll.png" />
      <img id="sol_img_2" src="images/scroll.png" />
      <img id="sol_img_3" src="images/scroll.png" />
    </div>
    <div class="home_right">
      <form>
        <input type="text" id="search" name="search" placeholder="请输入你要查询的内容" />
        <button type="button">搜索</button>
      </form>
      <h2>本周下载排行</h2>
      <ul>
      	<?php foreach($weekly as $k): ?>
        <li><a href="<?=$k['soft_url']?>"><?=$k['soft_name']?></a><span><?=$k['down_count']?>次</span></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="banner"><img src="images/banner.png" /></div>
    <div class="home_box">
      <h2>下载总排行</h2>
      <ol>
        <li><a href="#">360安全卫士</a></li>
        <li><a href="#">360杀毒</a></li>
        <li><a href="#">小红伞</a></li>
        <li><a href="#">腾讯QQ</a></li>
        <li><a href="#">快播影视</a></li>
        <li><a href="#">百度影音</a></li>
        <li><a href="#">腾讯电脑管家</a></li>
        <li><a href="#">H3C客户端</a></li>
        <li><a href="#">自由门</a></li>
        <li><a href="#">Windows8_x64_msdn</a></li>  
      </ol>
    </div>
    <div class="home_box">
      <h2>下载总排行</h2>
      <ol>
        <li><a href="#">360安全卫士</a></li>
        <li><a href="#">360杀毒</a></li>
        <li><a href="#">小红伞</a></li>
        <li><a href="#">腾讯QQ</a></li>
        <li><a href="#">快播影视</a></li>
        <li><a href="#">百度影音</a></li>
        <li><a href="#">腾讯电脑管家</a></li>
        <li><a href="#">H3C客户端</a></li>
        <li><a href="#">自由门</a></li>
        <li><a href="#">Windows8_x64_msdn</a></li>  
      </ol>

    </div>
    <div class="home_box">
      <h2>下载总排行</h2>
      <ol>
        <li><a href="#">360安全卫士</a></li>
        <li><a href="#">360杀毒</a></li>
        <li><a href="#">小红伞</a></li>
        <li><a href="#">腾讯QQ</a></li>
        <li><a href="#">快播影视</a></li>
        <li><a href="#">百度影音</a></li>
        <li><a href="#">腾讯电脑管家</a></li>
        <li><a href="#">H3C客户端</a></li>
        <li><a href="#">自由门</a></li>
        <li><a href="#">Windows8_x64_msdn</a></li>  
      </ol>
    </div>
    <div class="home_box">
      <h2>下载总排行</h2>
      <ol>
        <li><a href="#">360安全卫士</a></li>
        <li><a href="#">360杀毒</a></li>
        <li><a href="#">小红伞</a></li>
        <li><a href="#">腾讯QQ</a></li>
        <li><a href="#">快播影视</a></li>
        <li><a href="#">百度影音</a></li>
        <li><a href="#">腾讯电脑管家</a></li>
        <li><a href="#">H3C客户端</a></li>
        <li><a href="#">自由门</a></li>
        <li><a href="#">Windows8_x64_msdn</a></li>  
      </ol>
    </div>
    <div style="clear:both;"></div>
    <div class="tags_box">
      <h2>热门标签</h2>
      <div class="tags">
        <a href="#" class="super_hot">QQ</a>
        <a href="#" class="hot">腾讯</a>
      </div>
    </div>
  </div>
<!-- 首页末版 结束 -->

<!-- 页面脚部 开始 -->
  <footer>
    <p>华中师范大学网络与教育技术中心</p>
    <p>CopyRight 2009-2012</p>
  </footer>
<!-- 页面脚部 结束 -->
</body>
</html>