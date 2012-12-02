<div id="need">
	<div class="shadow-box">
		<h2>装机必备</h2>
		<?php foreach($need_title as $k=>$title): ?>
		<dl <?php if($k==0) echo 'class="current"'; ?>>
			<dt>
				<?=$title?>
			</dt>
			<div class="trige">&nbsp;</div>
			<dd>
				<ul>
					<?php foreach($need[$k] as $v): ?>
					<li>
						<a href="<?=$v['soft_page']?>"><img src="<?=$v['soft_img']?>" alt="<?=$v['soft_name']?>" /></a>
						<a href="<?=$v['soft_page']?>"><h4><?=$v['soft_name']?></h4></a>
						<p><?=($v['soft_description'])?></p>
						<span class="size"><?=$v['soft_size']?></span>
					</li>
					<?php endforeach; ?>
				</ul>
			</dd>
		</dl>
		<?php endforeach; ?>
	</div>
	<div class="shadowplus">&nbsp;</div>
</div>

<div id="notice">
	<div class="shadow-box">
		<h2>信息公告栏</h2>
		<div class="box">
			<p><?=$notice?></p>
		</div>
	</div>
	<div class="shadow">&nbsp;</div>
</div>

<div id="often">
	<div class="shadow-box">
		<h2>常用软件</h2>
		<ul>
			<?php foreach($often as $k): ?>
			<li>
				<img src="<?=$k['soft_img']?>" alt="<?=$k['soft_name']?>" /><a href="<?=$k['soft_page']?>"><?=$k['soft_name']?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="shadow">&nbsp;</div>
</div>

<div id="new" class="list">
	<div class="shadow-box">
		<h2>最新软件</h2>
		<ul>
			<?php foreach($theNew as $k): ?>
			<li>
				<a href="<?=$k['soft_page']?>"><img src="<?=$k['soft_img']?>" alt="<?=$k['soft_name']?>" /></a>
				<a href="<?=$k['soft_page']?>"><h4><?=$k['soft_name']?></h4></a>
				<p><?=$k['soft_description']?></p>
				<div class="brief-info">
					<span class="date"><?=$k['post_time']?></span>
					<span class="downs">下载次数：<?=$k['down_count']?></span>
					<span class="size">大小：<?=$k['soft_size']?></span>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="dishadowplus">&nbsp;</div>
</div>
<!-- home.php end here -->
