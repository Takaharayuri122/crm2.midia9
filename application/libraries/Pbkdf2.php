<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * CodeIgniter PBKDF2 Library
 *
 * Copyright (c) 2012 Hashem Qolami. (http://qolami.com)
 * Released under the MIT license.
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * PBKDF2 (Password-Based Key Derivation Function 2) is a key derivation function
 * that is part of RSA Laboratories' Public-Key Cryptography Standards (PKCS) series,
 * specifically PKCS #5 v2.0, also published as Internet Engineering Task Force's RFC 2898
 * (http://tools.ietf.org/html/rfc2898)
 *
 * 
 * @package   CodeIgniter
 * @subpackage  Libraries
 * @category  Libraries
 * @author    Hashem Qolami <hashem@qolami.com>
 * @link      https://github.com/HashemQolami/CodeIgniter-PBKDF2-Library
 * @license   http://opensource.org/licenses/MIT (MIT license)
 * @copyright 2012 Hashem Qolami
 * @since     1.0.0
 * @version   1.0.1
 *
*/
class Pbkdf2
{
    /**
     * Generate the new key
     *
     * @param  string  $hash       The hash algorithm to be used by HMAC
     * @param  string  $password   The source password/key
     * @param  string  $salt
     * @param  int $iterations The number of iterations
     * @param  int $length     The output size
     * @throws Exception\InvalidArgumentException
     * @return string
     */
    public static function calc($hash, $password, $salt, $iterations, $length)
    {
        if (!Hmac::isSupported($hash)) {
            throw new Exception\InvalidArgumentException("The hash algorithm $hash is not supported by " . __CLASS__);
        }

        $num    = ceil($length / Hmac::getOutputSize($hash, Hmac::OUTPUT_BINARY));
        $result = '';
        for ($block = 1; $block <= $num; $block++) {
            $hmac = hash_hmac($hash, $salt . pack('N', $block), $password, Hmac::OUTPUT_BINARY);
            $mix  = $hmac;
            for ($i = 1; $i < $iterations; $i++) {
                $hmac = hash_hmac($hash, $hmac, $password, Hmac::OUTPUT_BINARY);
                $mix ^= $hmac;
            }
            $result .= $mix;
        }
        return substr($result, 0, $length);
    }
}

class Hmac
{
    const OUTPUT_STRING = false;
    const OUTPUT_BINARY = true;

    /**
     * Last algorithm supported
     *
     * @var string|null
     */
    protected static $lastAlgorithmSupported;

    /**
     * Performs a HMAC computation given relevant details such as Key, Hashing
     * algorithm, the data to compute MAC of, and an output format of String,
     * or Binary.
     *
     * @param  string  $key
     * @param  string  $hash
     * @param  string  $data
     * @param  bool $output
     * @throws Exception\InvalidArgumentException
     * @return string
     */
    public static function compute($key, $hash, $data, $output = self::OUTPUT_STRING)
    {
        if (empty($key)) {
            throw new Exception\InvalidArgumentException('Provided key is null or empty');
        }

        if (!$hash || ($hash !== static::$lastAlgorithmSupported && !static::isSupported($hash))) {
            throw new Exception\InvalidArgumentException(
                "Hash algorithm is not supported on this PHP installation; provided '{$hash}'"
            );
        }

        return hash_hmac($hash, $data, $key, $output);
    }

    /**
     * Get the output size according to the hash algorithm and the output format
     *
     * @param  string  $hash
     * @param  bool $output
     * @return int
     */
    public static function getOutputSize($hash, $output = self::OUTPUT_STRING)
    {
        return strlen(static::compute('key', $hash, 'data', $output));
    }

    /**
     * Get the supported algorithm
     *
     * @return array
     */
    public static function getSupportedAlgorithms()
    {
        return hash_algos();
    }

    /**
     * Is the hash algorithm supported?
     *
     * @param  string $algorithm
     * @return bool
     */
    public static function isSupported($algorithm)
    {
        if ($algorithm === static::$lastAlgorithmSupported) {
            return true;
        }

        if (in_array(strtolower($algorithm), hash_algos(), true)) {
            static::$lastAlgorithmSupported = $algorithm;
            return true;
        }

        return false;
    }

    /**
     * Clear the cache of last algorithm supported
     */
    public static function clearLastAlgorithmCache()
    {
        static::$lastAlgorithmSupported = null;
    }
}

/* End of file Pbkdf2.php */
/* Location: ./application/libraries/Pbkdf2.php */