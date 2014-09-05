<?php

class Navigation {

    public function get_navigation_rendered($site_structure, $site_language, $structure_url, $page_language) {
        $navigation = array();
        // add the menu entries for the current language
        foreach ($site_structure as $key => $value) {
            // Aoloe\debug('key', $key);
            // Aoloe\debug('structure_url', $structure_url);
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

    public function get_navigation_language_rendered($site_structure, $site_language, $structure_url, $page_language) {
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
        return $navigation;
    }
}
