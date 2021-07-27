<?php

namespace MyGuestBook;
use WP_Widget;

class Widget extends WP_Widget
{

    public function __construct() 
    {
        parent::__construct('MyGuestBook_Widget', 'MyGuestBook Widget');
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('mgbwidget_title', $instance['title']);

        echo $args['before_widget'];
        if ( ! empty( $title ) ) echo $args['before_title'] . $title . $args['after_title'];

        foreach(self::messages() as $message)
        {
            echo '<div style="border: 1px solid grey; padding-left: 1em;">
            <p> <strong> nom:  </strong>' . $message->name . '</p> 
            <p> <strong> message: </strong> ' . $message->message.' </p> 
            <p> <strong> date: </strong> ' . $message->time.' </p>
            </div>';
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

    private static function messages()
    {
        $messages = Database::list("SELECT * FROM ? WHERE state = true ORDER BY time DESC LIMIT 5");
        return ($messages) ? $messages : [];
    }

}