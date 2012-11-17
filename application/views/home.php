<div id="need">
	<div class="shadow-box">
		<h2>装机必备</h2>
		<dl>
			<dt>
				系统工具
			</dt>
			<div class="trige">
				&nbsp;
			</div>
			<dd></dd>
		</dl>
		<dl>
			<dt>
				安全杀毒
			</dt>
			<div class="trige">
				&nbsp;
			</div>
			<dd>

			</dd>
		</dl>
		<dl class="current">
			<dt>
				下载工具
			</dt>
			<div class="trige">
				&nbsp;
			</div>
			<dd>
				<ul>
					<li>
						<img src="icon.jpg" alt="icon" />
						<h4>一键GHOST 2012.0.12</h4>
						<p>
							只需要按一个键就能让电脑自动还原，很方便吧 。。。
						</p>
						<span class="size">16.68M</span>
					</li>
					<li>
						<img src="icon.jpg" alt="icon" />
						<h4>一键GHOST 2012.0.12</h4>
						<p>
							只需要按一个键就能让电脑自动还原，很方便吧 。。。
						</p>
						<span class="size">16.68M</span>
					</li>
					<li>
						<img src="icon.jpg" alt="icon" />
						<h4>一键GHOST 2012.0.12</h4>
						<p>
							只需要按一个键就能让电脑自动还原，很方便吧 。。。
						</p>
						<span class="size">16.68M</span>
					</li>
					<li>
						<img src="icon.jpg" alt="icon" />
						<h4>一键GHOST 2012.0.12</h4>
						<p>
							只需要按一个键就能让电脑自动还原，很方便吧 。。。
						</p>
						<span class="size">16.68M</span>
					</li>
					<li>
						<img src="icon.jpg" alt="icon" />
						<h4>一键GHOST 2012.0.12</h4>
						<p>
							只需要按一个键就能让电脑自动还原，很方便吧 。。。
						</p>
						<span class="size">16.68M</span>
					</li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt>
				办公软件
			</dt>
			<div class="trige">
				&nbsp;
			</div>
			<dd>

			</dd>
		</dl>
		<dl>
			<dt>
				视频软件
			</dt>
			<div class="trige">
				&nbsp;
			</div>
			<dd>

			</dd>
		</dl>
		<dl>
			<dt>
				聊天工具
			</dt>
			<div class="trige">
				&nbsp;
			</div>
			<dd>

			</dd>
		</dl>
	</div>
	<div class="shadowplus">
		&nbsp;
	</div>
</div>

<div id="notice">
	<div class="shadow-box">
		<h2>信息公告栏</h2>
		<p>
			哟西，这里是系统公告栏，想放什么就放什么。纳尼，后台么有在这个功能？NND，加！这就去加，赶紧的。。。阿飞家阿三地方阿点分i阿和u对方更好采购v
		</p>
	</div>
	<div class="shadow">
		&nbsp;
	</div>
</div>

<div id="often">
	<div class="shadow-box">
		<h2>常用软件</h2>
		<ul>
			<li><img src="icon.jpg" alt="H3C客户端" /><a href="#">H3C客户端</a>
			</li>
			<li><img src="icon.jpg" alt="H3C客户端" /><a href="#">H3C客户端</a>
			</li>
			<li><img src="icon.jpg" alt="H3C客户端" /><a href="#">H3C客户端</a>
			</li>
		</ul>
	</div>
	<div class="shadow">
		&nbsp;
	</div>
</div>

<div id="new" class="list">
	<div class="shadow-box">
		<h2>最新软件</h2>
		<ul>
			<?php foreach($theNew as $k): ?>
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
	</div>
	<div class="dishadowplus">
		&nbsp;
	</div>
</div>
<!-- home.php end here -->
