# Standard Values (E-Series)

Resistors do not come in every value. If you look in a parts catalogue you will find 4.7 kΩ and 5.1 kΩ but not 4.8 kΩ. The values come from standard lists called **preferred numbers**, defined by the IEC 60063 standard. Several calculators here ask you to pick one.

## Why not every value?

A resistor has a tolerance, for example ±5 %. A 100 Ω part could really be anywhere from 95 to 105 Ω. A neighboring 105 Ω part would overlap almost completely, so there is little point making it. The standard lists space the values so that each part's tolerance range just touches the next one. Tighter tolerance means more values per decade.

## The series

| Series | Values per decade | Typical tolerance |
| --- | --- | --- |
| E6 | 6 | 20 % |
| E12 | 12 | 10 % |
| E24 | 24 | 5 % |
| E48 | 48 | 2 % |
| E96 | 96 | 1 % |

A **decade** is a tenfold range, such as 100 to 1000. The same list repeats in every decade by multiplying by 10, so the E12 value 4.7 gives 4.7 Ω, 47 Ω, 470 Ω, 4.7 kΩ, 47 kΩ, and so on.

The E12 values are: 1.0, 1.2, 1.5, 1.8, 2.2, 2.7, 3.3, 3.9, 4.7, 5.6, 6.8, 8.2. The E24 series adds 1.1, 1.3, 1.6, 2.0, 2.4, 3.0, 3.6, 4.3, 5.1, 6.2, 7.5, and 9.1. The E48 and E96 lists have three significant digits (for example 1.00, 1.05, 1.10, 1.15, and so on).

## Which should I use?

- **E12 or E24** for general hobby work. Kits and drawers are usually E12 or E24 with 5 % tolerance.
- **E96** when you need accuracy, like a voltage divider setting a precise reference or a feedback network. You need 1 % parts to match.
- **E6** is typical for capacitors, because capacitors rarely have tolerances better than 20 %.

## How the calculators use them

When a calculator needs a real part, it rounds to the series you chose. The [LED Resistor](LED-Resistor) tool rounds **up** so current never exceeds your target. The [BJT Switch](BJT-Switch) tool rounds **down** to guarantee enough base current. The [Voltage Divider](Voltage-Divider) and [combination finders](Series-and-Parallel-Resistors) search every value in the series for the closest match.

For reading the color bands and codes printed on parts you have, see the [Component Marking Decoder](https://github.com/MakersWorkbench/component-marking-decoder).
