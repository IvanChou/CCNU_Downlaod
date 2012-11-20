<div id="softs" class="list">
	<div class="shadow-box">
		<h2><?php echo $curnet = $map['tag_name']?$map['tag_name']:$map['term_name'] ?></h2>
		<div class="addr">
			<a href="<?=$site_url ?>">首页</a> > 
			<?php
				if(! $map['tag_id']){
					echo $map['term_name'];
				}else{
					echo "<a href=$map[term_url] >$map[term_name]</a> > $map[tag_name]";
				}
			?>
		</div>
		<ul>
			<?php foreach($softs as $k): ?>
			<li>
				<img src="<?=$k['soft_img']?>" alt="<?=$k['soft_name']?>" />
				<h4><?=$k['soft_name']?></h4>
				<p>
					<?=$k['soft_description']?>
				</p>
				<div class="brief-info">
					<span class="date"><?=$k['post_time']?></span>
					<span class="downs">下载次数：<?=$k['down_count']?></span>
					<span class="size">大小：<?=$k['soft_size']?></span>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>

		<div class="pages">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
	<div class="dishadowplus">
		&nbsp;
	</div>
</div>