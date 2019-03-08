<?php
$quality_pro_options=theme_data_setup(); 
$current_options = wp_parse_args(  get_option( 'quality_pro_options', array() ), $quality_pro_options ); 
get_header();
quality_breadcrumbs(); ?>
<section id="section-block" class="news">
		<div class="container">
			
			<!--Blog Masonry-->
			<div class="row" id="blog-masonry">
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = array( 'post_type' => 'post','paged'=>$paged);		
					$post_type_data = new WP_Query( $args );
						while($post_type_data->have_posts()):
						$post_type_data->the_post();
						global $more;
						$more = 0; ?>	
				<div class="item">
				<article class="post" <?php post_class(); ?>>	
						<figure class="post-thumbnail">
						<?php $defalt_arg =array('class' => "img-responsive"); ?>
							<?php if(has_post_thumbnail()): ?>
							<a  href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('', $defalt_arg); ?>
							</a>
							<?php endif; ?>	
							
						</figure>
						<div class="post-content">	
							<?php if($current_options['home_meta_section_settings'] == '' ) {?>
							<div class="item-meta">
								<a class="author-image item-image" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '40'); ?></a>
								<?php echo ' ';?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php echo get_the_author();?></a>
								<br>
								<a class="entry-date" href="<?php echo get_month_link(get_post_time('Y'),get_post_time('m')); ?>">
								<?php echo get_the_date('M j, Y'); ?></a>
							</div>
							<?php } ?>
							<header class="entry-header">
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							</header>	
							<div class="entry-content">
								<?php the_content(__('Read More','quality')); ?>
							</div>
							<?php if($current_options['home_meta_section_settings'] == '' ) {?>
							<hr />
							<div class="entry-meta">
								<span class="comment-links"><a href="<?php the_permalink(); ?>"><?php comments_number(__( 'No Comments', 'quality'), __('One comment', 'quality'), __('% comments', 'quality')); ?></a></span>
								<?php $cat_list = get_the_category_list();
								if(!empty($cat_list)) { ?>
								<span class="cat-links"><?php _e('In','quality');?><a href="<?php the_permalink(); ?>"><?php the_category(' '); ?></a></span>
								<?php } ?>
								
							</div>
							<?php } ?>
						</div>
				</article>
				</div>
				<?php endwhile; ?>	
				<!--/Blog Content-->
			</div>
	
			<div class="row">	
				<div class="col-md-12">
					<div class="paginations">
					<!-- Pagination -->			
					<?php
					// Previous/next page navigation.
						the_posts_pagination( array(
					'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
					'next_text'          => '<i class="fa fa-angle-double-right"></i>',
					) );
					?>
					</div>
				</div>		  
			</div>				
		</div>
</section>
<?php 
get_footer();
?>