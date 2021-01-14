const browserSync = require('browser-sync').create();

// Cleaning
const serve = () => { 
    browserSync.init({
        proxy: 'dgwltd.loc'
    });
};

module.exports = serve;