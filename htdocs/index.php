<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require('vendor/autoload.php');

new Aoloe\Debug();
// use function Aoloe\debug as debug;

// $debug_log = true;

// debug('_REQUEST', $_REQUEST);
// debug('_SERVER', $_SERVER);

// $path = str_repeat('../', substr_count($_SERVER['REQUEST_URI'], '/', 1));
// debug('path', $path);
// $_SERVER['HTTP_REFERER']

$template = new Aoloe\Template();

$site_language = file_get_contents('content/language.yaml');
$site_language = Spyc::YAMLLoadString($site_language);
// debug('site_language', $site_language);
$site_structure = file_get_contents('content/structure.yaml');
$site_structure = Spyc::YAMLLoadString($site_structure);
// debug('site_structure', $site_structure);

$page = null;

$page_title = null;
$page_navigation = null;
$page_navigation_language = null;
$page_language = null;
$content_page = null;
$content_footer = null;

/*
$request_language = current(array_slice(explode('/', $_SERVER['REQUEST_URI']), 1, 1));
// debug('request_language', $request_language);

if (empty($request_language) || !array_key_exists($request_language, $site_language)) {
        $request_language = null;
}
*/


$site = new Aoloe\Site();

$route = new Aoloe\Route();

$route->set_structure($site_structure);
$route->set_url_language_detection();

$route->read_url_request();
// debug('url_request', $route->get_url_request());

$request_language = $route->get_language();
// Aoloe\debug('request_language', $request_language);

// Aoloe\debug('get_url_request()', $route->get_url_request());
// Aoloe\debug('get_url_structure()', $route->get_url_structure());

if ($request_language == '') {
    $route->set_url_language_detection(false);
}
// Aoloe\debug('get_url_structure()', $route->get_url_structure());

// Aoloe\debug('get_url_request()', $route->get_url_request());

include_once('lib/language_detector.php');
$language = new Language_detector();
$language->set_valid(array_keys($site_language));
$language->set_cookie_manager(Aoloe\Cookie::factory());
if (isset($request_language)) {
    $language->set_request_language($request_language);
}
$page_language = $language->get();
// Aoloe\debug('page_language', $page_language);

$route->set_language($page_language);


if ($request_language == '') {
    $page = $route->get_page_from_structure('splash');
} elseif ($route->get_url_structure() == '') {
    $page = $route->get_page_from_structure('about');
} else {
    $page = $route->get_page_from_structure();
}
$page_query = $route->get_query();
// Aoloe\debug('page', $page);
// Aoloe\debug('page_query', $page_query);

// TODO: generalize the page title
if (array_key_exists('navigation', $page) && isset($page_language)) {
    $page_title = $page['navigation'][$page_language]['label'];
}

$structure_url = $route->get_url_structure();
// Aoloe\debug('get_url_structure', $route->get_url_structure());
if ($route->get_url_structure() != 'splash') {
    include_once('library/Navigation.php');
    $navigation = new Navigation();
    $template->clear();
    $template->set('navigation', $navigation->get_navigation_rendered($site_structure, $site_language, $structure_url, $page_language));
    // Aoloe\debug('navigation', $navigation->get_navigation_rendered($site_structure, $site_language, $structure_url, $page_language));
    $page_navigation = $template->fetch('template/navigation.php');
    $template->clear();
    $template->set('navigation', $navigation->get_navigation_language_rendered($site_structure, $site_language, $structure_url, $page_language));
    $page_navigation_language = $template->fetch('template/navigation_language.php');
}

if ($route->get_url_structure() == 'splash') {
    // $template->clear();
    // $content_footer = $template->fetch('template/page_splash_footer.php');
} else {
    $markdown = new Aoloe\Markdown();
    /*
    $content_footer = file_get_contents('content/footer.yaml');
    $content_footer = Spyc::YAMLLoadString($content_footer);
    $content_footer = $content_footer[$page_language];
    // Aoloe\debug('content_footer', $content_footer);
    $markdown->set_text("{.right}\n".$content_footer);
    $content_footer = $markdown->parse();
    */
    $footer = $markdown->parse('content/'.$page_language.'/footer.md');
    $template->clear();
    $template->set('language', $page_language);
    $template->set('footer', $footer);
    $content_footer = $template->fetch('template/page_footer.php');
}
// Aoloe\debug('content_footer', $content_footer);

// debug('page_query', $page_query);
$module = new Aoloe\Module();
$module->set_page($page);
$module->set_page_url($route->get_url_structure());
$module->add_parameter($page_query);
$module->add_parameter(array('language' => $page_language));
$module->set_site($site);
$content_page = $module->get_rendered();
// debug('content_page', $content_page);

$template->clear();
$template->set('language', $page_language);
$template->set('title', $page_title);
$template->set('favicon', 'images/favicon.png');
$template->set('path', $site->get_path_relative());
$template->set('fonts', $site->get_font());
$template->set('js', $site->get_js());
$template->set('css', $site->get_css());
$template->set('navigation', $page_navigation);
$template->set('navigation_language', $page_navigation_language);
$template->set('content', $content_page);
$template->set('footer', $content_footer);
echo $template->fetch('template/contesto.php');
