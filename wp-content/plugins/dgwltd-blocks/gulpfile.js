const {series, parallel, watch} = require('gulp');

// Pull in each task

//File tasks
const sass = require('./gulp-tasks/sass.js');
const scripts = require('./gulp-tasks/scripts.js');

//Utlitiy tasks
const clean = require('./gulp-tasks/clean.js');
const move = require('./gulp-tasks/move.js');

// Set each directory and contents that we want to watch and
// assign the relevant task. `ignoreInitial` set to true will
// prevent the task being run when we run `gulp watch`, but it
// will run when a file changes.
const watcher = () => {
  watch('./src/scripts/**/*', {ignoreInitial: true}, scripts);
  watch('./src/scss/**/*.scss', {ignoreInitial: true}, sass);
};

// The default (if someone just runs `gulp`) is to run each task in parrallel
exports.default = series(clean, parallel(sass, scripts, move));

// This is our watcher task that instructs gulp to watch directories and
// act accordingly
exports.watch = watcher;
