# primalvalues

Some Classes to handle primitive types


## Release Notes

> v.O.1.0 : draft

- **PrimalValue** interface - still incomplete
- **PrimalString** implementation - now a string can have its methods...

## PrimalString

An object oriented way to handdle a string.

- **PrimalString**::charAt(_int_): _self_
- **PrimalString**::concat(_string|self_): _self_
- **PrimalString**::contains(_string|self_): _bool_
- **PrimalString**::endWith(_string|self_): _bool_
- **PrimalString**::equals(_mixed_): _ bool_
- **PrimalString**::indexOf(_string|self_): _int_
- **PrimalString**::isEmpty(): _bool_
- **PrimalString**::lastIndexOf(_string|self_): _int_
- **PrimalString**::length(): _int_
- **PrimalString**::matches(string $regex): _bool_
- **PrimalString**::replace(_string|self_, _string|self_)
- **PrimalString**::replaceAll()
- **PrimalString**::split()
- **PrimalString**::startsWith()
- **PrimalString**::subString()
- **PrimalString**::toArray()
- **PrimalString**::toLowerCase()
- **PrimalString**::toUpperCase()
- **PrimalString**::trim()
- static **PrimalString**::of()
