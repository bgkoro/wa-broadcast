<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class NumericArrayValues implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Iterate through each value in the array
        $numbersArray = explode("\n", $value);
        $numbersArray = array_filter(array_map('trim', $numbersArray));
        foreach ($numbersArray as $item) {
            // Check if the value is not numeric
            if (!is_numeric($item)) {
                $fail('The :attribute must contain only numeric values.');
            }
        }
    }
}
