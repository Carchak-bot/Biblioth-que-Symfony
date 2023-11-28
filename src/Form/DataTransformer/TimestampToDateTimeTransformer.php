<?php
// src/Form/DataTransformer/TimestampToDateTimeTransformer.php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TimestampToDateTimeTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        // Transforme un timestamp en objet \DateTimeInterface
        if ($value === null) {
            return null;
        }

        return new \DateTime('@' . $value);
    }

    public function reverseTransform($value)
    {
        // Transforme un objet \DateTimeInterface en timestamp
        if ($value === null) {
            return null;
        }

        return $value->getTimestamp();
    }
}