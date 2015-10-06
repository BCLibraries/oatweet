<?php require_once __DIR__ . '/../load_tweets.php'; ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- Just one -->
<!--
<div class="tweet">
    <div class="text">
        <?= $tweets->readTweets(1)->text; ?>
    </div>
    <div class="by">
        <?= $tweets->readTweets(1)->by; ?>
    </div>

    <?php if (isset($tweets->readTweets(1)->img)) { ?>
        <img src="<?= $tweets->readTweets(1)->img; ?>">
    <?php } ?>
</div>
-->

<!-- Two. -->
<?php foreach ($tweets->readTweets(2) as $tweet) { ?>
    <div class="tweet">
        
        <div class="by">
            <?= $tweet->by; ?>
        </div>

        <div class="text">
            <?= $tweet->text; ?>
        </div>

       <?php if (isset($tweet->img)) { ?>
            <img src="<?= $tweet->img; ?>">
        <?php } ?>
    </div>
<?php } ?>

</body>
</html>
