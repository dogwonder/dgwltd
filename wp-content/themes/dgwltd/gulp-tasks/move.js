const {dest, src} = require('gulp');
const merge = require('merge-stream');

// Moving files
const move = () => {
    let styles = src(['./src/vendor/govuk-frontend-3.8.0.min.css'])
        .pipe(dest('./dist/css'));
    let scripts = src(['./src/vendor/govuk-frontend-3.5.0.min.js', './src/scripts/gallery.js'])
        .pipe(dest('./dist/scripts'));
    let fonts = src(['./src/fonts/**/*'])
        .pipe(dest('./dist/fonts'));
    let fav = src(['./src/images/fav/manifest.json'])
        .pipe(dest('./dist/images/fav'));
    return merge(styles, scripts, fonts, fav);
};

module.exports = move;