const gulp = require( 'gulp' );
const decompress = require( 'gulp-decompress' );
const pkg = require( '../package.json' );

module.exports = {
	adminIcons() {
		return gulp.src( [
			'gform-icons-admin*.zip',
		] )
			.pipe( decompress() )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.dev }icons/admin` ) );
	},
	themeIcons() {
		return gulp.src( [
			'gform-icons-theme*.zip',
		] )
			.pipe( decompress() )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.dev }icons/theme` ) );
	},
};
