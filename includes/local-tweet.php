<?php
 
// Database setup:
// Create a table to save key-value pairs with columns "key" and "value".
// See code below, 2 rows needed (latest-tweet and latest-tweet-updated)
// Enter the output from "time()" into latest-tweet-updated to begin with.
 
$db = new mysqli('', '', '', '');
 
$latest_tweet_updated = $db->query("SELECT value FROM `key-values` WHERE `key`='latest-tweet-updated'");
 
if($latest_tweet_updated->num_rows == 1)
{
$latest_tweet_updated = $latest_tweet_updated->fetch_assoc();
 
// If tweet hasn't been updated for more than five minutes.
if(time() > $latest_tweet_updated['value'] + (60 * 5))
{
// Get latest tweet.
include 'twitteroauth.php'; //https://github.com/abraham/twitteroauth
// Get these from the Twitter Dev center https://dev.twitter.com
$consumerKey = '';
$consumerSecret = '';
$accessToken = '';
$accessTokenSecret = '';
 
$twitterConnection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
$timeline = $twitterConnection->get('statuses/user_timeline', array('count' => 1));
// If latest tweet loaded successfully.
if(!(isset($timeline->errors) && count($timeline->errors) > 0))
{
// Update tweet update time.
$time = time();
$db->query("UPDATE `key-values` SET `value`='{$time}' WHERE `key`='latest-tweet-updated'");
// Save latest tweet.
$tweet = $db->real_escape_string($timeline[0]->text); // Just incase someone hacks your Twitter and posts some SQL :)
$db->query("UPDATE `key-values` SET `value`='{$tweet}' WHERE `key`='latest-tweet'");
}
}
}
 
// Get the tweet from your database.
$latest_tweet = $db->query("SELECT value FROM `key-values` WHERE `key`='latest-tweet'");
 
if($latest_tweet->num_rows == 1)
{
$latest_tweet = $latest_tweet->fetch_assoc();
$response = array(
'tweet' => $latest_tweet['value']
);
}
else
{
$response = array(
'tweet' => 'Could not load tweet :('
);
}
 
// This code is being used as an ajax loader, but can be easily modified to echo out the tweet at document creation time.
echo json_encode($response);
 
?>
