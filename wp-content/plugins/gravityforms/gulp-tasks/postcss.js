const gulp = require( 'gulp' );
const postcss = require( 'gulp-postcss' );
const sourcemaps = require( 'gulp-sourcemaps' );
const rename = require( 'gulp-rename' );
const gulpif = require( 'gulp-if' );
const concat = require( 'gulp-concat' );
const browserSync = require( 'browser-sync' );
const pkg = require( '../package.json' );

const compilePlugins = [
	require( 'postcss-import' )( {
		path: [
			`./${ pkg.gravityforms.paths.root }`,
			`./${ pkg.gravityforms.paths.css_dist }`,
			`./${ pkg.gravityforms.paths.legacy_css }`,
		],
	} ),
	require( 'postcss-custom-media' ),
	require( 'postcss-custom-properties' )( { preserve: false } ),
	require( 'postcss-nested' ),
	require( 'postcss-preset-env' )( { stage: 0, autoprefixer: { grid: true } } ),
];

const compileTheme = [
	require( 'postcss-import' )( {
		path: [
			`./${ pkg.gravityforms.paths.root }`,
			`./${ pkg.gravityforms.paths.css_dist }`,
			`./${ pkg.gravityforms.paths.legacy_css }`,
		],
	} ),
	require( 'postcss-mixins' ),
	require( 'postcss-custom-media' ),
	require( 'postcss-custom-properties' )( { preserve: false } ),
	require( 'postcss-nested' ),
	require( 'postcss-preset-env' )( { stage: 0, autoprefixer: { grid: true } } ),
	require( 'postcss-rem-to-pixel' )( { propList: [ '*' ] } ),
];

/**
 *
 *
 * @param {Object} options {
 * 	src = [],
 * 	dest = pkg.gravityforms.paths.core_admin_css,
 * 	plugins = compilePlugins,
 * 	bundleName = 'empty.css',
 * }
 * @param {Array<string>} options.src
 * @param {string} options.dest
 * @param {Array<Function>} options.plugins
 * @param {string} options.bundleName
 * @returns
 */
function cssProcess( {
	src = [],
	dest = pkg.gravityforms.paths.css_dist,
	plugins = compilePlugins,
	bundleName = 'empty.css', // Needs to be a valid filename else concat errors
} ) {
	const server = browserSync.get( 'Gravity Forms Dev' );
	return gulp.src( src )
		.pipe( sourcemaps.init() )
		.pipe( postcss( plugins ) )
		.pipe( rename( { extname: '.css' } ) )
		.pipe( gulpif(
			bundleName !== 'empty.css',
			concat( bundleName )
		) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( dest ) )
		.pipe( gulpif( server.active, server.reload( { stream: true } ) ) );
}

module.exports = {
	adminCss() {
		return cssProcess( {
			src: [
				`${ pkg.gravityforms.paths.css_src }admin/admin.pcss`,
			],
			dest: pkg.gravityforms.paths.css_dist,
		} );
	},
	editorCss() {
		return cssProcess( {
			src: [
				`${ pkg.gravityforms.paths.css_src }editor/editor.pcss`,
			],
			dest: pkg.gravityforms.paths.css_dist,
		} );
	},
	settingsCss() {
		return cssProcess( {
			src: [
				`${ pkg.gravityforms.paths.css_src }settings/settings.pcss`,
			],
			dest: pkg.gravityforms.paths.settings_css_dist,
		} );
	},
	baseCss() {
		return cssProcess( {
			src: [
				`${ pkg.gravityforms.paths.css_src }base/base.pcss`,
			],
			dest: pkg.gravityforms.paths.css_dist,
		} );
	},
	themeCss() {
		return cssProcess( {
			src: [
				`${ pkg.gravityforms.paths.css_src }theme/theme.pcss`,
			],
			dest: pkg.gravityforms.paths.css_dist,
			plugins: compileTheme,
		} );
	},
};
