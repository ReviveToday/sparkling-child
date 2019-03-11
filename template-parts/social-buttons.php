<?php
/**
 * Social network connection buttons.
 *
 * @package revivetoday-child
 */
$rt_title = urlencode( get_the_title() );
$rt_url   = urlencode( get_permalink() );

$rt_twitter_url  = "https://twitter.com/intent/tweet?via=revive_today&text={$rt_title}&url={$rt_url}";
$rt_facebook_url = "https://www.facebook.com/sharer.php?u={$rt_url}";
$rt_whatsapp_url = "https://api.whatsapp.com/send?text={$rt_url}";
$rt_reddit_url   = "https://www.reddit.com/submit?url={$rt_url}";
?>

<div class="rt-shareblock">
	<h3>Share</h3>
	<ul>
		<li class="rts twitter"><a target="_blank" href="<?php echo $rt_twitter_url; ?>">Twitter</a></li>
		<li class="rts facebook"><a target="_blank" href="<?php echo $rt_facebook_url; ?>">Facebook</a></li>
		<li class="rts reddit"><a target="_blank" href="<?php echo $rt_reddit_url; ?>">Reddit</a></li>
		<li class="rts whatsapp"><a target="_blank" href="<?php echo $rt_whatsapp_url; ?>">WhatsApp</a></li>
	</ul>
</div>