<!-- ==================================================================================================
  ACF Short code
================================================================================================== -->

1. For Future image  ======= 
<?php the_post_thumbnail('full'); ?>
----------------------------------------------------------------------------------------------------------
2. Any field call on page use below code  ======= 
<?php echo get_field('Add your field name'); ?> 
<!--field name so add your field name in bracket-->

----------------------------------------------------------------------------------------------------------
// Short Code get contact form, revolution slider, Get post etc etc 
 <?php echo do_shortcode('[contact-form-7 id="87" title="REQUEST A QUOTE" html_id="wpcf7-f87-o11" html_class="request-form"]');?>

----------------------------------------------------------------------------------------------------------
3. Slider  ======= 
<?php
	$images = get_field('Add your field name'); if( $images ): $images = explode(',', $images); 
?>
<div class="slider_sec">
    <?php foreach( $images as $image ): ?>
        <div>
           <?php echo wp_get_attachment_image($image); ?>
        </div>
    <?php endforeach; endif; ?>
</div>
----------------------------------------------------------------------------------------------------------
4. Get Post ======= 
<?php 
$posts = get_posts(array(
	'posts_per_page'	=> 3,
	'post_type'			=> 'post'  //Add here post title like event, testimonials etc
));
if( $posts ): ?>
	<ul>  
	<?php foreach( $posts as $post ): 
		setup_postdata( $post );
		
		?>
		<li>
			<a href="<?php the_permalink(); ?>">
				<img src="<?php the_field('event_thumbnail'); ?>" />
				<?php the_title(); ?>
			</a>
		</li>
	<?php endforeach; ?>
	</ul>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>
----------------------------------------------------------------------------------------------------------
4. Get recent post and blog list Post with Pagination ======= 

<section id="recent-post">
	<div class="container-fluid">
		<div class="row">
			<?php
		    $recent_posts = wp_get_recent_posts(array(
		        'numberposts' => 1,
		        'post_status' => 'publish',
		    ));
		    foreach($recent_posts as $post) : ?>
		        <div class="col-lg-7 col-md-6 col-sm-12">
		        	<div class="recent-post-img text-center">
		        		<?php echo get_the_post_thumbnail($post['ID'], 'full'); ?>
		        	</div>
		        </div>

		        <div class="col-lg-5 col-md-6 col-sm-12 blogs">
		        	<span class="post-date"><?php echo get_field('release_date', $post['ID']); ?></span>
		        	<h3><?php echo $post['post_title'] ?></h3>
		        	<p><?php echo $post['post_excerpt'] ?></p>
		            <a class="read-more-btn" href="<?php echo get_permalink($post['ID']) ?>">
		             	read more
		            </a>
	        	</div>
		    <?php endforeach; wp_reset_query(); ?>
		</div>
    </div>
</section>

<section id="blog-list">
	<div class="container-fluid">
		<div class="row">
			<?php while ( have_posts() ) : the_post(); ?> 

			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$args = array( 
				'post_type'			=> 'post',
				// 'order' 			=> 'ASC',
				'posts_per_page'	=> 9,
				//'posts_per_page'	=> ($paged ==1 ? 10 : 9 ),
				'paged' 			=> $paged
			);

			$catpost_ = new WP_Query( $args );
			if ($catpost_->have_posts() ) : 
			if( $paged ==1 ) : $i=0; else: $i=1; endif;
				while ($catpost_->have_posts() ) : $catpost_->the_post(); if($i > 0 ){ ?>
		            <div class="single-post">
		              <div class="inner">
		                <span class="pot-date">May 14, 2020</span>
		                <a href="<?php the_permalink(); ?>">
		                  <h4>
		                    <?php the_title(); ?>
		                  </h4>
		                </a>
		                <h6><?php echo get_field('small_title'); ?></h6>
		                <div class="text color-gray">
		                  <p><?php the_excerpt(); ?></p>
		                </div>
		                <div class="btn-wrapepr">
		                  <a href="<?php the_permalink(); ?>" class="btn btn-fill bg-black-btn bg-ligt-black-btn"><span><span>Read More</span></span><label></label></a>
		                </div>
		              </div>
		            </div>
				<?php } $i++; endwhile;  endif; wp_reset_query();?>
			<?php
			$big=76;
				$args = array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'       => '?paged=%#%',
					'total'        => $catpost_->max_num_pages,
					'current'      => $paged,
					'prev_next'    => True,
					'prev_text'    => __('<i class="fas fa-chevron-left"></i>'),
					'next_text'    => __('<i class="fas fa-chevron-right"></i>'),
					'type'         => 'list'); 
				echo paginate_links( $args );
			endwhile;
			?>
		</div>
	</div>
</section>

