# Circuit Calculators

Free electronics calculators for makers, by [TheMakersWorkbench.com](https://www.themakersworkbench.com). One page, twenty calculators, no build step and no dependencies. Type values with prefixes like `4.7k`, `100n`, or `20m`, and the answers update as you type, with the formula and the working shown.

![Circuit Calculators](wiki/images/overview.png)

## The calculators

| Tab | What it does |
| --- | --- |
| Ohm's Law | Enter any two of voltage, current, resistance, and power. Shows the resistor wattage to use and the safety margin. |
| LED Resistor | Series or parallel LEDs, nearest standard value, actual current, resistor power, and a drawn circuit. |
| Voltage Divider | Searches E12, E24, E48, or E96 pairs for a target output. Shows error, divider current, resistor power, loaded output, and output impedance. |
| Resistors S/P | Series and parallel totals, and a search for the closest combination to a target. |
| Capacitors S/P | Series and parallel totals, and a search for the closest combination to a target. |
| RC Filter | Time constant, cutoff frequency, charge times, and a designer that finds R or C for a cutoff. |
| LC & Reactance | Resonant frequency, reactance, Q, and bandwidth. |
| 555 Timer | Astable frequency and duty cycle, monostable pulse length. |
| LM317 | Resistor for a target voltage, voltage from the resistors, or a constant-current resistor. |
| Wire Gauge | AWG size, resistance, voltage drop, and power lost. |
| I²C Pull-up | Allowed pull-up range for 100 kHz, 400 kHz, and 1 MHz buses. |
| Battery Life | Run time from capacity, load, sleep current, and duty cycle. |
| BJT Switch | Base resistor for saturating an NPN transistor. |
| MOSFET Switch | Conduction loss, drop, and gate resistor. |
| Op-Amp Gain | Inverting, non-inverting, summing, and difference stages. |
| Zener Regulator | Series resistor and power ratings. |
| Divider Tolerance | Worst-case divider output for a resistor tolerance. |
| Current Shunt | Shunt value, power, and amplifier gain. |
| NTC Thermistor | Temperature and resistance from the Beta equation. |
| Decibels | dB, dBm, watts, and ratios. |

## Run it

Open `index.html` in a browser. It is plain HTML, CSS, and JavaScript. To serve it locally: `python -m http.server` in this folder.

Run the tests (Node 18 or newer, no packages needed):

```
node --test tests/calc-logic.test.js
```

## Embed it

Add this to any page, then load `calc.css`, `js/calc-logic.js`, and `js/calc-app.js`:

```html
<div class="tmwb-calc" id="tmwb-calc" data-heading="h2"></div>
```

`data-heading` sets the heading level of the tool's title (default `h1`). All styles are scoped under `.tmwb-calc` and sized in pixels, so the tool does not restyle your page and your theme's root font size does not resize it.

### Drupal module

`drupal/tmwb_electronics_calculators` is a Drupal 10/11 module (TMWB Electronics Calculators) that embeds the tool from a text-format filter. See the [Embedding wiki page](https://github.com/MakersWorkbench/circuit-calculators/wiki/Embedding) or the module's own README.

## Files

- `index.html`, `calc.css`: the page and styles
- `js/calc-logic.js`: all the math, no DOM access, tested in Node
- `js/calc-app.js`: the interface
- `tests/`: unit tests for the math
- `drupal/tmwb_electronics_calculators/`: Drupal module (run `python scripts/sync_drupal_module.py` after changing the tool to refresh its bundled copy)
- `SOURCES.md`: where each formula and constant comes from

## Accuracy

The formulas are the usual textbook and datasheet ones and describe ideal parts. Real components have tolerance, temperature drift, and parasitic effects. Always confirm anything that matters against the datasheet and a meter.

## License

[Apache License 2.0](LICENSE). Free for commercial and non-commercial use. You may modify it and add to it, as long as the license, the [NOTICE](NOTICE), and the "Developed and Maintained by TheMakersWorkbench.com" attribution stay intact.
