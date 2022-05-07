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

namespace PhpOffice\PhpWord\Element;

use PhpOffice\PhpWord\Shared\String;
use PhpOffice\PhpWord\Style;

/**
 * Bookmark element
 */
class Bookmark extends AbstractElement
{
    /**
     * Bookmark Name
     *
     * @var string
     */
    private $name;

    /**
     * Is part of collection
     *
     * @var bool
     */
    protected $collectionRelation = true;

    /**
     * Create a new Bookmark Element
     *
     * @param string $name
     */
    public function __construct($name)
    {

        $this->name = String::toUTF8($name);
        return $this;
    }

    /**
     * Get Bookmark name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
