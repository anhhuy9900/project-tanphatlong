<?php

// Creating the widget
class tpl_map_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'wpb_widget',

            // Widget name will appear in UI
            __('Map Contact Widget', 'wpb_widget_domain'),

            // Widget description
            array( 'description' => __( 'Map Contact Widget', 'wpb_widget_domain' ), )
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $latitude = apply_filters( 'widget_lat', $instance['latitude'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $latitude ) )
            echo $args['before_latitude'] . $latitude . $args['after_latitude'];

        $longtitude = apply_filters( 'widget_lat', $instance['longtitude'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $longtitude ) )
            echo $args['before_longtitude'] . $longtitude . $args['after_longtitude'];

    // This is where you run the code and display the output
        echo __( 'Hello, World!', 'wpb_widget_domain' );
        echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'latitude' ] ) ) {
            $latitude = $instance[ 'latitude' ];
        }
        else {
            $latitude = __( 'New latitude', 'wpb_widget_domain' );
        }
        if ( isset( $instance[ 'longtitude' ] ) ) {
            $longtitude = $instance[ 'longtitude' ];
        }
        else {
            $longtitude = __( 'New longtitude', 'wpb_widget_domain' );
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'latitude' ); ?>"><?php _e( 'Latitude:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'latitude' ); ?>" name="<?php echo $this->get_field_name( 'latitude' ); ?>" type="text" value="<?php echo esc_attr( $latitude ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'longtitude' ); ?>"><?php _e( 'Longtitude:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'longtitude' ); ?>" name="<?php echo $this->get_field_name( 'longtitude' ); ?>" type="text" value="<?php echo esc_attr( $longtitude ); ?>" />
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['latitude'] = ( ! empty( $new_instance['latitude'] ) ) ? strip_tags( $new_instance['latitude'] ) : '';
        $instance['longtitude'] = ( ! empty( $new_instance['longtitude'] ) ) ? strip_tags( $new_instance['longtitude'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here
