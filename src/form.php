<?
include_once('send.php');
class custom_widget extends WP_Widget {
    
    function __construct() {
        parent::__construct(
            // widget ID
            'custom_widget',
            // widget name
            __('Guest Book Widget', ' custom_widget_domain'),
            // widget description
            array( 'description' => __( 'guest book to help rating a restaurant', 'custom_widget_domain' ), )
        );
    }

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        //if title is present
        if (!empty( $title )) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>
            <form action="" method="post">
                <div>
                    <H4 for="message">Thx, for rating the restaurant !</H4>
                    <input name="widget" type="text" placeholder="Enter your message..."/> <br>
                    <input name="widget" type="text" placeholder="Enter your name..."/> <br>
                </div> 
                <button type="submit">Send</button>
            </form> <br>
        <?
        echo __( 'Greets to BeWeb', 'custom_widget_domain' );
        echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}

function widget_register() {
    register_widget( 'custom_widget' );
}
add_action( 'widgets_init', 'widget_register' );
