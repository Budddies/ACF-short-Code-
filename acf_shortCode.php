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

