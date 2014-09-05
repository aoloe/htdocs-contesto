<?php
// use function Aoloe\debug as debug;

class Splash extends Aoloe\Module_abstract {
    public function get_content() {
        $this->site->add_js('js/jquery-2.1.1.min.js');
        $this->site->add_js('js/jquery.hammer.min.js');
        $this->site->add_js('js/jquery.superslides.min.js');
        $this->site->add_css('css/superslides.css');
        $this->site->add_css('css/font-awesome.css');
        $this->site->add_css('css/font-univers.css');

        $template = new Aoloe\Template();
        $template->set('traduzioni_it', $this->get_traduzioni('it'));
        $template->set('traduzioni_de', $this->get_traduzioni('de'));
        $template->set('traduzioni_fr', $this->get_traduzioni('fr'));
        $template->set('traduzioni_en', $this->get_traduzioni('en'));
        $result = $template->fetch('template/page_splash.php');
        return $result;
    }

    private $traduzioni = array (
        'it' => 'Traduzioni',
        'de' => 'Übersetzungen',
        'fr' => 'Traductions',
        'en' => 'Translations',
    );

    private function get_traduzioni($language) {
        $string = array();
        foreach ($this->traduzioni as $key => $value) {
            $string[] = '<a href="'.$key.'/"'.($key == $language ? ' class="active"' : '').'>'.$value.'</a>';
        }
        return implode("\n", $string);
    }
}
