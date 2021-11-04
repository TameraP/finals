<div class="proprietary-news-widget-div">
	<ul class="proprietary-news-widget-ul">
		<?php foreach ($faqList as $faqInfo) { ?>
			<?php if ($faqCount++ >= $faqLimit) break; ?>
			<li class="proprietary-news-widget-ul"><?= $faqInfo["faqQuestion"]; ?></li>
		<?php } ?>
	</ul>
</div>