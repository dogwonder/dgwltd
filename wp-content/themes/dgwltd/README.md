# DGW.ltd Wordpress theme

## Requirements

| Prerequisite    | How to check | How to install                                  |
| --------------- | ------------ | ----------------------------------------------- |
| PHP >= 7.3.x    | `php -v`     | [php.net](http://php.net/manual/en/install.php) |
| Node.js >= 12.0 | `node -v`    | [nodejs.org](http://nodejs.org/)                |
| gulp >= 4.0.0   | `gulp -v`    | `npm install -g gulp`                           |

## Build

- `npm run start` — Compile assets when file changes are made
- `npm run production` — Compile assets for production

## Overrides for Framework

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

## Custom blocks

- DG Accordion - based on GOV.UK's [accordian pattern](https://design-system.service.gov.uk/components/accordion/) 
- DG Cards - grid of cards linking to other pages, title, exerpt and featured image 
- DG CTA - call to action split text and image
- DG Details - based on GOV.UK's [details pattern](https://design-system.service.gov.uk/components/details/)
- DG Embed - lite embed custom element for [Youtube](https://github.com/paulirish/lite-youtube-embed) and [Vimeo](https://github.com/slightlyoff/lite-vimeo)
- DG Feature - text and background image similar to hero but less showy
- DG Image - custom image with aspect ratio variables
- DG Hero - hero section with big image / video as background
- DG Summary list - based on GOV.UK's [summary list pattern](https://design-system.service.gov.uk/components/summary-list/) 
- DG Related pages - list of related links

## Custom block patterns

Built as a plugin `dgwltd-block-patterns` this allows for pre-made collections of blocks, accessible under the 'DGW.ltd' in patterns dropdown

- Supporters
- FAQs
- Columns - dark
- Columns - light
- Meet the team

## Templates

### Blocks template

`template-layout.php` 

For home and gateway pages, allows for full width blocks (e.g. DG Hero / DG Feature) these can be used in any post or page but would be restricted to a fixed width and look weird. 


### Guide template

`template-guide.php`

Similar to NHS [contents guide](https://www.nhs.uk/conditions/type-2-diabetes/) this allows for a parent / child relationshiop to be created with all child pages listed with the parent as the first item on a contents list. Allows the user to navigate forwards and backwards through the contents list. 

### Blog template

`template-blog.php`

Blog / posts list template

### Search results template

`template-search.php`

Search results template


## Gallery

Add the Additional CSS class(es) `.dgwltd-gallery` to the block 'Gallery' make a Wordpress gallery block into a modal one (and make sure link to settings are Media file)

Based on PhotoSwipe [Javascript gallery](https://photoswipe.com) 
