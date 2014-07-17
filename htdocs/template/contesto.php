<!doctype html>
<html lang="<?= isset($lang) ? $lang : 'en' ?>">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<title>Contesto - Traduzioni – Übersetzungen – Traductions – Translations – Zürich</title>

<link rel="shortcut icon" href="images/favicon.png" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Anton" />

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<?php if (isset($css)) : foreach ($css as $value) : ?>
<link rel="stylesheet" href="<?= is_array($value) ? $value['href'] : $value ?>" type="text/css" media="<?= is_array($value) && array_key_exists('media', $value) ? $value['media'] : 'all' ?>" />
<?php endforeach; endif; ?>

<?php if (isset($js)) : foreach ($js as $value) : ?>
<script type="text/javascript" src="<?= $value ?>"></script>
<?php endforeach; endif; ?>


</head>
<body>
<?= $content ?>
</body>
</html>
