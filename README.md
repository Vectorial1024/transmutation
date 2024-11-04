# transumtation
(This is a WIP project!)

PHP array-like objects utility library. Basically, the proper Collection library for array-like objects, to let you write clean code while processing them.

An array-like object ("ALO") is defined to be `implements ArrayAccess` and `implements Traversable`. Examples of array-like objects include:
- [ArrayObject](https://www.php.net/manual/en/class.arrayobject.php) (since PHP 5)
- [ArrayIterator](https://www.php.net/manual/en/class.arrayiterator.php) (since PHP 5)
- [SplObjectStorage](https://www.php.net/manual/en/class.splobjectstorage.php) (since PHP 5.1)
- [SplDoublyLinkedList](https://www.php.net/manual/en/class.spldoublylinkedlist.php) (since PHP 5.3)
- [SplFixedArray](https://www.php.net/manual/en/class.splfixedarray.php) (since PHP 5.3)
- [SplStack](https://www.php.net/manual/en/class.splstack.php) (since PHP 5.3)
- [SplQueue](https://www.php.net/manual/en/class.splqueue.php) (since PHP 5.3)
- [WeakMap](https://www.php.net/manual/en/class.weakmap.php) (since PHP 8)
- ... and perhaps more

A PHP `array` is NOT an ALO. It is still an array.

See the change log in the CHANGELOG.md file.
