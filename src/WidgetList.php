<?php

namespace MyGuestBook;
use WP_Widget;

class WidgetList extends WP_Widget
{

    public function __construct() 
    {
        parent::__construct('MyGuestBook_Widget_List', 'MyGuestBook List');
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('mgbwidget_title', $instance['title']);
        $rows = (int) apply_filters('mgbwidget_title', $instance['rows']);

        echo $args['before_widget'];
        if ( ! empty( $title ) ) echo $args['before_title'] . $title . $args['after_title'];
        
        foreach(self::ratings($rows) as $rating)
        {
            echo <<<EOT
                <article class="mgb_widget_rating">
                    <h6>" $rating->message "</h6>
                    <p><strong>$rating->author</strong>, $rating->time</p>
                </article>
            EOT;
        }

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = esc_attr((isset($instance['title'])) ? $instance['title'] : __('My title', 'wpb_widget_domain'));        
        $num = esc_attr((isset($instance['num'])) ? $instance['num'] : __('', 'wpb_widget_domain'));
        $title_name = $this->get_field_name('title');
        $num_name = $this->get_field_name('num');
        $title_id = $this->get_field_id('title');
        $num_id = $this->get_field_id('num');

        echo <<<EOT
            <p>
                <label for="${title_id}">Title</label> 
                <input class="widefat" id="${title_id}" name="${title_name}" type="text" value="${title}">
            </p>
            <p>
                <label for="${num_id}">Number ( leave empty for all )</label> 
                <input class="widefat" id="${num_id}" name="${num_name}" type="text" value="${num}">
            </p>
        EOT;
    }

    private static function ratings(int $rows = 0)
    {
        $limit = ($rows) ? " LIMIT ${rows}" : '';
        $ratings = Database::list("SELECT * FROM ? WHERE state = true ORDER BY time DESC" . $limit);
        return ($ratings) ? array_map(Plugin::SPACE . 'Database::format', $ratings) : [];
    }

}