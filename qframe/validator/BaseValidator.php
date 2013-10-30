<?php

class Library_Qframe_Validator_BaseValidator
{

    public static function validateIntNumber($number)
    {
        return preg_match('/^[0-9]+$/', $number);
    }

    public static function validateFloatNumber($number)
    {
        return preg_match('/^[0-9]+|[0-9]+.[0-9]+$/', $number);
    }

    public static function validateId($id)
    {
        return preg_match('/^[1-9][0-9]*$/', $id);
    }

    public static function validateDate($date)
    {
        return preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/', $date);
    }

    public static function validateDay($day)
    {
        return preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $day);
    }

    public static function validatePeriod($startDate, $endDate)
    {
        return self::validateDay($startDate) && self::validateDay($startDate) && $startDate <= $endDate;
    }

    public static function validateEmail($email)
    {
        return preg_match('/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/', $email);
    }
    
    public static function validateIntegerArray($values)
    {
        $valid = false;
        
        if(is_array($values))
        {
            if(count($values) > 0)
            {
                $numValues = count($values);
                $invalidValue = false;
                
                for($i = 0 ; $i < $numValues && !$invalidValue ; $i++)
                {
                    if(!self::validateIntNumber($values[$i]))
                    {
                        $invalidValue = true;
                    }
                }
                
                if(!$invalidValue)
                {
                    $valid = true;
                }
            }
            else
            {
                $valid = true;
            }
        }
        
        return $valid;
    }

    public static function validate(array $validations)
    {
        $methods = get_class_methods($this);

        foreach($validations as $key => $value)
        {
            $key = Library_Qframe_Model_Helper_Formatter::formatOptionName($key);

            $method = 'validate' . ucfirst($key);

            if(in_array($method, $methods))
            {
                $valid = $this->$method($value);

                if(!$valid)
                {
                    return false;
                }
            }
        }

        return true;
    }

}