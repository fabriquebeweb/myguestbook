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

        echo $args['before_widget'];
        if ( ! empty( $title ) ) echo $args['before_title'] . $title . $args['after_title'];

        Asset::style('widget');

        foreach(self::ratings() as $rating)
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

    // Widget Backend 
    public function form( $instance )
    {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'New title', 'wpb_widget_domain' );
        }

        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    private static function ratings()
    {
        $ratings = Database::list("SELECT * FROM ? WHERE state = true ORDER BY time DESC LIMIT 5");
        return ($ratings) ? array_map(Plugin::SPACE . 'Database::format', $ratings) : [];
    }

}