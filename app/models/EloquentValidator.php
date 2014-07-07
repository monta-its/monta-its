<?php

/**
 * Kelas EloquentValidator
 * Eloquent ditambah dengan fungsi validator
 * Gunakan pada model yang sudah ditambah kemampuan validasi
 * Tambahkan protected $rules untuk definisi rules di setiap kelasnya
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 *
 */

class EloquentValidator extends Eloquent {
    public $validatorMessage = null;

    public function validate($data)
    {
        $result = Validator::make($data, $this->rules);

        // Get validator message
        $this->validatorMessage = $result->messages()->all();

        return $result->passes();
    }

    public function save(array $options = array())
    {
        if($this->validate($this->toArray()))
        {
            return parent::save($options);
        }
        else
        {
            return false;
        }
    }
}
