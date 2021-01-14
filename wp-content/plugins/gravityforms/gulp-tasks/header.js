const gulp = require( 'gulp' );
const header = require( 'gulp-header' );
const pkg = require( '../package.json' );

module.exports = {
	adminIconsStyle() {
		return gulp.src( `${ pkg.gravityforms.paths.css_src }shared/_icons-admin.pcss` )
			.pipe( header( `/* -----------------------------------------------------------------------------
 *
 * Admin Font Icons (via IcoMoon)
 *
 * This file is generated using the \`gulp icons\` task. Do not edit it directly.
 *
 * ----------------------------------------------------------------------------- */

` ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }shared/` ) );
	},
	adminIconsVariables() {
		return gulp.src( `${ pkg.gravityforms.paths.css_src }variables/_icons-admin.pcss` )
			.pipe( header( `/* -----------------------------------------------------------------------------
 *
 * Variables: Admin Icons (via IcoMoon)
 *
 * This file is generated using the \`gulp icons\` task. Do not edit it directly.
 *
 * ----------------------------------------------------------------------------- */

:root {` ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }variables/` ) );
	},
	themeIconsStyle() {
		return gulp.src( `${ pkg.gravityforms.paths.css_src }shared/_icons-theme.pcss` )
			.pipe( header( `/* -----------------------------------------------------------------------------
 *
 * Theme Font Icons (via IcoMoon)
 *
 * This file is generated using the \`gulp icons\` task. Do not edit it directly.
 *
 * ----------------------------------------------------------------------------- */

` ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }shared/` ) );
	},
	themeIconsVariables() {
		return gulp.src( `${ pkg.gravityforms.paths.css_src }variables/_icons-theme.pcss` )
			.pipe( header( `/* -----------------------------------------------------------------------------
 *
 * Variables: Theme Icons (via IcoMoon)
 *
 * This file is generated using the \`gulp icons\` task. Do not edit it directly.
 *
 * ----------------------------------------------------------------------------- */

:root {` ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }variables/` ) );
	},
};
