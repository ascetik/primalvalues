# primalvalues

Some Classes to handle primitive types

## Release Notes

> v.O.1.0 : draft

- **PrimalValue** interface - still incomplete
- **PrimalString** implementation - now a string can have its methods...
- **Numerik** implementation - a numeric value with methods.

## PrimalString

An object oriented way to handle strings.

**PrimalString**'s constructor is private.
To instanciate a PrimalString, use either of() or empty() static methods.

Methods and descriptions :

- **charAt**(_int_ \$index): _self_
  Returns a new self instance with the letter of the current value at given index.
  On negative \$index, search starts from the end of current value.
  Empty instance if $index is higher than value's length.

- **concat**(_string|self_ \$sequence): _self_
  Returns a new self with the specified string appended to current string

- **contains**(_string/self_ \$sequence): _bool_
  Checks if current value contains given sequence.

- **endsWith**(_string/self_ \$sequence): _bool_
  Checks if current value ends with given sequence.

- **equals**(_mixed_ \$string): bool
  Checks value equality for a given **PrimalString**, strict equality otherwise.

- **indexOf**(_string/self_ \$sequence): int
  Returns the index of a sequence of this value, -1 if the sequence is not found

- **isEmpty**(): bool
  Checks if current value is empty

- **lastIndexOf**(string/self \$sequence): _int_
  Returns the index of the last found sequence, -1 if not found

- **length**(): _int_
  Returns current value's length

- **matches**(string \$regex): _bool_
  Checks current value format using a regular expression

- **replace**(_string|self|array_ \$oldVal, _string|self|array_ \$newVal): _self_
  Returns a new self instance with replaced sequence.

- **replaceAll**(_string|array_ \$regex, _string|self|array_ \$replacement): _self_
  Replaces from current value all sequences matching given expressions with replacements.

- **split**(_string_ \$regex): _array_
  Returns an array of string sequences from splitting current value using given regex pattern.

- **startsWith**(_string/self_ \$sequence): _bool_
  Checks if current value starts with given sequence.

- **subString**(_int_ \$offset, _?int_ \$length): _self_
  Returns a new self instance from current value starting from $offset with $length characters if given, until the end if not, or an empty self instance if an error occured.

- **toArray**(): _array_
  Returns an array of self instances for each character of current value.

- **toLowerCase**(): _self_
  Returns a new self instance with lower-cased current value.

- **toUpperCase**(): _self_
  Returns a new self instance with upper-cased current value.

- **trim**(_string|self|null_ \$chars): _self_
  Returns a new self instance from current value after removing trailing spaces and $chars at start and end.

- static **of**(_string_ \$sequence): _self_
  Returns a new self instance with given sequence

- static **empty**(): _self_
  Returns a new self empty instance

## Numerik

Object orientd way to handle numeric values.
No difference is made between an integer and a float value in this version.

Private constructor. Use _of_ or _zero_ static methods to build a **Numerik** instance.

Methods and descriptions :

- **add**(_int|float|self_ \$number): _self_
  Return a new self instance with the sum of current value and the given one

- **cube**(): _self_
  Returns anw self instance with current value at power of 3.

- **decrement**(_int|float|self_ \$decrease = 1): self
  Returns a new self instance with current value decreased with given value.

- **divides**(_int|float|self_ \$dividend): _self_
  Returns a new self instance with the result of given number divided by self value.
  A zero self instance if returned if current value == 0

- **dividedBy**(_int|float|self_ \$divider): _self_
  Returns a new self instance with the result of self value divided by given number.
  A zero self instance if returned if \$number == 0

- **equals**(): _bool_
  Checks strict equality between current instance and given value.

- **exposing**(_int|float|self_ \$number): _self_
  Returns self instance of given number raised to the power of current value.

- **increment**(_int|float|self_ \$increase = 1): self
  Returns a new self instance with current value increased with given value.

- **multiply**(_int|float|self_ \$number): self
  Returns a new self instance with the product of current value and given number.

- **power**(_int|float|self_ \$exponent): _self_
  Returns a self instance with current value raised at power \$exponent.

- **square**(): _self_
  Returns anw self instance with current value at power of 2.

- **squareRoot**(): _self_
  Returns a self instance with current value square root.

- **subtract**(_int|float|self_ \$number): _self_
  Returns a self instance with current value minus \$number.

- **subtractTo**(_int|float|self_ \$number): _self_
  Returns a self instance with \$number minus current value.

- **toFloat**(): _float_
  Returns self instance with current value as integer.

- **toInteger**(): _int_
  Returns self instance with current value as integer.

- **value**(): _int|float_
  Returns current value

- static **of**(_int|float_ $number): _self_
  Returns self instance with given number.

- static **zero**(): _self_
  Returns self instance with 0.

## Next release

Maybe some more calculation methods for **Numerik** class, including trigonometric ones (cos, sin, tan...)
Some other methods in **PrimalString** if i need to...

Are booleans concerned about this kind of consideration ?
A boolean is either true or false, valid or not...
What should i implement? A _valid()_ method and that's all ?
The _hypothetik_ package already handles boolean case with the appropriate management.