----------------------------------------------------------------------------------------------------------
4. Get recent post and blog list Post without Pagination =======

<<section class="bg-body blog-section objAnimate-wrapper" data-trigger="1">
	<div class="container">
		<div class="first-post box-padding bg-ligt-black page-banner-animate-2">
			<?php
			$recent_id=array();
			   $recent_posts = wp_get_recent_posts(array(
			        'numberposts' => 1,
			        'post_status' => 'publish',
					'order'		  => 'DESC'
		    ));
		    foreach($recent_posts as $post) : 
		    	$recent_id[]=$post['ID'];
		    	?>
		     	<span class="pot-date">
		     		<?php echo get_the_date('F j Y', $post['ID']); ?>
		     	</span>
	            <a href="<?php the_permalink($post['ID']); ?>">
	              <h1><?php echo $post['post_title'] ?></h1>
	            </a>
	            <h4><?php echo get_field('small_title',$post['ID']); ?></h4>
	            <div class="text color-gray">
	              <p><?php echo $post['post_excerpt'] ?></p>
	            </div>
	            <div class="btn-wrapepr">
	              <a href="<?php the_permalink($post['ID']); ?>" class="btn btn-fill bg-black-btn"><span><span>Read More</span></span><label></label></a>
	            </div>  
		    <?php endforeach; wp_reset_query(); ?>
		</div>
	</div>

	<div class="container">
		<div class="blog-listing">
		
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$args = array( 
				'post_type'		 => 'post',
				'order' 		 => 'ASC',
				'paged' 		 => $paged,
				'posts_per_page' => -1,
				'post__not_in'   =>$recent_id,
			);

			$catpost_ = new WP_Query( $args );
			if ($catpost_->have_posts() ) : 
				while ($catpost_->have_posts() ) : $catpost_->the_post();  ?>
		            <div class="single-post">
		              <div class="inner">
		                <span class="pot-date"><?php echo get_the_date('F j Y', get_the_ID()); ?></span>
		                <a href="<?php the_permalink(); ?>">
		                  <h4>
		                    <?php the_title(); ?>
		                  </h4>
		                </a>
		                <h6><?php echo get_field('small_title'); ?></h6>
		                <div class="text color-gray">
		                  <p><?php the_excerpt(); ?></p>
		                </div>
		                <div class="btn-wrapepr">
		                  <a href="<?php the_permalink(); ?>" class="btn btn-fill bg-black-btn bg-ligt-black-btn"><span><span>Read More</span></span><label></label></a>
		                </div>
		              </div>
		            </div>
				<?php 
				$i++; endwhile;  endif; wp_reset_query();?>
		 </div>
	</div>
</section>

----------------------------------------------------------------------------------------------------------


// Get category In the Post.
<div class="col-lg-12 col-md-12 col-sm-12">
	<?php
	    $args = array(
		'type'                     => 'services',  
		'order'                    => 'ASC',
		'taxonomy'                 => 'category',
		);
	    $categories = get_categories($args);
		echo '<ul>';
		foreach ($categories as $category) {
		    $url = get_term_link($category);?>
		    <li><a href="<?php echo $url;?>"><?php echo $category->name; ?></a></li>
		<?php
		}
	    echo '</ul>';
	?>
</div>


-----------------------------------------------------------------------------------------------------------------------
// Display subfiled in Group and repeater 


<?php if (have_rows('mobile_detail')):
    while (have_rows('mobile_detail')): the_row(); ?>
	<div class="mobile-detail">
		<?php $image = get_sub_field('image'); ?>
		<img src="<?php echo $image; ?>">
		<h2><?php the_sub_field('name'); ?></h2>
	</div>

	<?php endwhile; ?>
<?php endif; ?>


// Display subfiled in Nested Group and Nested repeater 

<?php if (have_rows('specifiaction')): ?>
	<div id="specifiaction">
		<table class="specifiaction-table">
			<tbody>
			<?php
			    // loop through rows (parent repeater)
			    while (have_rows('specifiaction')):  the_row(); ?>

					<tr>
						<td class="spec-title"> 
							<h4 ><?php the_sub_field('title'); ?></h4>
						</td>
						<td></td>
					</tr>

					<?php if (have_rows('info')): ?>

						<?php while (have_rows('info')): the_row(); ?>

						<tr> 
							<td class="title"><?php the_sub_field('title1'); ?>:</td> 
							<td class="content"><?php the_sub_field('title2'); ?></td>
						</tr>

						<?php endwhile; ?>

					<?php endif; ?>


					<?php endwhile; // while( has_sub_field('to-do_lists') ): ?>
			</tbody>
		</table>
	</div>
<?php endif; // if( get_field('to-do_lists') ): ?>



