# Ohm's Law and Power

Ohm's law is the first relationship every maker learns, and the one you will use most. It connects three things you can measure: **voltage** (the electrical "push", in volts, V), **current** (the flow, in amperes or amps, A), and **resistance** (how much the part resists the flow, in ohms, Ω). A fourth value, **power** (the rate energy is turned into heat or work, in watts, W), follows from them.

## The idea

Picture water in a pipe. Voltage is the water pressure, current is how much water flows, and resistance is how narrow the pipe is. More pressure pushes more flow. A narrower pipe lets less through. Electricity behaves the same way, and the numbers work out exactly:

- **V = I × R**: voltage equals current times resistance
- **P = V × I**: power equals voltage times current

Combine them and you get the other forms, which this calculator uses depending on which two values you know:

| You know | Resistance | Current | Voltage | Power |
| --- | --- | --- | --- | --- |
| V and I | V ÷ I | | | V × I |
| V and R | | V ÷ R | | V² ÷ R |
| V and P | V² ÷ P | P ÷ V | | |
| I and R | | | I × R | I² × R |
| I and P | P ÷ I² | | P ÷ I | |
| R and P | | √(P ÷ R) | √(P × R) | |

## How to use it

1. Type any **two** values into the four boxes. For example voltage `12` and current `20m` (20 milliamps).
2. The other two boxes fill in on their own and turn blue. They are answers, not inputs.
3. To change which two are the inputs, just type in a different box. The two you edited most recently are always the inputs.
4. Press **Clear** to start over.

Values must be greater than zero. Prefixes work, so `4.7k` is 4,700 and `20m` is 0.02 (see [Using the Calculators](Using-the-Calculators)).

## Reading the results

Below the four values you get the **power dissipated**, which is the heat the part has to get rid of, and two resistor ratings:

- **Smallest rating that works**: the first standard size (1/8, 1/4, 1/2, 1, 2, 3, 5, 10, 25, 50, 100 W) that is not smaller than the power. A resistor at exactly its limit runs very hot.
- **Recommended resistor rating**: the first standard size that is at least **twice** the power. This is a common "50 % derating" rule of thumb. A resistor that only works at half its rating runs cooler and lasts longer. The calculator also shows the safety margin, so 0.24 W on a 1/2 W part reads "2.1× safety margin".

## Step by step

Open the **Ohm's Law** tab. It is the first tab, and it opens with 12 V and 20 mA already filled in.

1. Look at the four boxes: **Voltage (V)**, **Current (A)**, **Resistance (Ω)**, and **Power (W)**.
2. Click in the **Voltage (V)** box and type the voltage you know, for example `5`.
3. Click in the **Current (A)** box and type the current, for example `20m` for 20 milliamps.
4. The **Resistance** and **Power** boxes fill in by themselves and turn blue. Blue means "calculated", not "typed".
5. Want to work from different values instead? Just click another box and type. Say you now know the resistor is `330`: click **Resistance (Ω)** and type `330`. The two boxes you typed in most recently (here Current and Resistance) become the inputs, so Voltage and Power turn blue and recalculate. To make Voltage an input again, click it and type a value.
6. Read the list under the boxes: **Power dissipated** tells you how much heat the part makes, and **Recommended resistor rating** tells you what wattage of resistor to buy.
7. Click **Clear** to empty all four boxes and begin again.

## Worked example

You want 20 mA through a load from a 12 V supply. Enter `12` and `20m`. The calculator shows resistance **600 Ω** and power **240 mW**. The smallest rating that works is 1/4 W, but the recommended rating is **1/2 W** (2.1× margin).

## Things to watch

- Ohm's law is for resistors and other "ohmic" parts. An LED or diode does not follow V = I × R, because its voltage stays nearly fixed as current changes. Use the [LED Resistor](LED-Resistor) calculator for those.
- Dissipation grows with the **square** of current. Doubling the current makes four times the heat.
- Wattage ratings assume open air at room temperature. Enclosed or hot spots need extra margin.

![Ohm's Law and Power calculator](images/ohms-law.png)
