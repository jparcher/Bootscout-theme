<?php
	get_header();
	b4st_main_before();
?>

<main class="container-responsive mt-5">
	<div class="row">

		<div class="col-sm">
			<div id="content" role="main">
				<header class="mb-4 border-bottom">
					<h1>
						<?php _e('Search Results for', 'b4st'); ?> &ldquo;<?php the_search_query(); ?>&rdquo;
					</h1>
				</header>
				<?php get_template_part('loops/search-results'); ?>
			</div><!-- /#content -->
		</div>

	<?php if ($options['sidebar'] != true) {
		get_sidebar();
	}
	?>

	</div><!-- /.row -->
</main><!-- /.container-responsive -->

<?php
	b4st_main_after();
	get_footer(); 
?>
