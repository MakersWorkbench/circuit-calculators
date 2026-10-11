# Battery Life

How long will it run? Battery estimates are one of the most useful calculations in portable projects.

## The theory

A battery's capacity is rated in **milliamp-hours (mAh)**: a 2000 mAh battery can in theory supply 2000 mA for one hour, or 100 mA for 20 hours, or 10 mA for 200 hours. So:

**run time (hours) = capacity ÷ current**

Real projects rarely draw constant current. A sensor node might wake up, transmit for a second, and sleep for a minute. The **average** current is what matters. It is a weighted mix of active and sleep currents, weighted by the **duty cycle** (the fraction of time spent awake):

**average = active × duty + sleep × (1 − duty)**

## How to use it

1. Enter the **battery capacity** (mAh) from its label.
2. Enter the **active current** (mA) the device draws when awake.
3. Enter the **sleep current** in µA (type `10` for 10 µA).
4. Enter the **time awake** as a percentage (duty cycle). Awake 3 seconds out of every 60 is 5 %.
5. Enter the **usable capacity** (see below). 80 % is a sensible default.

For a device that never sleeps, enter a duty cycle of `100`.

## Why "usable capacity"?

Batteries rarely deliver their full printed rating. Cold weather, high current draw, and the voltage at which your circuit stops working (the cut-off) all reduce what you can use. The printed figure is also measured at a gentle discharge rate. Planning with 70 to 80 percent is realistic.

## Step by step

Open the **Battery Life** tab. It opens with a 2000 mAh battery, 80 mA active, 10 µA sleep, and a 5 % duty cycle.

1. In **Battery capacity (mAh)**, type the number printed on the battery, for example `2000`.
2. In **Active current (mA)**, type how much your project draws while working. Measure it with a multimeter in series with the battery if you can.
3. In **Sleep current (µA)**, type the draw while sleeping. Type `0` if it never sleeps.
4. In **Time awake (duty cycle, %)**, type the percentage of time it is awake. If it never sleeps, type `100`. If it wakes for 3 seconds every minute, that is `5`.
5. In **Usable capacity (%)**, leave `80` unless you know better.
6. Read **Average current**, then **Run time** in hours or days.
7. To see how much a change helps, adjust the duty cycle or active current and compare.

## Worked example

A 2000 mAh battery, 80 mA while awake, 10 µA asleep, awake 5 % of the time, 80 % usable. Average current = 80 × 0.05 + 0.01 × 0.95 = **4.01 mA**. Run time = 2000 × 0.8 ÷ 4.01 ≈ **399 hours**, about **16.6 days**. Notice how the average is dominated by the awake time, not the sleep current. Halving the duty cycle nearly doubles the life.

## Things to watch

- Self-discharge is not included, and it matters over months or years.
- A real battery's voltage falls as it empties. A regulator can waste a lot of energy, so also account for its quiescent current.
- Radio and motor currents come in short high pulses that a battery may struggle to deliver, even when the average is small.

![Battery Life calculator](images/battery-life.png)
