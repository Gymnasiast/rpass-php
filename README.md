# rpass-php

Strong password generator for humans.

Features:
* Both visually and phonetically unambiguous (for Dutch)
* No shift or alternate keyboard needed when typing

Based on the original C version by Tim Kuijsten, which can be found [here](https://github.com/timkuijsten/rpass).

## Examples
Random password from a 40 bit key space:
```PHP
<?php
require 'path/to/Rpass.php';
echo new \Rpass\Rpass();
```
which will output:
```
jikmus xuzjex
```

Random password from a 60 bit key space:
```PHP
<?php
require 'path/to/Rpass.php';
echo new \Rpass\Rpass(60);
```
which will output:
```
loltuk zahxok takrep
```

## Key space requirements
The 40 bit default relies on strong storage of the password, i.e. bcrypt(3) with 
sufficient rounds. If your password is going to be stored using a weaker
cryptographic construct, you have to use a bigger key space. E.g. say you want
to generate a password you can use for one year and is stored using sha256(1).

Consider the following situation: your adversary has $20,000.00 to spend. According
to [8x Nvidia GTX 1080 Hashcat Benchmarks] as of 2016 the adversary can try 230 billion 
hashes per second, this makes that you'll need a key space of 64 bit (hashes per second *
3600 * 24 * 365 * 2).

## Licence

See LICENSE.md


[8x Nvidia GTX 1080 Hashcat Benchmarks]: https://gist.github.com/epixoip/a83d38f412b4737e99bbef804a270c40
