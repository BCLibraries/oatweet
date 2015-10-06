<?php
require_once __DIR__ . '/vendor/autoload.php';

header("refresh:120;url=http://libdev.bc.edu/oatweet/index.php");

$settings = require_once(__DIR__ . '/.settings.php');

$tweets = new TweetReader();
$tweets->load($settings);

class TweetReader
{
    private $tweets;

    public function load($settings)
    {
        $filename = __DIR__ . '/storage/tweets.json';

        // Use a cache file if it exists and is recent.
        if (file_exists($filename) && $this->fileUpdatedSince($filename, 2)) {
            $tweets_json = file_get_contents($filename);
        } else {
            $tweets_json = $this->downloadFreshTweets($settings);
            file_put_contents($filename, $tweets_json);
        }

        $tweets_data = json_decode($tweets_json);


        $this->tweets = array();

        foreach ($tweets_data->statuses as $status) {
            if ($status->lang == "en") {
                $tweet = new stdClass();
                $tweet->text = $status->text;
                $tweet->by = $status->user->screen_name;
                if (isset($status->entities->media[0]->media_url)) {
                    $tweet->img = $status->entities->media[0]->media_url;
                }
                $this->tweets[] = $tweet;
            }
        }
    }

    public function readTweets($number = null)
    {
        if (is_null($number)) {
            return $this->tweets;
        }

        if ($number == 1) {
            return $this->tweets[0];
        }

        return array_slice($this->tweets, 0, $number);
    }

    private function downloadFreshTweets($settings)
    {
        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        $getfield = '?count=100&q=%23openaccess%20-RT';
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($settings);

        $tweets_json = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();
        return $tweets_json;
    }

    private function fileUpdatedSince($filename, $minutes)
    {
        return time() - filemtime($filename) > $minutes * 60;
    }

}