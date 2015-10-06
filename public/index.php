<?php require_once __DIR__ . '/../load_tweets.php'; ?>
<html>
<head>
    <!--<link rel="stylesheet" href="style.css">-->
</head>

<body>

<?php foreach ($tweets->readTweets() as $tweet) { ?>
    <div class="tweet"><?= $tweet->text; ?></div>
    <?php if (isset($tweet->img)) { ?>
        <img src="<?= $tweet->img; ?>">
    <?php } ?>
<?php } ?>

</body>
</html>
