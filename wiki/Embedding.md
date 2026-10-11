# Embedding

## Any web page

Copy `calc.css`, `js/calc-logic.js`, and `js/calc-app.js` from the repository, then add:

```html
<link rel="stylesheet" href="calc.css">
<div class="tmwb-calc" id="tmwb-calc" data-heading="h2"></div>
<script src="js/calc-logic.js"></script>
<script src="js/calc-app.js"></script>
```

`data-heading` sets the heading level of the tool's title (`h1` to `h6`, default `h1`). Everything is scoped under `.tmwb-calc` and sized in pixels, so it will not restyle your page and your theme's root font size will not resize it. Only one copy can be on a page.

## Drupal

The repository includes `drupal/tmwb_electronics_calculators`, a Drupal 10/11 module.

1. Copy the folder to `web/modules/custom/`.
2. Enable **TMWB Electronics Calculators** (Extend page, or `drush en tmwb_electronics_calculators`).
3. Edit the text format you use for page bodies (Configuration, Text formats and editors) and turn on **TMWB Electronics Calculators Embed**. The format must allow `div` elements with a `class` attribute, and the filter should run before any filter that strips them.
4. In the body of the page, switch to source mode and add:

```html
<div class="tmwb-electronics-calculators"></div>
```

The filter swaps that placeholder for the tool, attaches its CSS and JavaScript, adds a server-rendered description (so search engines and visitors without JavaScript get real text), and optionally adds Schema.org `WebApplication` structured data. Both options are on the filter's settings.

Optional attribute: `data-heading="h3"` sets the heading level of the tool's title.
