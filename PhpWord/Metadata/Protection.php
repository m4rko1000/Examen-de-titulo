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
 * Document protection class
 *
 * @since 0.12.0
 * @link http:
 * @todo Password!
 */
class Protection
{
    /**
     * Editing restriction readOnly|comments|trackedChanges|forms
     *
     * @var string
     * @link http:
     */
    private $editing;

    /**
     * Create a new instance
     *
     * @param string $editing
     */
    public function __construct($editing = null)
    {
        $this->setEditing($editing);
    }

    /**
     * Get editing protection
     *
     * @return string
     */
    public function getEditing()
    {
        return $this->editing;
    }

    /**
     * Set editing protection
     *
     * @param string $editing
     * @return self
     */
    public function setEditing($editing = null)
    {
        $this->editing = $editing;

        return $this;
    }
}
