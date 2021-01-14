const {dest, src} = require('gulp');
const responsive = require('gulp-responsive');

// Cleaning
const favicon = () => { 
    return src('./src/images/fav/favicon.png')
        .pipe(
            responsive(
            {
                // Resize all JPG images to three different sizes: 180, and 512 pixels
                '**/*.png': [
                {
                    width: 180,
                    rename: { suffix: '-180x180' }
                },
                {
                    width: 192,
                    rename: { suffix: '-192x192' }
                },
                {
                    width: 512,
                    rename: { suffix: '-512x512' }
                }
                ]
            },
            {
                // Global configuration for all images
                // Use progressive (interlace) scan for JPEG and PNG output
                progressive: true,
                // Strip all metadata
                withMetadata: false
            }
            )
        )
        .pipe(dest('./dist/images/fav'))
};

module.exports = favicon;
