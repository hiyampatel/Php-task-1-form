<?php


require 'twitter_data.php';

$twitter = new Twitter_Api();
$statuses = $twitter->main();

?>


<!DOCTYPE html>
<html>
<head>
  <title>Tweeter Feeds</title>
</head>
<body>
<div class="tweet-box">
    <h2>Latest Tweets 25</h2>
    <div class="tweets-widget">
        <ul class="tweet-list">
        <?php
            foreach($statuses as $tweet)
            {
                $latestTweet = $tweet->text;
                $latestTweet = preg_replace('/https:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="https://$1" target="_blank">https://$1</a>', $latestTweet);
                $latestTweet = preg_replace('/@([a-z0-9_]+)/i', '<a href="https://twitter.com/$1" target="_blank">@$1</a>', $latestTweet);
                $tweetTime = date("D M d H:i:s",strtotime($tweet->created_at));
            ?>
            <li class="tweet-block">
                <div class="tweet-content">
                    <h3 class="title" title="<?php echo $tweet->text; ?>"><?php echo $latestTweet; ?></h3>
                    <span class="meta"><?php echo $tweetTime; ?> - <?php echo $tweet->favorite_count; ?> Favorite</span>
                </div>
            </li>
        <?php } ?>
        </ul>
    </div>
</div>
</body>
</html>
