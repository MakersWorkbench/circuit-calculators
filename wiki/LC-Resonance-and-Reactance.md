# LC Resonance and Reactance

Coils (inductors) and capacitors respond to AC in opposite ways, and at one special frequency they cancel. That is the principle behind radio tuners, filters, and oscillators.

## The theory

Resistance opposes current the same at any frequency. Coils and capacitors oppose AC current by an amount that depends on frequency, called **reactance** (in ohms, like resistance).

- A **coil** resists changes in current. The faster the signal, the more it resists: **XL = 2π × f × L**. At DC it is a wire; at high frequency it is nearly a block.
- A **capacitor** passes fast changes and blocks slow ones: **XC = 1 ÷ (2π × f × C)**. At DC it blocks; at high frequency it is nearly a wire.

L is inductance in henries (H), C is capacitance in farads (F), and f is frequency in hertz (Hz).

XL rises with frequency and XC falls. They are equal at the **resonant frequency**:

**f0 = 1 ÷ (2π × √(L × C))**

At resonance, a series LC circuit passes the signal easily, and a parallel LC circuit blocks it. The **characteristic impedance** √(L ÷ C) is a useful measure of the circuit's "size" in ohms.

## How to use it

Fill in whichever values you have:

- **L and C** give the resonant frequency and characteristic impedance.
- **f and L** give the coil's reactance at that frequency.
- **f and C** give the capacitor's reactance at that frequency.

Each answer appears when its inputs are there.

## Worked example

L = 1 mH and C = 1 µF resonate at **5.03 kHz** with a characteristic impedance of **31.6 Ω**. At 1 kHz the coil has only **6.28 Ω** of reactance but the capacitor has **159 Ω**. As frequency climbs toward 5 kHz these two meet.

## Things to watch

- Real coils have wire resistance and stray capacitance, and capacitors have stray inductance, so a built circuit resonates a little off the calculated value.
- For a radio tuning circuit, a variable capacitor changes C and so moves f0.
- Resonant circuits can build up large voltages, bigger than the supply. Check component ratings.

![LC Resonance and Reactance calculator](images/lc-reactance.png)
