<?php

/*
 * Offer Request
 * Source language:
 * Target languages:
 * Required delivery time:
 * Document to be translated:
 * Company:
 * Contact person: First name: Name: 
 * Address:
 * ZIP: City: Phone:
 * Fax:
 * Email:
 * Comments:
 */

// use function Aoloe\debug as debug;

class Quote extends Aoloe\Module_abstract {
    public function get_content() {
        $result = "";

        $template = new Aoloe\Template();
        new Aoloe\Translation();

        $contact_form = new Aoloe\Contact_form();
        // $contact_form->set_mail_to('a.l.e@contesto.ch');
        $contact_form->set_mail_to('traduzioni@contesto.ch');
        // $contact_form->set_mail_to('a.l.e@xox.ch');
        // $contact_form->set_mail_from('ale@contesto.ch');
        $contact_form->set_subject_prefix('[contesto:contatto] ');
        $contact_form->set_subject(tr('Request a quote'));
        $contact_form->clear_field_request();
        $contact_form->add_field_request('language_source');
        $contact_form->add_field_request('language_target');
        $contact_form->add_field_request('delivery_time');
        $contact_form->add_field_request('company');
        $contact_form->add_field_request('name');
        $contact_form->add_field_request('address');
        $contact_form->add_field_request('city');
        $contact_form->add_field_request('phone');
        $contact_form->add_field_request('fax');
        $contact_form->add_field_request('email');
        $contact_form->add_field_request('comments');
        $contact_form->add_field_request_file('document');
        $contact_form->set_field_required('language_source');
        $contact_form->set_field_required('language_target');
        $contact_form->set_field_required('name');
        $contact_form->set_field_required('email');
        $show_form = true;
        Aoloe\Translation::read('content/translation_content_quote.yaml', $this->language);
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
                    $show_form = false;
                    // Aoloe\debug('_REQUEST', $_REQUEST);
                    // TODO: correctly show the sent page
                    $template->clear();
                    // $template->set('path', $path);
                    $page_content = $template->fetch('template/content_quote_sent.php');
                } else {
                    // TODO: prepare the fields passed to the form in order to show an error message
                }
            }
        } else {
        }
        // Aoloe\debug('show_form', $show_form);
        if ($show_form) {
            $template->clear();
            $template->set('path', $this->site->get_path_relative());
            // TODO: show the contact form with error messages
            // TODO: prefill the form with the fields value as read from the post
            $template->set('post_prefix', $contact_form->get_request_prefix());
            $page_content = $template->fetch('template/content_quote.php');
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
