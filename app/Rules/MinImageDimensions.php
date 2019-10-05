<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinImageDimensions implements Rule
{

    protected $minWidth;
    protected $minHeight;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minWidth = NULL, $minHeight = NULL)
    {
        $this->minWidth = $minWidth;
        $this->minHeight = $minHeight;
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
        $imageData = getimagesize($value->getPathName());

        $imageWidth = $imageData[0];
        $imageHeight = $imageData[1];

        if(NULL !== $this->minWidth) {
            if($imageWidth < $this->minWidth) return false;
        }

        if(NULL !== $this->minHeight) {
            if($imageHeight < $this->minHeight) return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute\'s dimensions must be least ' . $this->minWidth . 'x' . $this->minHeight . '.';
    }
}
