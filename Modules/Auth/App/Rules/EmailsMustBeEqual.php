<?php

namespace Modules\Auth\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class   EmailsMustBeEqual implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value != auth()->user()->email){
            $fail('ایمیل وارد شده صحیح نمیباشد');
        }
    }

}
