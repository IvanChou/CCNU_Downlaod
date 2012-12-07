<div id="soft-title" class="list">
	<div class="shadow-box">
		<h2><?=$soft['soft_name']?></h2>
		<div class="addr">
			<a href="<?=$site_url?>">首页</a> > <a href="<?=$soft['term_url']?>"><?=$soft['term_name']?></a> > <a href="<?=$soft['tag_url']?>"><?=$soft['tag_name']?></a>
		</div>
	</div>
	<div class="dishadowplus">&nbsp;</div>
</div>

<div id="soft-main" class="soft">
	<div class="shadow-box">
		<h3>软件摘要</h3>
		<img src="<?=$soft['soft_img']?>" alt="<?=$soft['soft_name']?>" />
		<ul>
			<li>软件分类：<?=$soft['term_name']?></li>
			<li>软件大小：<?=$soft['soft_size']?></li>
			<li>上传时间：<?=$soft['post_time']?></li>
			<li>下载次数：<?=$soft['down_count']?>次</li>
			<li>人气指数：支持[<?=$soft['downer_top_count']?>]  反对[<?=$soft['downer_down_count']?>]	</li>
			<li>软件简介：</li>
		</ul>
		<p><?=$soft['soft_description']?></p>
		<a class="button" href="<?=$soft['soft_down']?>">Download</a>
	</div>
	<div class="dishadowplus">&nbsp;</div>
</div>

<div id="soft-comment" class="soft">
	<div class="shadow-box">
		<h3>用户评论</h3>
		<ul>
			<?php foreach($comments as $v): ?>
			<li>
				<span class="name"><?=$v['user_name']?></span>
				<span class="time">发表于 <?=$v['com_time']?></span>
				<p><?=$v['com_text']?></p>
			</li>
			<?php endforeach ?>
		</ul>

		<div class="pages">
			<?php echo $this->pagination->create_links(); ?>
		</div>

	</div>
	<div class="dishadowplus">&nbsp;</div>
</div>

<div id="comment" class="soft">
	<div class="shadow-box">
		<h3>我来评论</h3>
		<form action="<?=site_url("soft/comment")?>" method="post" accept-charset="utf-8">
			<input type="hidden" name="soft-id" value="<?=$soft['ID']?>">
			<label>发表评论</label>
			<textarea name="content"></textarea>
			<label>用户名</label>
			<input type="text" name="name" />
			<a href="<?=site_url("soft/like/$soft[ID]")?>" class="agree">支持</a>
			<a href="<?=site_url("soft/unlike/$soft[ID]")?>" class="disagree">反对</a>
			<input type="submit" value="提	交"/>
		</form>

	</div>
	<div class="dishadowplus">&nbsp;</div>
</div>
<!-- soft.php end here -->
