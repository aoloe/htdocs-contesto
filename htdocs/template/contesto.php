<!doctype html>
<html lang="<?= isset($language) ? $language : 'en' ?>">
<head>

<meta charset="utf-8">
<?php /*
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
*/ ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title><?= isset($title) ? $title.' - Contesto' : 'Contesto - Traduzioni – Übersetzungen – Traductions – Translations – Zürich'?></title>

<link rel="shortcut icon" href="<?= $favicon ?>" />
<?php if (isset($fonts)) : foreach ($fonts as $value) : ?>
<link rel="stylesheet" href="<?= $value ?>" />
<?php endforeach; endif; ?>

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<?php if (isset($css)) : foreach ($css as $value) : ?>
<link rel="stylesheet" href="<?= is_array($value) ? $value['href'] : $value ?>" type="text/css" media="<?= is_array($value) && array_key_exists('media', $value) ? $value['media'] : 'all' ?>" />
<?php endforeach; endif; ?>

<?php if (isset($js)) : foreach ($js as $value) : ?>
<script type="text/javascript" src="<?= $value ?>"></script>
<?php endforeach; endif; ?>

</head>
<body>
<?php if (isset($navigation)) : ?>
<div class="header">
<div class="inner">
<?php /*
<a class="logo" href="/<?= $language ?>/" title="Contesto"><img src="/images/header_logo.png" alt="Contesto" /></a>
*/ ?>
<a class="logo" href="/" title="Contesto"><img src="/images/header_logo.png" alt="Contesto" /></a>
<?= $navigation ?>
</div> <!-- inner -->
<?= $navigation_language ?>
</div> <!-- header -->
<?php endif; ?>
<?= $content ?>
<?php if (isset($footer)) : ?>
<?= $footer ?>
<?php endif; ?>
</body>
</html>
