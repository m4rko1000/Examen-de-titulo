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

namespace PhpOffice\PhpWord\Writer\Word2007\Element;

/**
 * PageBreak element writer
 *
 * @since 0.10.0
 */
class PageBreak extends AbstractElement
{
    /**
     * Write element.
     *
     * @usedby \PhpOffice\PhpWord\Writer\Word2007\Element\AbstractElement::startElementP()
     * @return void
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();

        $xmlWriter->startElement('w:p');
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:br');
        $xmlWriter->writeAttribute('w:type', 'page');
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->endElement();
    }
}
