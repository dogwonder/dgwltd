const del = require('del');

//Flags wether delete the docs folder or not
const isProduction = process.env.NODE_ENV === 'production';

// Cleaning
const clean = () => { 
    if (isProduction) {
        return del([ './dist/**' ])
    } else {
        return del([])
    }
};

module.exports = clean;