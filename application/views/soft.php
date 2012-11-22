<div id="soft-title" class="list">
	<div class="shadow-box">
		<h2><?=$soft['soft_name']?></h2>
		<div class="addr">
			<a href="<?=$site_url?>">首页</a> > <a href="<?=$soft['term_url']?>"><?=$soft['term_name']?></a> > <a href="<?=$soft['tag_url']?>"><?=$soft['tag_name']?></a>
		</div>
	</div>
	<div class="dishadowplus">
		&nbsp;
	</div>
</div>

<div id="soft-main" class="soft">
	<div class="shadow-box">
		<h3>软件摘要</h3>
		<img src="<?=$soft['soft_img']?>" alt="<?=$soft['soft_name']?>" />
		<ul>
			<li>
				软件分类：<?=$soft['term_name']?>
			</li>
			<li>
				软件大小：<?=$soft['soft_size']?>
			</li>
			<li>
				上传时间：<?=$soft['post_time']?>
			</li>
			<li>
				下载次数：<?=$soft['down_count']?>次
			</li>
			<li>
				人气指数：支持[<?=$soft['downer_top_count']?>]  反对[<?=$soft['downer_down_count']?>]
			</li>
			<li>
				软件简介：
			</li>
		</ul>
		<p>
			<?=$soft['soft_description']?>
		</p>
		<a class="button" href="<?=$soft['soft_down']?>">Download</a>
	</div>
	<div class="dishadowplus">
		&nbsp;
	</div>
</div>

<div id="soft-comment" class="soft">
	<div class="shadow-box">
		<h3>用户评论</h3>
		<ul>
			<li>
				<span class="name">苏小里</span>
				<span class="time">发表于 2012-11-07 13:30:29</span>
				<p>
					这个软件不靠谱啊 不靠谱啊 不靠谱=。= 真的不靠谱。这个软件不靠谱啊 不靠谱啊 不靠谱=。= 真的不靠谱。这个软件不靠谱啊 不靠谱啊 不靠谱=。= 真的不靠谱。这个软件不靠谱啊 不靠谱啊 不靠谱=。= 真的不靠谱。
				</p>
			</li>
		</ul>

		<div class="pages">
			<a class="pre" href="#">上一页</a>
			<a class="num current" href="#">1</a>
			<a class="num" href="#">2</a>
			<a class="next" href="#">下一页</a>
		</div>

	</div>
	<div class="dishadowplus">
		&nbsp;
	</div>
</div>

<div id="comment" class="soft">
	<div class="shadow-box">
		<h3>我来评论</h3>
		<form action="#" method="post">
			<label>发表评论</label>
			<textarea name="content"></textarea>
			<label>用户名</label>
			<input type="text" name="name" />
			<a href="#" class="agree">支持</a>
			<a href="#" class="disagree">反对</a>
			<input type="submit" value="提	交"/>
		</form>

	</div>
	<div class="dishadowplus">
		&nbsp;
	</div>
</div>
<!-- soft.php end here -->
