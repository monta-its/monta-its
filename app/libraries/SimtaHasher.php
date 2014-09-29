<?php 
/**
 * Mengatur perilaku hash yang biasa digunakan pada password.
 * DEVELOPMENT NOTE:
 *     19/7/2014 : sementara tidak menggunakan algoritma hash apapun
 *         untuk kemudahan saja saat pengecekan dan pengujian.
 */

namespace Simta\Libraries;
use Illuminate\Hashing\HasherInterface;

class SimtaHasher implements HasherInterface {
    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public function make($value, array $options = array())
    {
        return $value;
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param  string  $value
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = array())
    {
        return $value == $hashedValue;
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = array())
    {
        return false;
    }
}