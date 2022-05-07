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

namespace PhpOffice\PhpWord\Style;

/**
 * Alignment style
 *
 * @link http:
 * @since 0.11.0
 */
class Alignment extends AbstractStyle
{
    /**
     * @const string Alignment http:
     */
    const ALIGN_LEFT = 'left';
    const ALIGN_RIGHT = 'right';
    const ALIGN_CENTER = 'center';
    const ALIGN_BOTH = 'both';
    const ALIGN_JUSTIFY = 'justify';

    /**
     * @var string Alignment
     */
    private $value = null;

    /**
     * Create a new instance
     *
     * @param array $style
     */
    public function __construct($style = array())
    {
        $this->setStyleByArray($style);
    }

    /**
     * Get alignment
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set alignment
     *
     * @param string $value
     * @return self
     */
    public function setValue($value = null)
    {
        if (strtolower($value) == self::ALIGN_JUSTIFY) {
            $value = self::ALIGN_BOTH;
        }
        $enum = array(self::ALIGN_LEFT, self::ALIGN_RIGHT, self::ALIGN_CENTER, self::ALIGN_BOTH, self::ALIGN_JUSTIFY);
        $this->value = $this->setEnumVal($value, $enum, $this->value);

        return $this;
    }
}
