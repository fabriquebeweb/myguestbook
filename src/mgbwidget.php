<?php
class Mgbwidget extends WP_Widget {
    public function __construct() 
    {
        parent::__construct('Mgbwidget', 'myguestbook widget');
    }

    public function widget($arg, $instance) {
        $title = apply_filters('mgbwidget_title', $instance['title']);
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        
        // This is where you run the code and display the output
        echo __( 'Hello, World! ', 'wpb_widget_domain' );
        getMessage();
        echo $args['after_widget'];

   
    }

    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
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
}

 // Get the 5 last messages from db

function getMessage() {
    global $wpdb;
    $sql = "SELECT * FROM ap_myguestbook ORDER BY time DESC LIMIT 5";
    $messages = $wpdb->get_results( $sql );
    if( $messages ) { 
      foreach( $messages as $message ) { 
        echo '<p> ' . $message->name . ' ' . $message->message.' </p>';
     
      }
}

}




function wpb_load_widget() {
    register_widget( 'Mgbwidget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
