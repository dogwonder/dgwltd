const {dest, src} = require('gulp');
const merge = require('merge-stream');

// Moving files
const move = () => {
    let scripts = src(['./src/vendor/govuk-frontend-3.11.0.min.js', './src/vendor/photoswipe.min.js', './src/vendor/photoswipe-ui-default.min.js', './src/scripts/gallery.js'])
        .pipe(dest('./dist/scripts'));
    let fav = src(['./src/images/fav/manifest.json'])
        .pipe(dest('./dist/images/fav'));
    return merge(scripts, fav);
};

module.exports = move;