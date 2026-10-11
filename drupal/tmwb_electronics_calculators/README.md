# TMWB Electronics Calculators (Drupal module)

Embeds the [Circuit Calculators](https://github.com/MakersWorkbench/circuit-calculators) into any Drupal 10 or 11 page. The module is branded TMWB (TheMakersWorkbench.com) but is not tied to any particular site or theme.

## What does it do?

- Adds a text filter, **TMWB Electronics Calculators Embed**. It replaces a placeholder in your content with the calculators.
- Loads the tool's CSS and JavaScript through a normal Drupal library, only on pages that use it.
- Adds a short server-rendered description under the tool (optional), because the tool itself is built by JavaScript and search engines and visitors without JavaScript need real text.
- Adds Schema.org `WebApplication` structured data (JSON-LD) to the page head (optional).
- Sizes everything in pixels and resets a theme's global form styles inside the tool, so it looks the same on any theme.

## Install

1. Copy this folder to `web/modules/custom/tmwb_electronics_calculators`.
2. Enable it: `drush en tmwb_electronics_calculators` (or on the Extend page).
3. Go to **Configuration > Content authoring > Text formats and editors**, edit the format your content uses (for example Full HTML), and enable **TMWB Electronics Calculators Embed**. Open its settings to turn the description and structured data on or off.
4. Clear caches: `drush cr`.

## Use

In the source view of any content that uses that text format, add:

```html
<div class="tmwb-electronics-calculators"></div>
```

Optional: `data-heading="h3"` sets the heading level of the tool's title (default `h2`). Only the first placeholder on a page is used, because the tool mounts on a fixed element id.

The text format must allow `div` elements with a `class` attribute (Full HTML does), and this filter should run before any filter that strips them.

## Keeping the bundled copy current

The module ships its own copy of the tool in `assets/`. After changing the tool in the repository root, run `python scripts/sync_drupal_module.py` from the repository to refresh it.

## License

Apache License 2.0. See `assets/LICENSE` and `assets/NOTICE`. Keep the attribution intact.
