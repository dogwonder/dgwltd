const gulp = require( 'gulp' );
const footer = require( 'gulp-footer' );
const pkg = require( '../package.json' );

module.exports = {
	adminIconsVariables() {
		return gulp.src( `${ pkg.gravityforms.paths.css_src }variables/_icons-admin.pcss` )
			.pipe( footer( '}\n' ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }variables/` ) );
	},
	themeIconsVariables() {
		return gulp.src( `${ pkg.gravityforms.paths.css_src }variables/_icons-theme.pcss` )
			.pipe( footer( '}\n' ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }variables/` ) );
	},
};
