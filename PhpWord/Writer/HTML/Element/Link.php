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

namespace PhpOffice\PhpWord\Writer\HTML\Element;

/**
 * Link element HTML writer
 *
 * @since 0.10.0
 */
class Link extends Text
{
    /**
     * Write link
     *
     * @return string
     */
    public function write()
    {
        if (!$this->element instanceof \PhpOffice\PhpWord\Element\Link) {
            return '';
        }

        $content = '';
        $content .= $this->writeOpening();
        $content .= "<a href=\"{$this->element->getSource()}\">{$this->element->getText()}</a>";
        $content .= $this->writeClosing();

        return $content;
    }
}
