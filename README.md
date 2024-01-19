# primalvalues

Some Classes to handle primitive types

## Release Notes

> v.O.1.0 : draft

- **PrimalValue** interface - still incomplete
- **PrimalString** implementation - now a string can have its methods...

## PrimalString

An object oriented way to handdle a string.

Methods and descriptions :

- charAt(_int_ $index): _self_
Returns a new self instance with the letter of the current value at given index. Empty instance if $index is higher than value's length.
TODO : cover negative values...

- concat(_string|self_ $sequence): _self_
Returns a new self with the specified string appended to current string

- contains(_string/self_ $sequence): _bool_
Checks if current value contains given sequence.

- endsWith(_string/self_ $sequence): _bool_
Checks if current value ends with given sequence.

- equals(_mixed_ $string): bool
Checks value equality for a given **PrimalString**, strict equality otherwise.

- indexOf(_string/self_ $sequence): int
Returns the index of a sequence of this value, -1 if the sequence is not found

- isEmpty(): bool
Checks if current value is empty

- lastIndexOf(string/self $sequence): _int_
Returns the index of the last found sequence, -1 if not found

- length(): _int_
Returns current value's length

- matches(string $regex): _bool_
Checks current value format using a regular expression

- replace(_string|self|array_ \$oldVal, _string|self|array_ \$newVal): _self_
Returns a new self instance with replaced sequence.

- replaceAll(_string|array_ \$regex, _string|self|array_ \$replacement): _self_
Replaces from current value all sequences matching given expressions with replacements.

- split(_string_ $regex): _array_
Returns an array of string sequences from splitting current value using given regex pattern.

- startsWith(_string/self_ $sequence): _bool_
Checks if current value starts with given sequence.

- subString(_int_ \$offset, _?int_ \$length): _self_
Returns a new self instance from current value starting from $offset with $length characters if given, until the end if not, or an empty self instance if an error occured.

- toArray(): _array_
Returns an array of self instances for each character of current value.

- toLowerCase(): _self_
Returns a new self instance with lower-cased current value.

- toUpperCase(): _self_
Returns a new self instance with upper-cased current value.

- trim(_string|self|null_ $chars): _self_
Returns a new self instance from current value after removing trailing spaces and $chars at start and end.

- static of(_string_ $sequence): _self_
Returns a new self instance with given sequence

- static empty(): _self_
Returns a new self empty instance

### Usage

**PrimalString**'s constructor is private.
To instanciate a PrimalString, use either of() or empty() static methods.

