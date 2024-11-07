<?php

namespace Vectorial1024\Transmutation;

use ArrayAccess;
use ArrayIterator;
use ArrayObject;
use Traversable;
use Vectorial1024\AlofLib\Alof;

/**
 * The "collections" class for array-like objects.
 * @template T of ArrayAccess&Traversable
 */
class Transmutation
{
    /**
     * The array-like object instance to transmute on.
     * @var ArrayAccess&Traversable
     */
    private ArrayAccess&Traversable $alo;

    /**
     * Creates an instance of Transmutation.
     * @param ArrayAccess&Traversable $alo The array-like object instance to transmute on.
     */
    public function __construct(ArrayAccess&Traversable $alo)
    {
        $this->alo = $alo;
    }

    /**
     * Returns the keys of this transmutation, with optional filtering.
     * @param mixed $filter_value (optional) the value to filter by
     * @param bool $strict (optional) whether to use strict comparison (===) while filtering
     * @return static<ArrayObject>
     */
    public function keys(mixed $filter_value = null, bool $strict = false): static
    {
        $result = Alof::alo_keys($this->alo, $filter_value, strict: $strict);
        return new static(new ArrayObject($result));
    }

    /**
     * Returns the values of this transmutation.
     * @return static<ArrayObject>
     */
    public function values(): static
    {
        $result = Alof::alo_values($this->alo);
        return new static(new ArrayObject($result));
    }

    /**
     * Returns the array-like object inside this transmutation. Exact type returned depends on how this transmutation was constructed.
     * @return ArrayAccess&Traversable
     */
    public function all(): ArrayAccess&Traversable
    {
        return $this->alo;
    }

    /**
     * Converts the transmutation into an array. Incompatible array keys will result in exceptions.
     * @param bool $force If true, force-drops all existing (object) keys and reassigns with automatic array indexes.
     * @return array
     */
    public function toArray(bool $force = false): array
    {
        if ($this->alo instanceof ArrayObject || $this->alo instanceof ArrayIterator) {
            /**
             * @var ArrayObject|ArrayIterator
             */
            $temp = $this->alo;
            return $temp->getArrayCopy();
        }
        if ($force) {
            // force-drops all array keys; this is trivial
            return $this->values()->toArray();
        }
        $result = [];
        Alof::alo_walk($this->alo, function (mixed $value, mixed $key) use (&$result) {
            $result[$key] = $value;
        });
        return $result;
    }
}
