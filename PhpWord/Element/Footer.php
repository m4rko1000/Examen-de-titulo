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

/**
 * Footer element
 */
class Footer extends AbstractContainer
{
    /**
     * Header/footer types constants
     *
     * @var string
     * @link http:
     */
    const AUTO  = 'default';
    const FIRST = 'first';
    const EVEN  = 'even';

    /**
     * @var string Container type
     */
    protected $container = 'Footer';

    /**
     * Header type
     *
     * @var string
     */
    protected $type = self::AUTO;

    /**
     * Create new instance
     *
     * @param int $sectionId
     * @param int $containerId
     * @param string $type
     */
    public function __construct($sectionId, $containerId = 1, $type = self::AUTO)
    {
        $this->sectionId = $sectionId;
        $this->setType($type);
        $this->setDocPart($this->container, ($sectionId - 1) * 3 + $containerId);
    }

    /**
     * Set type.
     *
     * @since 0.10.0
     *
     * @param string $value
     * @return void
     */
    public function setType($value = self::AUTO)
    {
        if (!in_array($value, array(self::AUTO, self::FIRST, self::EVEN))) {
            $value = self::AUTO;
        }
        $this->type = $value;
    }

    /**
     * Get type
     *
     * @return string
     * @since 0.10.0
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Reset type to default
     *
     * @return string
     */
    public function resetType()
    {
        return $this->type = self::AUTO;
    }

    /**
     * First page only header
     *
     * @return string
     */
    public function firstPage()
    {
        return $this->type = self::FIRST;
    }

    /**
     * Even numbered pages only
     *
     * @return string
     */
    public function evenPage()
    {
        return $this->type = self::EVEN;
    }
}
