const del = require( 'del' );
const pkg = require( '../package.json' );

const getIconPaths = ( target = 'admin' ) => ([
	`${ pkg.gravityforms.paths.root }/dev/icons/${ target }`,
	`${ pkg.gravityforms.paths.fonts }gform-icons-${ target }.*`,
	`${ pkg.gravityforms.paths.css_src }shared/_icons-${ target }.pcss`,
	`${ pkg.gravityforms.paths.css_src }variables/_icons-${ target }.pcss`,
]);

module.exports = {
	adminIconsStart() {
		return del( getIconPaths() );
	},
	adminIconsEnd() {
		return del( [
			'gform-icons-admin*.zip',
		] );
	},
	themeIconsStart() {
		return del( getIconPaths( 'theme' ) );
	},
	themeIconsEnd() {
		return del( [
			'gform-icons-theme*.zip',
		] );
	},
};
