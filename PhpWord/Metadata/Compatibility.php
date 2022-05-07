<?php

/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https:
 *
 * @link        https:
 * @copyright   2010-2014 PHPWord contributors
 * @license     http:
 */

namespace PhpOffice\PhpWord\Metadata;

/**
 * Compatibility setting class
 *
 * @since 0.12.0
 * @link http:
 */
class Compatibility
{
    /**
     * OOXML version
     *
     * 12 = 2007
     * 14 = 2010
     * 15 = 2013
     *
     * @var int
     * @link http:
     */
    private $ooxmlVersion = 12;

    /**
     * Get OOXML version
     *
     * @return int
     */
    public function getOoxmlVersion()
    {
        return $this->ooxmlVersion;
    }

    /**
     * Set OOXML version
     *
     * @param int $value
     * @return self
     */
    public function setOoxmlVersion($value)
    {
        $this->ooxmlVersion = $value;

        return $this;
    }
}
