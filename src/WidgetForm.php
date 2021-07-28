<?php

namespace MyGuestBook;
use WP_Widget;

class WidgetForm extends WP_Widget
{

    function __construct()
    {
        parent::__construct('MyGuestBook_Widget_Form', 'MyGuestBook Form');
    }

    public function widget( $args, $instance )
    {
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        if (!empty( $title )) echo $args['before_title'] . $title . $args['after_title'];

        Asset::style('widget');

        echo <<<EOT
            <form class="mgb_widget_rating" method="post">
                <section class="mgb_widget_field_container">
                    <textarea rows="5" name="mgb_rating_message" type="text" placeholder="Message..." required></textarea>
                    <input name="mgb_rating_author" type="text" placeholder="Name..."/>
                </section>
                <input type="submit" value="SEND">
            </form>
        EOT;

        echo $args['after_widget'];
    }

    public function form( $instance )
    {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'New title', 'wpb_widget_domain' );
        }

        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance )
    {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }

}