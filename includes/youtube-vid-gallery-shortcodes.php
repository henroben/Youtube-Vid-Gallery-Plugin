<?php
	// List Videos
	function yvg_list_videos($atts, $content = null) {
		global $post;

		$atts = shortcode_atts(array(
				'title'     => 'Video Gallery',
				'count'     => 20,
				'category'  => 'all'
			), $atts);

		// Check Category
		if($atts['category'] == 'all') {
			$terms = '';
		} else {
			$terms = array(
				array(
					'taxonomy'  => 'category',
					'field'     => 'slug',
					'terms'     => $atts['category']
				)
			);
		}

		// Query Args
		$args = array(
			'post_type'     => 'video',
			'post_status'   => 'published',
			'orderby'       => 'created',
			'order'         => 'ASC',
			'post_per_page' => $atts['count'],
			'tax_query'     => $terms
		);

		// Fetch Videos
		$videos = new WP_Query($args);

		// Check For Videos
		if($videos->have_posts()) {
			$category = str_replace('-', ' ', $atts['category']);

			// Init Output
			$output = '';

			// Build Output
			$output .= '<div class="video-list">';

			while($videos->have_posts()) {
				$videos->the_post();

				// Get Field Values
				$video_id = get_post_meta($post->ID, 'video_id', true);
				$details = get_post_meta($post->ID, 'details', true);

				$output .= '<div class="yvg-video">';
				$output .= '<h4>' . get_the_title() . '</h4>';
				$output .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
				$output .= '<div>' . $details . '</div>';
				$output .= '</div><br><hr>';
			}

			$output .= '</div>';

			// Reset Post Data
			wp_reset_postdata();

			return $output;

		} else {
			return '<p>No Videos Found.</p>';
		}
	}

	// Video List Shortcode
	add_shortcode('videos', 'yvg_list_videos');