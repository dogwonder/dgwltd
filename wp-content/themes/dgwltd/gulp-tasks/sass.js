const {dest, src} = require('gulp');
const cleanCSS = require('gulp-clean-css');
const sassProcessor = require('gulp-sass');

// We want to be using canonical Sass, rather than node-sass
sassProcessor.compiler = require('sass');

// Flags wether we compress the output etc
const isProduction = process.env.NODE_ENV === 'production';

// Takes the arguments passed by `dist` and determines where the output file goes
const calculateOutput = ({history}) => {
  // By default, we want a CSS file in our dist directory, so the
  // HTML can grab it with a <link />
  let response = './dist/css';

  // Get everything after the last slash
  const sourceFileName = /[^/]*$/.exec(history[0])[0];

  return response;
};

// The main Sass method grabs all root Sass files,
// processes them, then sends them to the output calculator
const sass = () => {
  return src('./src/scss/*.scss')
    .pipe(sassProcessor().on('error', sassProcessor.logError))
    .pipe(
      cleanCSS(
        isProduction
          ? {
              level: 2
            }
          : {}
      )
    )
    .pipe(dest(calculateOutput, {sourceMaps: !isProduction}));
};

module.exports = sass;
