# Accuracy and Limits

The calculators use standard textbook and datasheet formulas, and [SOURCES.md](https://github.com/MakersWorkbench/circuit-calculators/blob/main/SOURCES.md) lists where each one comes from. They describe ideal parts.

- **Tolerance.** A 5 % resistor can be 5 % off, and capacitors are often 10 to 20 %. Combinations of parts stack their tolerances.
- **Typical values.** The 555 and LM317 formulas use typical datasheet figures. Individual chips vary.
- **Wire.** The wire tab calculates resistance and voltage drop, not safe current. Ampacity depends on insulation, bundling, and temperature, so use the wire's datasheet or a code table.
- **Batteries.** Capacity is rated at a low drain. Cold, high current, and cut-off voltage reduce what you get, and self-discharge is not modeled.
- **I²C.** The pull-up range follows the I²C specification. Real buses also depend on edge rates and device input thresholds.

For anything that matters, measure it and read the datasheet.
