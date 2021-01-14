const {dest, src} = require('gulp');
const version = require('gulp-bump');

// Cleaning
const bump = () => { 
    return src('./package.json')
      .pipe(version({key: 'version', type:'minor'}))
      .pipe(dest('./'));
};

module.exports = bump;