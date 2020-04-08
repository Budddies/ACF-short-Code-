<!-- ==================================================================================================
  ACF Short code
================================================================================================== -->

1. For Future image  ======= 
<?php the_post_thumbnail('full'); ?>
----------------------------------------------------------------------------------------------------------
2. Any field call on page use below code  ======= 
<?php the_field('Add your field name'); ?> 
<!--field name so add your field name in bracket-->
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
			if ($catpost_->have_posts() ) : while ($catpost_->have_posts() ) : $catpost_->the_post(); ?>
				<div class="col-lg-4 col-md-4 col-sm-12">
					<figure class="blogs">
						<?php the_post_thumbnail('full'); ?>
					<figcaption>
						<span><?php echo get_field('release_date'); ?></span>
						<h3><a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a></h3>
					</figcaption>
					</figure>
				</div>
			<?php endwhile;  endif; wp_reset_query();?>
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

