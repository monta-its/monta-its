<?php
/**
 * Eloquent dengan tambahan mekanisme validasi.
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Models\Elegant
 *
 */

namespace Simta\Models;
use Eloquent;

class Elegant extends Eloquent
{
    protected $rules = array();

    protected $errors;

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->messages();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}