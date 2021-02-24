const {dest, src} = require('gulp');
const terser = require('gulp-terser');
const rollup = require('gulp-better-rollup');
const babel = require('rollup-plugin-babel');
const resolve = require('rollup-plugin-node-resolve');
const commonjs = require('rollup-plugin-commonjs');

// Flags wether we compress the output etc
const isProduction = process.env.NODE_ENV === 'production';

const scripts = () => {
    return src([
      './src/scripts/app.js'
    ])
    //ES6 see https://nshki.com/es6-in-gulp-projects/
    .pipe(rollup({ plugins: [babel(), resolve(), commonjs()] }, 'umd'))
    .pipe(terser()) 
    .pipe(dest('./dist/scripts'))
};
  
module.exports = scripts;