<div class="proprietary-news-widget-div">
	<ul class="proprietary-news-widget-ul">
		<?php foreach ($articleList as $articleInfo) { ?>
			<?php if ($articleCount++ >= $articleLimit) break; ?>
			<li class="proprietary-news-widget-ul"><?= $articleInfo["articleTitle"]; ?></li>
		<?php } ?>
	</ul>
</div>