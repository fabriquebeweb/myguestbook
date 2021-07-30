<?php

namespace MyGuestBook;
use WP_Widget;

class WidgetForm extends WP_Widget
{

    function __construct()
    {
        parent::__construct('MyGuestBook_Widget_Form', 'MyGuestBook Form');
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $author = (!(bool) apply_filters('widget_title', $instance['author'])) ? '' : <<<EOT
        <input class="mgb_rating_field" name="mgb_rating_author" type="text" placeholder="Name">
        EOT;
        $moderation = ((bool) apply_filters('widget_title', $instance['moderation'])) ? 'true' : 'false';
        
        echo $args['before_widget'];
        if (!empty($title)) echo $args['before_title'] . $title . $args['after_title'];

        echo <<<EOT
            <form id="mgb_rating_form" class="mgb_widget_rating">
                <section class="mgb_widget_field_container">
                    <textarea rows="5" id="mgb_rating_field_required" class="mgb_rating_field" name="mgb_rating_message" placeholder="Message"></textarea>
                    ${author}
                    <input class="mgb_rating_field mgb_widget_hidden" name="mgb_rating_moderation" type="text" value="${moderation}">
                </section>
                <input id="mgb_rating_form_submit" type="submit" value="SEND">
            </form>
        EOT;

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = esc_attr((isset($instance['title'])) ? $instance['title'] : __('My title', 'wpb_widget_domain'));        
        $title_name = $this->get_field_name('title');
        $title_id = $this->get_field_id('title');
        $author = (isset($instance['author'])) ? $instance['author'] : 'false';
        $author_name = $this->get_field_name('author');
        $author_id = $this->get_field_id('author');
        $moderation = (isset($instance['moderation'])) ? $instance['moderation'] : 'false';
        $moderation_name = $this->get_field_name('moderation');
        $moderation_id = $this->get_field_id('moderation');

        echo <<<EOT
            <p>
                <label for="${title_id}">Title</label> 
                <input class="widefat" id="${title_id}" name="${title_name}" type="text" value="${title}">
            </p>
            <p>
                <label for="${author_id}">Ask author name ?</label> 
                <input class="widefat" id="${author_id}" name="${author_name}" type="checkbox" checked="${author}">
            </p>
            <p>
                <label for="${moderation_id}">Moderation ?</label> 
                <input class="widefat" id="${moderation_id}" name="${moderation_name}" type="checkbox" checked="${moderation}">
            </p>
        EOT;
    }

}