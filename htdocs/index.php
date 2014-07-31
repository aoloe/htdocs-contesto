<?php
$debug_log = true;

include_once('lib/debug.php');

// debug('_REQUEST', $_REQUEST);
// debug('_SERVER', $_SERVER);
// die();
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

$structure_url = null;
$page = null;
$page_language = null;
$page_title = null;
$page_url = null; // probably unused
$page_template = null;
$page_css = array();
$page_js = array();
$page_fonts = array();
$page_navigation = null;
$page_content = null;

if (array_key_exists('page', $_REQUEST)) {
    $page = $_REQUEST['page'];
}
// debug('page', $page);

// we are using REQUEST_URI instead of ?page for now
$request_url = null;
$request_language = array_slice(explode('/', $_SERVER['REQUEST_URI']), 1, 1);
$request_language = reset($request_language);

if (!empty($request_language)) {
    if (array_key_exists($request_language, $site_language)) {
        $request_url = array_slice(explode('/', $_SERVER['REQUEST_URI']), 2, 1);
        $request_url = reset($request_url);
    } else {
        $request_language = null;
        $request_url = array_slice(explode('/', $_SERVER['REQUEST_URI']), 1, 1);
        $request_url = reset($request_url);
    }
} else {
    $request_language = null;
}
// debug('request_language', $request_language);
// debug('request_url', $request_url);

include_once('lib/cookie.php');
include_once('lib/language_detector.php');
$language = new Language_detector();
$language->set_valid(array_keys($site_language));
$language->set_cookie_manager(Cookie::factory());
if (isset($request_language)) {
    $language->set_request_language($request_language);
}
$page_language = $language->get();
// debug('page_language', $page_language);

// debug('page_language', $page_language);

if (isset($request_url) && array_key_exists($request_url, $site_structure)) {
    $page_url = $request_url;
    $structure_url = $request_url;
    if (array_key_exists('navigation', $site_structure[$request_url]) && array_key_exists($page_language, $site_structure[$request_url]['navigation'])) {
        $page_title = $site_structure[$request_url]['navigation'][$page_language]['label'];
    }
} else {
    foreach ($site_structure as $key => $value) {
        if (!empty($value) && array_key_exists('navigation', $value) && array_key_exists($page_language, $value['navigation']) && ($value['navigation'][$page_language]['url'] == $request_url)) {
            $page_url = $request_url;
            $structure_url = $key;
            $page_title = $value['navigation'][$page_language]['label'];
            break;
        }
    }
}

if (is_null($structure_url)) {
    if (is_null($request_language)) {
        $page_url = 'splash';
        $structure_url = 'splash';
    } else {
        $page_url = 'about';
        $structure_url = 'about';
    }
}
// debug('page_url', $page_url);
// debug('structure_url', $structure_url);

function get_navigation_rendered($site_structure, $site_language, $structure_url, $page_language) {
    $navigation = array();
    foreach ($site_language as $key => $value) {
        $navigation_item = array();
        $navigation_item['href'] = '/'.$key.'/';
        $navigation_item['label'] = $value;
        if ($key == $page_language) { // if it is the current page
            $navigation_item['current'] = true;
        } else {
            $navigation_item['children'] = array();
            foreach ($site_structure as $kkey => $vvalue) {
                // debug('navigation', $vvalue['navigation']);
                if (!empty($vvalue) && array_key_exists('navigation', $vvalue) && $vvalue['navigation']) {
                    $navigation_item['children'][] = array (
                        'href' => '/'.$key.'/'.$vvalue['navigation'][$key]['url'],
                        'label' => $vvalue['navigation'][$key]['label'],
                    );
                }
            }
        }
        $navigation[] = $navigation_item;
    }

    // add the menu entries for the current language
    foreach ($site_structure as $key => $value) {
        if (!empty($value) && array_key_exists('navigation', $value) && $value['navigation']) {
            $navigation[] = array (
                'href' => '/'.$page_language.'/'.$value['navigation'][$page_language]['url'],
                'label' => $value['navigation'][$page_language]['label'],
                'current' => ($key == $structure_url),
            );
        }
    }
    return $navigation;
}


if ($structure_url != 'splash') {
    $template->set('navigation', get_navigation_rendered($site_structure, $site_language, $structure_url, $page_language));
    $page_navigation = $template->fetch('template/navigation.php');
}

