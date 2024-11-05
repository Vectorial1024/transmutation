<?php

namespace Vectorial1024\Transmutation;

use ArrayAccess;
use ArrayObject;
use Traversable;

/**
 * The "collections" class for array-like objects. Write clean and tested code for iterating over array-like objects.
 * @template TKey
 */
class Transmutation
{
    /**
     * The array-like object instance to transmute on.
     * @var ArrayAccess<TKey, mixed>&Traversable<Tkey, mixed>
     */
    private ArrayAccess&Traversable $alo;

    /**
     * Creates an instance of Transmutation.
     * @param ArrayAccess<TKey, mixed>&Traversable<TKey, mixed> $alo The array-like object instance to transmute on.
     */
    public function __construct(ArrayAccess&Traversable $alo)
    {
        $this->alo = $alo;
    }

    /**
     * Returns the keys of the given array-like object, with optional filtering.
     * @param mixed $filter_value (optional) the value to filter by
     * @param bool $strict (optional) whether to use strict comparison (===) while filtering
     * @return static
     * @see array_keys() for equivalent behavior in arrays
     */
    public function keys(mixed $filter_value = null, bool $strict = false): static
    {
        // use separate loops for best performance
        $result = [];
        if (!isset($filter_value)) {
            // keys only
            foreach ($this->alo as $key => $value) {
                $result[] = $key;
            }
            return new static(new ArrayObject($result));
        }
        if (!$strict) {
            // non-strict filtering
            foreach ($this->alo as $key => $value) {
                if ($key != $filter_value) {
                    continue;
                }
                $result[] = $key;
            }
            return new static(new ArrayObject($result));
        }
        // strict filtering
        if ($this->alo instanceof WeakMap || $this->alo instanceof SplFixedArray || $this->alo instanceof SplDoublyLinkedList) {
            // these types have strict key types; either the key exists, or it does not.
            return isset($this->alo[$filter_value]) ? new static(new ArrayObject($filter_value)) : new static(new ArrayObject());
        }
        foreach ($this->alo as $key => $value) {
            if ($key !== $filter_value) {
                continue;
            }
            $result[] = $key;
        }
        return new static(new ArrayObject($result));
    }
}
