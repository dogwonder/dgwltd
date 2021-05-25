const {dest, src} = require('gulp');
const rollup = require('gulp-better-rollup');
const babel = require('rollup-plugin-babel');
const resolve = require('rollup-plugin-node-resolve');
const commonjs = require('rollup-plugin-commonjs');
const terser = require("rollup-plugin-terser");
const sourcemaps = require("gulp-sourcemaps");

// Flags wether we compress the output etc
const isProduction = process.env.NODE_ENV === 'production';

const scripts = () => {
  return src([
    './src/scripts/app.js'
  ])
  //ES6 see https://nshki.com/es6-in-gulp-projects/
  .pipe(sourcemaps.init())
  .pipe(rollup({ 
    plugins: [
      resolve(), 
      commonjs(),
      babel({
        runtimeHelpers: true
      }),
      // terser()
    ] 
  },{
    format: "iife"
  }))
  .pipe(sourcemaps.write('./'))
  .pipe(dest('./dist/scripts'))
};
  
module.exports = scripts;