<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContainBadWords implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $lists = file_get_contents(
            sprintf("%s/%s", public_path("wordlist"), 'badword.list')
        );
        if(strpos($value,$lists) !== false){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':CONTAIN BAD WORDS!';
    }
}
