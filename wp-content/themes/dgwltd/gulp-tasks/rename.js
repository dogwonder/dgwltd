const {dest, src} = require('gulp');
const rename = require('gulp-rename');

// Rename
const csspartial = () => {
    return src('./dist/css/critical.css')
    .pipe(rename({
        extname: '.php'
    }))
    .pipe(dest('./dist/css'));
};

module.exports = csspartial;