<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

function debug($label, $value) {
    echo("<pre>$label:\n");
    if (is_null($value)) {
        echo("&lt;null&gt;");
    } elseif ($value === false) {
        echo("&lt;false&gt;");
    } else {
        echo(print_r($value, 1));
    }
    echo("</pre>\n");
}
// debug('_REQUEST', $_REQUEST);
// debug('_SERVER', $_SERVER);
$path = str_repeat('../', substr_count($_SERVER['REQUEST_URI'], '/', 1));
// debug('path', $path);
// $_SERVER['HTTP_REFERER']

include_once("lib/spyc.php");
include_once("lib/markdown.php");

include_once('lib/template.php');
$template = new Template();

$site_language = file_get_contents('content/language.yaml');
$site_language = Spyc::YAMLLoadString($site_language);
// debug('site_language', $site_language);
$site_structure = file_get_contents('content/structure.yaml');
$site_structure = Spyc::YAMLLoadString($site_structure);
// debug('site_structure', $site_structure);

$page = null;
$page_language = null;
$page_url = null;
$page_template = null;
$page_css = array(
);
$page_js = array(
);
$page_navigation = null;
$page_content = null;

if (array_key_exists('page', $_REQUEST)) {
    $page = $_REQUEST['page'];
}

$request_url = null;
$request_language = null;

$request_language = array_slice(explode('/', $_SERVER['REQUEST_URI']), 1, 1);
$request_language = reset($request_language);
// debug('request_language', $request_language);
if (array_key_exists($request_language, $site_language)) {
    $page_language = $request_language;
    $request_url = array_slice(explode('/', $_SERVER['REQUEST_URI']), 2, 1);
    $request_url = reset($request_url);
} else {
    $request_url = array_slice(explode('/', $_SERVER['REQUEST_URI']), 1, 1);
    $request_url = reset($request_url);
}

// debug('_COOKIE', $_COOKIE); // TODO: read from cookie and write cookie if lang has changed
if (array_key_exists('language', $_COOKIE)) {
    if (isset($page_language)) {
        if ($page_language != $_COOKIE) {
        // TODO: write cookie
        }
    } elseif (array_key_exists($_COOKIE['language'], $site_language)) {
        $page_language = $_COOKIE['language'];
    }

}

if (is_null($page_language)) {
    $page_language = 'en'; // TODO: default language should depend on the browser or location + cookie
}

// debug('page_language', $page_language);

// debug('request_url', $request_url);
if (isset($request_url) && array_key_exists($request_url, $site_structure)) {
    $page_url = $request_url;
}
if (is_null($page_url)) {
    $page_url = 'about';
}
// debug('page_url', $page_url);


if (is_null($page)) {
    $page_template = 'splash.php';
    $page_css[] = $path.'css/flexslider.css';
    $page_css[] = $path.'css/simpliste.css';
    $page_js[] = $path.'js/jquery-2.1.1.min.js';
    $page_js[] = $path.'js/modernizr.js';
    $page_js[] = $path.'js/jquery.flexslider-min.js';
} else {
    $page_css[] = $path.'css/ego.css'; // for  the menues
    $page_css[] = $path.'css/contesto.css';
    $page_template = 'index.php';
    $template->clear();

    $navigation = array();
    foreach ($site_language as $key => $value) {
        $navigation_item = array();
        $navigation_item['href'] = '/'.$key.'/'.$site_structure['about'][$key]['url'];
        $navigation_item['label'] = $value;
        if ($key == $page_language) { // if it is the current page
            $navigation_item['current'] = true;
        } else {
            $navigation_item['children'] = array();
            foreach ($site_structure as $kkey => $vvalue) {
                $navigation_item['children'][] = array (
                    'href' => '/'.$key.'/'.$vvalue[$key]['url'],
                    'label' => $vvalue[$key]['label'],
                );
            }
        }
        $navigation[] = $navigation_item;
    }

    // add the menu entries for the current language
    foreach ($site_structure as $key => $value) {
        $navigation[] = array (
            'href' => '/'.$key.'/'.$value[$page_language]['url'],
            'label' => $value[$page_language]['label'],
            'current' => ($key == $page_url),
        );
        
    }

    // debug('navigation', $navigation);

    $template->set('navigation', $navigation);
    $page_navigation = $template->fetch('template/navigation.php');

    $file_content = 'content/'.$page_language.'/'.$page_url.'.md';
    if (file_exists($file_content)) {
        $content = file_get_contents($file_content);
        $page_content = Markdown($content);
    }
}

$template->clear();
$template->set('navigation', $page_navigation);
$template->set('content', $page_content);
$page_body = $template->fetch('template/'.$page_template);

$template->clear();

$template->set('js', $page_js);
$template->set('css', $page_css);
$template->set('content', $page_body);
echo $template->fetch('template/contesto.php');