function get_csv_renderered($content, $placeholder, $path_csv, $path_template) {
    $result = "";
    $table = array();
    if (($handle = fopen($path_csv, "r")) !== FALSE) {
        while ($row = fgetcsv($handle)) {
            $row = str_replace("\n", "<br>\n", $row);
            $table[] = $row;
        }
        fclose($handle);
    }
    // debug('table', $table);
    $template = new Template();
    $template->clear();
    $template->set('table', $table);
    $result = $template->fetch($path_template);
    $result = str_replace($placeholder, $result, $content);
    return $result;
}

// debug('structure_url', $structure_url);
if ($structure_url == 'splash') {
    $page_template = 'page_splash.php';
    $page_js[] = $path.'js/jquery-2.1.1.min.js';
    $page_js[] = $path.'js/jquery.hammer.min.js';
    $page_js[] = $path.'js/jquery.superslides.min.js';
    $page_css[] = $path.'css/superslides.css';
    $page_fonts[] = $path.'css/font-awesome.css';
    // $page_fonts[] = "//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css";
    /*
    $page_template = 'splash.php';
    $page_css[] = $path.'css/flexslider.css';
    $page_css[] = $path.'css/simpliste.css';
    $page_js[] = $path.'js/jquery-2.1.1.min.js';
    $page_js[] = $path.'js/modernizr.js';
    $page_js[] = $path.'js/jquery.flexslider-min.js';
    */
} else {
    $page_css[] = $path.'css/ego.css'; // for  the menues
    $page_css[] = $path.'css/contesto.css';
    $page_fonts[] = "http://fonts.googleapis.com/css?family=Open+Sans:400,700";
    $page_fonts[] = "http://fonts.googleapis.com/css?family=Anton";
    $page_template = 'index.php';
    $template->clear();

    if ($structure_url == 'contact') {
        include_once('lib/contact_form.php');
        $contact_form = new Contact_form();
        $field_post = array();
        // $contact_form->set_mail_to('a.l.e@contesto.ch');
        $contact_form->set_mail_to('ale@xox.ch');
        // $contact_form->set_mail_from('ale@contesto.ch');
        $contact_form->set_subject_prefix('[contesto:contatto] ');
        $show_form = true;;
        if ($contact_form->is_submitted()) {
            $contact_form->read();
            if (!$contact_form->is_valid()) {
                // debug('_REQUEST', $_REQUEST);
            } else {
                $sent = true;
                if (!$contact->is_spam()) { // if is spam do not send put show the sent page
                    $sent = $contact_form->send();
                }
                if ($sent) {
                    $show_form = false;
                    debug('_REQUEST', $_REQUEST);
                    // TODO: correctly show the sent page
                    $template->clear();
                    // $template->set('path', $path);
                    $page_content = $template->fetch('template/content_contact_sent.php');
                } else {
                    // TODO: prepare the fields passed to the form in order to show an error message
                }
            }
        } else {
        }
        if ($show_form) {
            include_once('lib/translation.php');
            Translation::read('content/translation_content_contact.yaml', $page_language);
            $template->clear();
            $template->set('path', $path);
            // TODO: show the contact form with error messages
            // TODO: prefill the form with the fields value as read from the post
            $template->set('post_prefix', $contact_form->get_request_prefix());
            $page_content = $template->fetch('template/content_contact.php');
            $page_css[] = $path.'css/content_contact.css';
        }
    } else {
        $file_content = 'content/'.$page_language.'/'.$structure_url.'.md';
        if (file_exists($file_content)) {
            $content = file_get_contents($file_content);
            $page_content = Markdown($content);
        }
        if ($structure_url == 'prices') {
            $page_content = get_csv_renderered($page_content, '<!-- %prices_translation% -->', 'content/en/prices_translation.csv', 'template/content_prices_table.php');
            $page_content = get_csv_renderered($page_content, '<!-- %prices_interpretation% -->', 'content/en/prices_interpretation.csv', 'template/content_prices_table.php');
        }
    }
}

$template->clear();
$template->set('language', $page_language);
$template->set('navigation', $page_navigation);
$template->set('content', $page_content);
$page_body = $template->fetch('template/'.$page_template);

$template->clear();

$template->set('favicon', $path.'images/favicon.png');
$template->set('language', $page_language);
$template->set('title', $page_title);
$template->set('js', $page_js);
$template->set('css', $page_css);
$template->set('fonts', $page_fonts);
$template->set('content', $page_body);
echo $template->fetch('template/contesto.php');
