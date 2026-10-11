# Series and Parallel Resistors

When you do not have the exact resistor you need, you can combine the ones you do have. Two arrangements cover almost every case.

## The theory

**In series** (end to end), the same current passes through each resistor and the resistances **add**:

**R = R1 + R2 + R3 + ...**

The total is always bigger than the biggest one.

**In parallel** (side by side), the current has more than one path. More paths means it is easier for current to flow, so the total is always **smaller than the smallest** resistor. The rule uses the reciprocal (1 ÷ the value):

**1 ÷ R = 1 ÷ R1 + 1 ÷ R2 + 1 ÷ R3 + ...**

For exactly two resistors there is a shortcut: **R = (R1 × R2) ÷ (R1 + R2)** ("product over sum"). Two equal resistors in parallel give half the value.

## How to use the totals box

Type any number of values separated by spaces or commas, for example `1k 2.2k 4.7k`. The calculator shows the total in series and the total in parallel at once.

## How to find a combination for a target

The second block answers "I need 3.3 kΩ and I do not have one".

1. Enter the **target** value.
2. Choose a **series** (the values in your parts drawer: E12 for a basic kit, E24 for a bigger one).
3. The calculator searches single resistors, pairs in series, and pairs in parallel, and lists the closest six with their error.

A `+` between the values means series. A `∥` means parallel.

## Worked examples

- **Series**: 1.5 kΩ + 1.8 kΩ = **3.3 kΩ**, exactly.
- **Parallel**: 4.7 kΩ ∥ 11 kΩ = (4.7k × 11k) ÷ (4.7k + 11k) ≈ **3.29 kΩ**, within 0.2 % of 3.3 kΩ.
- **Two equal parallel**: two 10 kΩ in parallel make 5 kΩ. This is also a handy way to double the power rating.

## Things to watch

- Tolerance carries through: a combination of 5 % resistors can be about 5 % off.
- Power splits among parallel resistors in proportion to current, and equal resistors share equally. In series, the larger resistor gets the larger share of the voltage and of the power.
- Resistors are not available in every value, which is why the [Standard Values](Standard-Values-E-Series) page matters.

![Series and Parallel Resistors calculator](images/series-parallel-resistors.png)
