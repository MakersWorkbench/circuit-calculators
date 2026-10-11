# Using the Calculators

## Pick a tab, type values

Choose the tab for the job. Every tab starts with a working example already filled in, so you can see what a result looks like, then change the numbers to yours. Answers update as you type; there is no Calculate button.

## Prefixes

You can type values the way they are written on schematics.

| Type | Means |
| --- | --- |
| `p` | pico, 10⁻¹² |
| `n` | nano, 10⁻⁹ |
| `u` | micro, 10⁻⁶ |
| `m` | milli, 10⁻³ |
| `k` | kilo, 10³ |
| `M` | mega, 10⁶ |

Examples: `4.7k` is 4,700 ohms, `4k7` is also 4,700 ohms, `100n` is 100 nanofarads, `20m` is 20 milli (so `20m` in a current box is 20 mA). A capital `M` is mega and a lowercase `m` is milli, so watch the case. Units such as `V`, `A`, `F`, or `Ω` after the number are ignored.

Fields labeled in a unit like mA, µA, or pF take a plain number in that unit: `20` in a "LED current (mA)" box means 20 mA.

## Engineering notation

Results are shown with the nearest prefix, so 0.0047 A reads **4.7 mA** and 15100 Ω reads **15.1 kΩ**.

## Ohm's Law tab

This tab has four fields. Fill in any two. The two you edited last are the inputs, and the other two fill in as answers (they are shaded blue). Clear starts over.

## Standard value series

Tabs that pick real resistors ask which series to use: E6 (20 %), E12 (10 %), E24 (5 %), E48 (2 %), or E96 (1 %). Higher numbers mean more values per decade and closer matches, but you need parts of that tolerance.
