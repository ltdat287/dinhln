<?php namespace VirtualProject\Validations;

use Illuminate\Validation\Validator;
use Carbon\Carbon;
use VirtualProject\Helpers\MemberHelper;

class VirtualProjectValidator extends Validator
{
    /**
     * Function for custom validation vpdate.
     * 
     * @param string $attribute
     * @param string $value
     * @param array $parameters
     * @return boolean
     */
    public function validateVPDate($attribute, $value, $parameters)
    {
        // Parse current value to time
        $curDate = Carbon::createFromFormat(VP_TIME_FORMAT, $value);
        
        // Get min date
        $minDate = Carbon::createFromFormat(VP_TIME_FORMAT, VP_DATE_MIN);
        
        // Get max date
        $maxDate = Carbon::createFromFormat(VP_TIME_FORMAT, MemberHelper::getMaxDate());

        if ($minDate < $curDate && $curDate < $maxDate)
        {
            return true;
        }
        
        return false;
    }
    
    /**
     * Function for custom validation vptelephone.
     * 
     * @param string $attribute
     * @param string $value
     * @param array $parameters
     * @return boolean
     */
    public function validateVPTelephone($attribute, $value, $parameters)
    {
        if (preg_match("/0(?:\d\-\d{4}|\d{2}\-\d{3}|\d{3}\-\d{2}|\d{4}\-\d{1})\-\d{4}$/", $value)) {
            return true;
        }
        
        return false;
    }

    /**
     * Function for custom validation vpemail.
     *
     * @param string $attribute
     * @param string $value
     * @param array $parameters
     * @return boolean
     */
    public function validateVPEmail($attribute, $value, $parameters)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) || $value == VP_EMAIL_DEFAULT)
        {
            return true;
        }
    
        return true;
    }
}
