<?php

// use function Aoloe\debug as debug;

class Contact extends Aoloe\Module_abstract {
    public function get_content() {
        $result = "";

        $template = new Aoloe\Template();

        $contact_form = new Aoloe\Contact_form();
        $field_post = array();
        // $contact_form->set_mail_to('a.l.e@contesto.ch');
        $contact_form->set_mail_to('traduzioni@contesto.ch');
        // $contact_form->set_mail_to('a.l.e@xox.ch');
        // $contact_form->set_mail_from('ale@contesto.ch');
        $contact_form->set_subject_prefix('[contesto:contatto] ');
        $show_form = true;
        if ($contact_form->is_submitted()) {
            $contact_form->read();
            if (!$contact_form->is_valid()) {
                // debug('_REQUEST', $_REQUEST);
            } else {
                $sent = true;
                if (!$contact_form->is_spam()) { // if is spam do not send put show the sent page
                    $sent = $contact_form->send();
                }
                // Aoloe\debug('sent', $sent);
                if ($sent) {
                    Aoloe\Translation::read('content/translation_content_contact.yaml', $this->language);
                    $show_form = false;
                    // Aoloe\debug('_REQUEST', $_REQUEST);
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
        // Aoloe\debug('show_form', $show_form);
        if ($show_form) {
            Aoloe\Translation::read('content/translation_content_contact.yaml', $this->language);
            $template->clear();
            $template->set('path', $this->site->get_path_relative());
            // TODO: show the contact form with error messages
            // TODO: prefill the form with the fields value as read from the post
            $template->set('post_prefix', $contact_form->get_request_prefix());
            $page_content = $template->fetch('template/content_contact.php');
            $this->site->add_css('css/content_contact.css');
        }
        // Aoloe\debug('page_content', $page_content);



        include_once('module/Page.php');
        $page_module = new Page();
        $page_module->set_site($this->site);
        $page_module->set_language($this->language);
        $page_module->set_page_content($page_content);
        $result = $page_module->get_content();
        return $result;
    }
}
