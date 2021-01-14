const gulp = require( 'gulp' );
const rename = require( 'gulp-rename' );
const pkg = require( '../package.json' );

module.exports = {
	adminIconsFonts() {
		return gulp
			.src( [
				`${ pkg.gravityforms.paths.dev }icons/admin/fonts/*`,
			] )
			.pipe( gulp.dest( pkg.gravityforms.paths.fonts ) );
	},
	adminIconsStyles() {
		return gulp
			.src( [
				`${ pkg.gravityforms.paths.dev }icons/admin/style.css`,
			] )
			.pipe( rename( '_icons-admin.pcss' ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }shared/` ) );
	},
	adminIconsVariables() {
		return gulp
			.src( [
				`${ pkg.gravityforms.paths.dev }icons/admin/variables.scss`,
			] )
			.pipe( rename( '_icons-admin.pcss' ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }variables/` ) );
	},
	themeIconsFonts() {
		return gulp
			.src( [
				`${ pkg.gravityforms.paths.dev }icons/theme/fonts/*`,
			] )
			.pipe( gulp.dest( pkg.gravityforms.paths.fonts ) );
	},
	themeIconsStyles() {
		return gulp
			.src( [
				`${ pkg.gravityforms.paths.dev }icons/theme/style.css`,
			] )
			.pipe( rename( '_icons-theme.pcss' ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }shared/` ) );
	},
	themeIconsVariables() {
		return gulp
			.src( [
				`${ pkg.gravityforms.paths.dev }icons/theme/variables.scss`,
			] )
			.pipe( rename( '_icons-theme.pcss' ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }variables/` ) );
	},
};
