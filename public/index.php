<?php require_once __DIR__ . '/../load_tweets.php'; ?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<!-- Just one. -->
<div class="tweet"><?= $tweets->readTweets(1); ?></div>

<!-- Three. -->
<?php foreach ($tweets->readTweets(3) as $tweet) { ?>
    <div class="tweet"><?= $tweet; ?></div>
<?php } ?>


<!-- All 100 of them. -->
<?php foreach ($tweets->readTweets() as $tweet) { ?>
    <div class="tweet"><?= $tweet; ?></div>
<?php } ?>

</body>
</html>
