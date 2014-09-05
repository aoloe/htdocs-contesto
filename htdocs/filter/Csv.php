<?php

// use function Aoloe\debug as debug;

class Csv extends Filter_abstract {

    private function get_csv_renderered($content, $path_csv, $path_template) {
        // , $placeholder
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
        $template = new Aoloe\Template();
        $template->clear();
        $template->set('table', $table);
        $result = $template->fetch($path_template);
        return $result;
    }

    public function parse($content) {
        $result = '';
        $parameter = array();
        if (isset($this->parameter)) {
            $parameter = explode(',', $this->parameter);
            if (count($parameter) == 1) {
                $parameter[1] = $parameter[0];
            }
        }
        // debug('parameter', $this->parameter);
        $filename_csv = null;
        foreach (array('content/'.$parameter[0].'.csv', 'content/'.$this->language.'/'.$parameter[0].'.csv') as $item) {
            if (file_exists($item)) {
                $filename_csv = $item;
            }
        }
        // debug('filename_csv', $filename_csv);
        $result = $this->get_csv_renderered($content, $filename_csv, 'template/'.$parameter[1].'.php');
        return $result;
    }
}
