const browserSync = require('browser-sync').create();

// Cleaning
const serve = () => { 
    browserSync.init({
        proxy: 'makehappy.loc'
    });
};

module.exports = serve;