const gulp = require( 'gulp' );
const pkg = require( '../package.json' );
const browserSync = require( 'browser-sync' );

function maybeReloadBrowserSync() {
	const server = browserSync.get( 'Gravity Forms Dev' );
	if ( server.active ) {
		server.reload();
	}
}

module.exports = {
	main() {
		// watch main plugin postcss

		gulp.watch( [
			`${ pkg.gravityforms.paths.css_src }admin/**/*.pcss`,
		], gulp.parallel( 'postcss:adminCss' ) );

		gulp.watch( [
			`${ pkg.gravityforms.paths.css_src }editor/**/*.pcss`,
		], gulp.parallel( 'postcss:editorCss' ) );

		gulp.watch( [
			`${ pkg.gravityforms.paths.css_src }settings/**/*.pcss`,
		], gulp.parallel( 'postcss:settingsCss' ) );

		gulp.watch( [
			`${ pkg.gravityforms.paths.css_src }base/**/*.pcss`,
		], gulp.parallel( 'postcss:baseCss' ) );

		gulp.watch( [
			`${ pkg.gravityforms.paths.css_src }theme/**/*.pcss`,
		], gulp.parallel( 'postcss:themeCss' ) );

		gulp.watch( [
			`${ pkg.gravityforms.paths.css_src }shared/**/*.pcss`,
			`${ pkg.gravityforms.paths.css_src }components/**/*.pcss`,
			`${ pkg.gravityforms.paths.css_src }variables/**/*.pcss`,
		], gulp.parallel( [ 'postcss:adminCss', 'postcss:editorCss', 'postcss:settingsCss', 'postcss:baseCss', 'postcss:themeCss' ] ) );

		// watch php

		gulp.watch( [
			`./**/*.php`,
		] ).on( 'change', function() {
			maybeReloadBrowserSync();
		} );
	},
};
