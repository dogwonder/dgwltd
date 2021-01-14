const gulp = require( 'gulp' );
const replace = require( 'gulp-replace' );
const pkg = require( '../package.json' );

module.exports = {
	adminIconsStyle() {
		return gulp.src( [
			`${ pkg.gravityforms.paths.css_src }shared/_icons-admin.pcss`,
		] )
			.pipe( replace( /url\('fonts\/(.+)'\) /g, 'url(\'../fonts/$1\') ' ) )
			.pipe( replace( / {2}/g, '\t' ) )
			.pipe( replace( /}$\n^\./gm, '}\n\n\.' ) )
			.pipe( replace( /'gform-icons-admin' !important/g, 'var(--t-font-family-admin-icons) !important' ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }shared/` ) );
	},
	adminIconsVariables() {
		return gulp.src( [
			`${ pkg.gravityforms.paths.css_src }variables/_icons-admin.pcss`,
		] )
			.pipe( replace( /(\\[a-f0-9]+);/g, '"$1";' ) )
			.pipe( replace( /\$icomoon-font-path: "fonts" !default;\n/g, '' ) )
			.pipe( replace( /\$icomoon-font-family: "gform-icons-admin" !default;\n/g, '' ) )
			.pipe( replace( /\$/g, '\t--' ) )
			.pipe( replace( /;\n\n$/m, ';\n' ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }variables/` ) );
	},
	themeIconsStyle() {
		return gulp.src( [
			`${ pkg.gravityforms.paths.css_src }shared/_icons-theme.pcss`,
		] )
			.pipe( replace( /url\('fonts\/(.+)'\) /g, 'url(\'../fonts/$1\') ' ) )
			.pipe( replace( / {2}/g, '\t' ) )
			.pipe( replace( /}$\n^\./gm, '}\n\n\.' ) )
			.pipe( replace( /'gform-icons-theme' !important/g, 'var(--t-font-family-theme-icons) !important' ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }shared/` ) );
	},
	themeIconsVariables() {
		return gulp.src( [
			`${ pkg.gravityforms.paths.css_src }variables/_icons-theme.pcss`,
		] )
			.pipe( replace( /(\\[a-f0-9]+);/g, '"$1";' ) )
			.pipe( replace( /\$icomoon-font-path: "fonts" !default;\n/g, '' ) )
			.pipe( replace( /\$icomoon-font-family: "gform-icons-theme" !default;\n/g, '' ) )
			.pipe( replace( /\$/g, '\t--' ) )
			.pipe( replace( /;\n\n$/m, ';\n' ) )
			.pipe( gulp.dest( `${ pkg.gravityforms.paths.css_src }variables/` ) );
	},
};
