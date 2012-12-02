<div class="sider">
	<?php if(! ($map['term_name'] || $soft)): ?>
	<div class="welcome">
		欢迎您！某某
	</div>
	<?php endif ?>

	<div id="category" class="shadow-box">
		<h2>软件分类</h2>
		<?php foreach($terms as $i=>$k): ?>
		<dl <?php if($map['term_id']?$k['term_id']==$map['term_id']:$i==0)echo 'class="current show"' ?>>
			<a href="<?=$k['term_url']?>">
				<dt><?=$k['term_name']?></dt>
			</a>
			<dd>
				<?php foreach($k['tags'] as $v): ?>
				<a href="<?=$v['tag_url']?>"><?=$v['tag_name']?></a>
				<?php endforeach; ?>
			</dd>
		</dl>
		<?php endforeach; ?>
	</div>
	<div class="shadow">
		&nbsp;
	</div>

	<div id="rank" class="shadow-box">
		<h2>下载排行</h2>
		<ul>
			<?php foreach($top20 as $i=>$k): ?>
			<li>
				<span><?=($i+1)?></span><a href="<?=$k['soft_page']?>"><?=$k['soft_name']?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="shadow">
		&nbsp;
	</div>
</div>
<!-- sider.php end here -->
