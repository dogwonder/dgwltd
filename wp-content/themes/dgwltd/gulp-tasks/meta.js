const {dest, src} = require('gulp');
const banner = require('gulp-banner');

//Ger package vars
const pkg = require('../package.json');

const comment = '/*\n' +
  ' * Automatically Generated - DO NOT EDIT \n' +
  ' * Generated on <%= new Date().toISOString().substr(0, 19) %> \n' +
  ' * <%= pkg.name %> <%= pkg.version %>\n' +
  ' * <%= pkg.description %>\n' +
  ' * <%= pkg.homepage %>\n' +
  ' *\n' +
  ' * Copyright <%= new Date().getFullYear() %>, <%= pkg.author %>\n' +
  ' * Released under the <%= pkg.license %> license.\n' +
  '*/\n\n';

const meta = () => { 
    return src('./dist/css/critical.css')
    .pipe(banner(comment, {
        pkg: pkg
    }))
    .pipe(dest('./dist/css/'));
};

module.exports = meta;