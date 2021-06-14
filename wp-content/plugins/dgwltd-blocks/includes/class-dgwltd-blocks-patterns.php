<?php

/**
 * Define the block patterns
 *
 * Loads and defines the block patterns for this plugin
 *
 * @link       https://dgw.ltd
 * @since      1.0.0
 *
 * @package    Dgwltd_Blocks
 * @subpackage Dgwltd_Blocks/includes
 */

/**
 * Define the blocks functionality.
 *
 * Loads and defines the block patterns for this plugin
 *
 * @since      1.0.0
 * @package    Dgwltd_Blocks
 * @subpackage Dgwltd_Blocks/includes
 * @author     Rich Holman <dogwonder@gmail.com>
 */
class Dgwltd_Blocks_Patterns {


		/**
		 * Register Event Block Pattern Category
		 */
	public function dgwltd_register_block_categories() {
		if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
			return;
		}

		register_block_pattern_category(
			'blocks',
			array( 'label' => _x( 'DGW.ltd', 'Block pattern category', 'dgwltd-blocks' ) )
		);
	}

		/**
		 * Register Block Patterns
		 */
	public function dgwltd_register_block_patterns() {

		if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
			return;
		}

		// Supporters block.
		$patterns['dgwltd-blocks/supporters'] = array(
			'title'       => __( 'Supporters', 'dgwltd-blocks' ),
			'description' => __( 'A group of images and links to list supporters.', 'dgwltd-blocks' ),
			'content'     => '
					<!-- wp:group {"style":{"color":{"background":"#fafafa"}}} -->
						<div class="wp-block-group has-background" style="background-color:#fafafa"><div class="wp-block-group__inner-container">
						<!-- wp:heading {"align":"center","level":3} -->
						<h3 class="has-text-align-center">Thanks to our supporters</h3>
						<!-- /wp:heading -->

						<!-- wp:paragraph {"align":"center"} -->
						<p class="has-text-align-center">A really short blurb. Add and remove columns as needed.</p>
						<!-- /wp:paragraph -->

						<!-- wp:columns -->
							<div class="wp-block-columns">
							<!-- wp:column {"width":25} -->
								<div class="wp-block-column" style="flex-basis:25%">
								<!-- wp:group {"backgroundColor":"white"} -->
									<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container">

									<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-default"} -->
									<div class="wp-block-image is-style-default"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
									<!-- /wp:image -->

									<!-- wp:heading {"align":"center","level":4} -->
									<h4 class="has-text-align-center"><a href="#supporter1">Supporter 1</a></h4>
									<!-- /wp:heading -->
									</div></div>
								<!-- /wp:group -->
								</div>
							<!-- /wp:column -->

							<!-- wp:column {"width":25} -->
								<div class="wp-block-column" style="flex-basis:25%">
								<!-- wp:group {"backgroundColor":"white"} -->
									<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container">

									<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-default"} -->
									<div class="wp-block-image is-style-default"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
									<!-- /wp:image -->

									<!-- wp:heading {"align":"center","level":4} -->
									<h4 class="has-text-align-center"><a href="#supporter2">Supporter 2</a></h4>
									<!-- /wp:heading -->
									</div></div>
								<!-- /wp:group -->
								</div>
							<!-- /wp:column -->

							<!-- wp:column {"width":25} -->
								<div class="wp-block-column" style="flex-basis:25%">
								<!-- wp:group {"backgroundColor":"white"} -->
									<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container">

									<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-default"} -->
									<div class="wp-block-image is-style-default"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
									<!-- /wp:image -->

									<!-- wp:heading {"align":"center","level":4} -->
									<h4 class="has-text-align-center"><a href="#supporter2">Supporter 3</a></h4>
									<!-- /wp:heading -->
									</div></div>
								<!-- /wp:group -->
								</div>
							<!-- /wp:column -->

							<!-- wp:column {"width":25} -->
								<div class="wp-block-column" style="flex-basis:25%">
								<!-- wp:group {"backgroundColor":"white"} -->
									<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container">

									<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-default"} -->
									<div class="wp-block-image is-style-default"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
									<!-- /wp:image -->

									<!-- wp:heading {"align":"center","level":4} -->
									<h4 class="has-text-align-center"><a href="#supporter4">Supporter 4</a></h4>
									<!-- /wp:heading -->

									</div></div>
								<!-- /wp:group -->
								</div>
							<!-- /wp:column -->
							</div>
						<!-- /wp:columns -->
						</div></div>
					<!-- /wp:group -->
				',
			'categories'  => array( 'blocks' ),
		);

		// FAQ block.
		$patterns['dgwltd-blocks/faq'] = array(
			'title'       => __( 'FAQ', 'dgwltd-blocks' ),
			'description' => __( 'Columns for commonly asked questions.', 'dgwltd-blocks' ),
			'content'     => '
					<!-- wp:group -->
					<div class="wp-block-group"><div class="wp-block-group__inner-container">

					<!-- wp:heading {"level":2} -->
					<h2>Frequently Asked Questions</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p>A really short blurb. Add and remove columns as needed.</p>
					<!-- /wp:paragraph -->
					
					<!-- wp:acf/dgwltd-accordion --><!-- /wp:acf/dgwltd-accordion  -->
						
					</div></div>
					<!-- /wp:group -->
				',
			'categories'  => array( 'blocks' ),
		);

		$patterns['dgwltd-blocks/columns-dark'] = array(
			'title'       => __( 'Columns - dark', 'dgwltd-blocks' ),
			'description' => __( 'Columns for content with a dark background colour', 'dgwltd-blocks' ),
			'content'     => '
					<!-- wp:group {"style":{"color":{"background":"#00466e","text":"#000000"}}} -->
					<div class="wp-block-group has-text-color has-background dgwltd-block-group dgwltd-block-group--dark" style="background-color:#00466e;color:#000000"><div class="wp-block-group__inner-container">

					<!-- wp:heading {"level":2} -->
					<h2 class="has-white-color has-text-color">Dogwonder Ltd. is a web development agency.</h2>
					<!-- /wp:heading -->

					<!-- wp:columns -->
					<div class="wp-block-columns">
						<!-- wp:column -->
							<div class="wp-block-column">
								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-default"} -->
								<div class="wp-block-image is-style-default"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->
                                <!-- wp:heading {"level":3} -->
                                <h3 class="has-white-color has-text-color"><a href="#">Headline here</a></h3>
					            <!-- /wp:heading -->
                                <!-- wp:paragraph -->
                                <p>A really short blurb. Add and remove columns as needed.</p>
                                <!-- /wp:paragraph -->
							</div>
						<!-- /wp:column -->
                        <!-- wp:column -->
							<div class="wp-block-column">
								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-default"} -->
								<div class="wp-block-image is-style-default"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->
								<!-- wp:heading {"level":3} -->
								<h3 class="has-white-color has-text-color"><a href="#">Headline here</a></h3>
								<!-- /wp:heading -->
								<!-- wp:paragraph -->
								<p>A really short blurb. Add and remove columns as needed.</p>
								<!-- /wp:paragraph -->
                            </div>
                        <!-- /wp:column -->
                        <!-- wp:column -->
							<div class="wp-block-column">
								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-default"} -->
								<div class="wp-block-image is-style-default"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->
								<!-- wp:heading {"level":3} -->
								<h3 class="has-white-color has-text-color"><a href="#">Headline here</a></h3>
								<!-- /wp:heading -->
								<!-- wp:paragraph -->
								<p>A really short blurb. Add and remove columns as needed.</p>
								<!-- /wp:paragraph -->
                            </div>
                        <!-- /wp:column -->
						</div>
					<!-- /wp:columns -->
						
					</div></div>
					<!-- /wp:group -->
				',
			'categories'  => array( 'blocks' ),
		);

		$patterns['dgwltd-blocks/columns-light'] = array(
			'title'       => __( 'Columns - light', 'dgwltd-blocks' ),
			'description' => __( 'Columns for content with a light background colour', 'dgwltd-blocks' ),
			'content'     => '
					<!-- wp:group {"style":{"color":{"background":"#fafafa","text":"#000000"}}} -->
					<div class="wp-block-group has-text-color has-background dgwltd-block-group dgwltd-block-group--light" style="background-color:#fafafa;color:#000000"><div class="wp-block-group__inner-container">

					<!-- wp:heading {"level":2} -->
					<h2>Dogwonder Ltd. is a web development agency.</h2>
					<!-- /wp:heading -->

					<!-- wp:columns -->
					<div class="wp-block-columns">
						<!-- wp:column -->
							<div class="wp-block-column">
								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-default"} -->
								<div class="wp-block-image is-style-default"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->
                                <!-- wp:heading {"level":3} -->
                                <h3><a href="#">Headline here</a></h3>
					            <!-- /wp:heading -->
                                <!-- wp:paragraph -->
                                <p>A really short blurb. Add and remove columns as needed.</p>
                                <!-- /wp:paragraph -->
							</div>
						<!-- /wp:column -->
                        <!-- wp:column -->
							<div class="wp-block-column">
								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-default"} -->
								<div class="wp-block-image is-style-default"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->
								<!-- wp:heading {"level":3} -->
								<h3><a href="#">Headline here</a></h3>
								<!-- /wp:heading -->
								<!-- wp:paragraph -->
								<p>A really short blurb. Add and remove columns as needed.</p>
								<!-- /wp:paragraph -->
                            </div>
                        <!-- /wp:column -->
                        <!-- wp:column -->
							<div class="wp-block-column">
								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-default"} -->
								<div class="wp-block-image is-style-default"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->
								<!-- wp:heading {"level":3} -->
								<h3><a href="#">Headline here</a></h3>
								<!-- /wp:heading -->
								<!-- wp:paragraph -->
								<p>A really short blurb. Add and remove columns as needed.</p>
								<!-- /wp:paragraph -->
                            </div>
                        <!-- /wp:column -->
						</div>
					<!-- /wp:columns -->
					</div></div>
					<!-- /wp:group -->
				',
			'categories'  => array( 'blocks' ),
		);

		$patterns['dgltd-block-patterns/cover-columns'] = [
			'title'       => __( 'Cover - with columns', 'dgltd-block-patterns' ),
			'description' => __( 'A cover block with two columns inside', 'dgltd-block-patterns' ),
			'content'     => '
				<!-- wp:cover {"url":"' . esc_url( plugin_dir_url( __DIR__ ) . 'public/images/cover.jpg') . '","className":"dgltd-block--cover"} -->
				<div class="wp-block-cover has-background-dim dgltd-block--cover" style="background-image:url(' . esc_url( plugin_dir_url( __DIR__ ) . 'public/images/cover.jpg') . ')">
					<div class="wp-block-cover__inner-container">
						<!-- wp:columns -->
						<div class="wp-block-columns">
							<!-- wp:column -->
							<div class="wp-block-column">
								<!-- wp:heading -->
								<h2>Column heading</h2>
								<!-- /wp:heading -->
							</div>
							<!-- /wp:column -->
							<!-- wp:column -->
							<div class="wp-block-column">
								<!-- wp:list -->
									<ul><li>List item 1</li><li>List item 2</li><li>List item 3</li></ul>
								<!-- /wp:list -->
							</div>
							<!-- /wp:column -->
						</div>
						<!-- /wp:columns -->
					</div>
				</div>
				<!-- /wp:cover -->
			',
			'categories'  => [ 'blocks' ],
		];
		

		$patterns['dgwltd-blocks/team'] = array(
			'title'       => __( 'Meet the team', 'dgwltd-blocks' ),
			'description' => __( 'A grid of team members', 'dgwltd-blocks' ),
			'content'     => '
					<!-- wp:group -->
					<div class="wp-block-group dgwltd-block-team"><div class="wp-block-group__inner-container">

					<!-- wp:heading {"level":2} -->
					<h2>Meet the team.</h2>
					<!-- /wp:heading -->

					<!-- wp:columns -->
					<div class="wp-block-columns">
						<!-- wp:column -->
							<div class="wp-block-column">
								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"medium","className":"is-style-default"} -->
								<div class="wp-block-image is-style-default"><figure class="aligncenter size-medium is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->
                                <!-- wp:heading {"level":3} -->
                                <h3>Name surname</h3>
								<!-- /wp:heading -->
								<!-- wp:heading {"level":4} -->
                                <h4>Job Title</h4>
					            <!-- /wp:heading -->
								<!-- wp:social-links -->
								<ul class="wp-block-social-links">
									<!-- wp:social-link {"url":"https://www.linkedin.com/company/dogwonder-ltd/","service":"linkedin"} /-->
									<!-- wp:social-link {"url":"dogwonder@gmail.com","service":"mail"} /-->
								</ul>
								<!-- /wp:social-links -->
							</div>
						<!-- /wp:column -->
						<!-- wp:column -->
							<div class="wp-block-column">
								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"medium","className":"is-style-default"} -->
								<div class="wp-block-image is-style-default"><figure class="aligncenter size-medium is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->
                                <!-- wp:heading {"level":3} -->
                                <h3>Name surname</h3>
								<!-- /wp:heading -->
								<!-- wp:heading {"level":4} -->
                                <h4>Job Title</h4>
					            <!-- /wp:heading -->
								<!-- wp:social-links -->
								<ul class="wp-block-social-links">
									<!-- wp:social-link {"url":"https://www.linkedin.com/company/dogwonder-ltd/","service":"linkedin"} /-->
									<!-- wp:social-link {"url":"dogwonder@gmail.com","service":"mail"} /-->
								</ul>
								<!-- /wp:social-links -->
							</div>
						<!-- /wp:column -->
						<!-- wp:column -->
							<div class="wp-block-column">
								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"medium","className":"is-style-default"} -->
								<div class="wp-block-image is-style-default"><figure class="aligncenter size-medium is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->
                                <!-- wp:heading {"level":3} -->
                                <h3>Name surname</h3>
								<!-- /wp:heading -->
								<!-- wp:heading {"level":4} -->
                                <h4>Job Title</h4>
					            <!-- /wp:heading -->
								<!-- wp:social-links -->
								<ul class="wp-block-social-links">
									<!-- wp:social-link {"url":"https://www.linkedin.com/company/dogwonder-ltd/","service":"linkedin"} /-->
									<!-- wp:social-link {"url":"dogwonder@gmail.com","service":"mail"} /-->
								</ul>
								<!-- /wp:social-links -->
							</div>
						<!-- /wp:column -->
					</div>
					<!-- /wp:columns -->
						
					</div></div>
					<!-- /wp:group -->
				',
			'categories'  => array( 'blocks' ),
		);

		$patterns = apply_filters( 'dgwltd_block_patterns', $patterns );

		foreach ( $patterns as $pattern => $definition ) {
			register_block_pattern( $pattern, $definition );
		}
	}

}
