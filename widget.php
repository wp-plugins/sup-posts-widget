<?php
/**
 * @package Sup Post Widget
 */
 
class sup_posts_sidebar_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'sup_posts_sidebar_widget',
			__( 'Posts Widget' ),
			array( 'description' => __( 'Display the number of Popular, Latest and Random Posts' ) )
		);

		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_head', array( $this, 'css' ) );
		}
	}
function css() {
?>
 
<?php }

	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance['title'] );
		}
		else {
			$title = __( '' );
		}
?>
		<p>

		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />

		</p>

<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function widget( $args, $instance ) {

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'];
			echo esc_html( $instance['title'] );
			echo $args['after_title'];
		}
?>

 
 <?php echo spw_display(''); ?>
 

<script type="text/javascript">
tabview_initialize('TabView');
</script>

<?php
		echo $args['after_widget'];
	}
}
function register_sup_posts_sidebar_widget() {
	register_widget( 'sup_posts_sidebar_widget' );
}

add_action( 'widgets_init', 'register_sup_posts_sidebar_widget' );


