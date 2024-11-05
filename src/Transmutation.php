<?php

namespace Vectorial1024\Transmutation;

use ArrayAccess;
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
}
