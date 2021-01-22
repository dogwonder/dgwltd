const {dest, src} = require('gulp');
const merge = require('merge-stream');

// Moving files
const move = () => {
    let styles = src(['./public/css/editor.css'])
        .pipe(dest('./admin/css'));
    let scripts = src(['./public/scripts/app.js'])
        .pipe(dest('./admin/scripts'));
    return merge(styles, scripts);
};

module.exports = move;