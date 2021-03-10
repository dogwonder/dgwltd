# DGW.ltd Wordpress theme

## Requirements

| Prerequisite    | How to check | How to install                                  |
| --------------- | ------------ | ----------------------------------------------- |
| PHP >= 7.3.x    | `php -v`     | [php.net](http://php.net/manual/en/install.php) |
| Node.js >= 12.0 | `node -v`    | [nodejs.org](http://nodejs.org/)                |
| gulp >= 4.0.0   | `gulp -v`    | `npm install -g gulp`                           |
| acfpro >= 5.9.4 |              | [advancedcustomfields.com](https://www.advancedcustomfields.com/pro/)         |

## Build

- `npm run start` — Compile assets when file changes are made
- `npm run production` — Compile assets for production


## Overrides for Framework

This site uses the [GOV.UK design system](https://design-system.service.gov.uk) as the underlying framework. It's used pretty sparingly but userful for [components](https://design-system.service.gov.uk/components/) such as forms and other [layouts](https://design-system.service.gov.uk/styles/layout/)

Comment out `govuk/helpers/_typography.scss` to remove GOV.UK typography

```
// @if ($govuk-include-default-font-face) {
//   @include _govuk-font-face-gds-transport;
// }
```

And replace font-family from `govuk/settings/_typography-font-families.scss`

```
// $govuk-font-family-gds-transport: "GDS Transport", Arial, sans-serif;
$govuk-font-family-gds-transport: "Helvetica Neue", Helvetica, Arial, sans-serif;
```

## Other notable 3rd party integrations

- [Photoswipe](Photoswipe) integration for galleries
- [Youtube](https://github.com/paulirish/lite-youtube-embed) and [Vimeo](https://github.com/slightlyoff/lite-vimeo) lite plugins (render the video as a screenshot until a user interacts with the video to save bandwidth)


## Analytics

I am using [Plausible.io](https://plausible.io/simple-web-analytics) a simple privacy focused analyics service, as such I don't need to set a cookie banner. 

Obviously you would want to add your own analytics so replace `<script async defer data-domain="dgw.ltd" src="https://plausible.io/js/plausible.js"></script>` from `header.php`

Note: if you do use Plausible you can [exclude it](https://plausible.io/docs/excluding) recording your own visits by pasting this into the developer console `localStorage.plausible_ignore=true`



## Custom blocks (optional)

These are actived via a custom plugin *dgwltd: Blocks*

This requires [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/). $$ - but it really is the great plugin ever made. 

These are saved in `wp-plugins\dgwltd-blocks\src\acf-json`

- DGW.ltd Accordion - based on GOV.UK's [accordian pattern](https://design-system.service.gov.uk/components/accordion/) 
- DGW.ltd Cards - grid of cards linking to other pages, title, exerpt and featured image 
- DGW.ltd CTA - call to action split text and image
- DGW.ltd Details - based on GOV.UK's [details pattern](https://design-system.service.gov.uk/components/details/)
- DGW.ltd Embed - lite embed custom element for [Youtube](https://github.com/paulirish/lite-youtube-embed) and [Vimeo](https://github.com/slightlyoff/lite-vimeo)
- DGW.ltd Feature - text and background image similar to hero but less showy
- DGW.ltd Image - custom image with aspect ratio variables
- DGW.ltd Hero - hero section with big image / video as background
- DGW.ltd Summary list - based on GOV.UK's [summary list pattern](https://design-system.service.gov.uk/components/summary-list/) 
- DGW.ltd Related pages - list of related links

## Custom block patterns

Included in the plugin *dgwltd: Blocks* alkonhside the custom blocks this allows for pre-made collections of blocks, accessible under the 'DGW.ltd' in patterns dropdown

- Supporters
- FAQs
- Columns - dark
- Columns - light
- Meet the team

## Starter content (experimental)

Sets up a few pages (home, about, contact and blog) and menus (prinary, footer and legal) located in `starter-content.php` this can be activated by using the Wordpress customiser. 

## Templates

### Blocks template

`template-layout.php` 

For home and gateway pages, allows for full width blocks (e.g. DGW.ltd Hero / DGW.ltd Feature) these can be used in any post or page but would be restricted to a fixed width and look weird. This also removes the page title (can be re-added via a heading block)


### Guide template

`template-guide.php`

Similar to NHS [contents guide](https://www.nhs.uk/conditions/type-2-diabetes/) this allows for a parent / child relationshiop to be created with all child pages listed with the parent as the first item on a contents list. Allows the user to navigate forwards and backwards through the contents list. 

### Blog template

`template-blog.php`

Blog / posts list template

### Search results template

`template-search.php`

Search results template

### Cookies template

`template-cookies.php`

Cookie settings template. If the optional cookies functionality is turned on this will allow users to save their cookie settings. 

An initial cookie is set to save the users preferences where only stricly necessary cookies are set:

{ "essential": true, "functional": false, "performance": false, "advertising": false };

See `app.js` and the function `cookieScriptsEnable()` for more instructions on how to manually block third-party cookies

header.php - uncomment `get_template_part('template-parts/_organisms/cookie-notice');` 
header.php - uncomment `<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/dist/scripts/cookies.js"></script>`
app.js - uncomment `cookieSet(), cookieSettingsPage(), cookieSettingsUpdate()` 

You can then use the PHP function `dgwltd_cookie_var()` to test for functional and analytics cookies. 

## Gallery

Add the Additional CSS class(es) `.dgwltd-gallery` to the block 'Gallery' make a Wordpress gallery block into a modal one (and make sure link to settings are Media file)

Based on PhotoSwipe [Javascript gallery](https://photoswipe.com) 



## AMP Support

This theme and plugin can have AMP support if the [AMP plugin](https://wordpress.org/plugins/amp/) is enabled. This does stuff like enable the AMP burger menu, AMP images and a few other optimisation bits. 

AMP breaks on quite a lot of the stuff if used in transitional mode (e.g. if we want to retain a similar theme for AMP visitors). 

Enable it the [plugin](https://wordpress.org/plugins/amp/) and if Transitional Mode is chosen the below optional CSS and PHP code can be implemented to provide better support to AMP native. 

Uncomment `@import "site/amp"` in `criticial.css`

Add this to dgwltd_body_classes() in dgwltd-functions.php to add a class for when AMP is enabled and visible to users

```
//Is the AMP plugin enabled
if ( is_plugin_active( 'amp/amp.php' ) && amp_is_request() ) {
  $classes[] = 'amp-enabled';
}
```

Uncomment the following in `functions.php`

```
require get_template_directory() . '/inc/dgwltd-amp.php';
```

As for the plugin the following partials in `wp-plugins\dgwltd-blocks\src\blocks` could be amended for better AMP support

### cta.php

Add AMP native images

```
<?php 
//Is the AMP plugin (https://wordpress.org/plugins/amp/) enabled if so show the AMP image format
if(function_exists('amp_is_request') && amp_is_request()) : ?>
<amp-img alt="<?php echo ($image_alt ?  $image_alt : ''); ?>"
        src="<?php echo $image_small; ?>"
        width="<?php echo $image_small_width ?>"
        height="<?php echo $image_small_height ?>">
</amp-img>
<?php else : ?>
<!-- Usual image -->
<?php endif; ?>
```

### embed.php

Add AMP native embeds

```
<?php 
//Is the AMP plugin (https://wordpress.org/plugins/amp/) enabled if so provide a dominant background color based on the image
if(function_exists('amp_is_request') && amp_is_request()) : ?>
<?php if($v['type'] == 'youtube') : ?>
<amp-youtube
data-videoid="<?php echo $vid; ?>"
layout="responsive"
width="480"
height="270"
></amp-youtube>
<?php elseif ($v['type'] == 'vimeo') : ?>
<amp-vimeo
data-videoid="<?php echo $vid; ?>"
layout="responsive"
width="500"
height="281"
></amp-vimeo>
<?php else : ?>
<amp-iframe
width="200"
height="100"
sandbox="allow-scripts allow-same-origin"
layout="responsive"
frameborder="0"
src="<?php the_field('embed'); ?>"
>
</amp-iframe>
<?php endif; ?>
<?php else : ?>
<!-- Usual embed code -->
<?php endif; ?>
```

### feature.php & hero.php

Add a background color instead of a background image

```
<?php 
//Is the AMP plugin (https://wordpress.org/plugins/amp/) enabled if so get the dominant color for the image and set it as a background color
if(function_exists('amp_is_request') && amp_is_request()) : 
    if( !empty( $image ) ) :
        $i = imagecreatefromjpeg($image['sizes']['dgwltd-small']); 
        for ($x=0;$x<imagesx($i);$x++) {
            for ($y=0;$y<imagesy($i);$y++) {
                $rgb = imagecolorat($i,$x,$y);
                $r   = ($rgb >> 16) & 0xFF;
                $g   = ($rgb >> 8) & 0xFF;
                $b   = $rgb & 0xFF;
                $rTotal += $r;
                $gTotal += $g;
                $bTotal += $b;
                $total++;
            }
        }
        $rAverage = round($rTotal/$total);
        $gAverage = round($gTotal/$total);
        $bAverage = round($bTotal/$total);
    else :
        $rAverage = '196';
        $rAverage = '249';
        $rAverage = '253';
    endif;
    $hasrgb = true;
else :
    $hasrgb = false;
endif; 
?>


<?php 
//Add background color to a block based on the background image
echo $rgb = $hasrgb ? ' style="background-color:rgb('. $rAverage . ',' . $gAverage . ',' . $bAverage . ')"' : ''; 
?>

<?php 
//Is the AMP plugin (https://wordpress.org/plugins/amp/) enabled if so provide a dominant background color based on the image
if(function_exists('amp_is_request') && amp_is_request()) : ?>
<figure style="background-color:rgb(<?php echo $rAverage; ?>, <?php echo $gAverage; ?>, <?php echo $bAverage; ?>);"></figure>
<?php else : ?>
<!-- Usual image code -->
<?php endif; ?>
```



