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

## Gallery

`.dgwltd-gallery` to make a Wordpress gallery block into a modal one (and make sure link to settings are large)