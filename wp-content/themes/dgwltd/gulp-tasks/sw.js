const {dest, src} = require('gulp');
const nunjucks = require('nunjucks');
const gulpnunjucks = require('gulp-nunjucks');
const rename = require('gulp-rename');

//Ger package vars and set environment
const pkg = require('../package.json');
const env = new nunjucks.Environment(new nunjucks.FileSystemLoader('./src/'));

// Get version from package.json
env.addGlobal('pkgVersion', function (str) {
    var cbVersion = pkg.version;
    return cbVersion;
});

const sw = () => {
    return src([
        './src/njk/sw.njk.js'
    ])
    .pipe(gulpnunjucks.compile("", {env: env}))
    .pipe(rename('sw.js'))
    .pipe(dest('../../../')) //Export to the root
};

module.exports = sw;