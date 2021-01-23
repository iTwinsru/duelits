<?php header("Cache-Control: no-store, no-cache, must-revalidate"); ?>
<html>
<head>
<meta name="viewport" content="width=440"/>

<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
<?php echo $GLOBALS['HEAD']; ?>
<style><?php echo $GLOBALS['CSS']; ?></style>
</head>
<body>
<?php echo $GLOBALS['BODY']; out_debug()?>
</body>
</html>