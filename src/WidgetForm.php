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
        Asset::script('HTTP');

        echo <<<EOT
            <form id="mgb_rating_form" class="mgb_widget_rating">
                <section class="mgb_widget_field_container">
                    <textarea rows="5" class="mgb_rating_field" name="mgb_rating_message" placeholder="Message">c nul</textarea>
                    <input class="mgb_rating_field" name="mgb_rating_author" type="text" value="Le connard" placeholder="Name">
                </section>
                <input id="mgb_rating_form_submit" type="submit" value="SEND">
            </form>
        EOT;

        Asset::script('widget');

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