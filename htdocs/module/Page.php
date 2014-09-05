<?php

// use function Aoloe\debug as debug;

class Page extends Aoloe\Module_abstract {
    private $page_content = null;
    public function set_page_content($content) {$this->page_content = $content;}
    public function get_content() {
        $this->site->add_js('js/jquery-2.1.1.min.js');
        $this->site->add_js('js/jquery.hammer.min.js');
        $this->site->add_js('js/jquery.superslides.min.js');
        $this->site->add_css('css/superslides.css');
        $this->site->add_css('css/font-awesome.css');

        $this->site->add_css('css/ego.css');
        $this->site->add_css('css/contesto.css');
        $this->site->add_font('http://fonts.googleapis.com/css?family=Open+Sans:400,700');
        $this->site->add_font('http://fonts.googleapis.com/css?family=Anton');

        $markdown = new Aoloe\Markdown();

        $page_content = "";
        if (isset($this->page_content)) {
            $page_content = $this->page_content;
        } else {
            $markdown->clear();
            $markdown->set_url_img_prefix($this->site->get_path_relative('content/'));
            $markdown->set_url_a_prefix($this->site->get_path_relative());
            // debug('language', $this->language);
            // debug('page_url', $this->page_url);
            // debug('filter', $this->filter);
            $file_name = 'content/'.$this->language.'/'.$this->page_url.'.md';
            if (isset($this->filter)) {
                if (file_exists($file_name)) {
                    include_once('library/Filter.php');
                    $page_content = file_get_contents($file_name);
                    foreach ($this->filter as $item) {
                        $filter = new Filter();
                        $filter->set_language($this->language);
                        $filter->set_filter($item);
                        $page_content = $filter->parse($page_content);
                    }
                    $markdown->set_text($page_content);
                    $page_content =  $markdown->parse();
                }
            } else {
                // debug('file_name', $file_name);
                $page_content =  $markdown->parse($file_name);
                // debug('page_content', $page_content);
            }
        }

        $template = new Aoloe\Template();
        $template->set('content', $page_content);
        $result = $template->fetch('template/index.php');
        return $result;
    }
}
