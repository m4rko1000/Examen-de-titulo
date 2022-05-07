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
 * Footnote element writer
 *
 * @since 0.10.0
 */
class Footnote extends Text
{
    /**
     * Reference type footnoteReference|endnoteReference
     *
     * @var string
     */
    protected $referenceType = 'footnoteReference';

    /**
     * Write element.
     *
     * @return void
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();
        $element = $this->getElement();
        if (!$element instanceof \PhpOffice\PhpWord\Element\Footnote) {
            return;
        }

        $this->startElementP();

        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:rPr');
        $xmlWriter->startElement('w:rStyle');
        $xmlWriter->writeAttribute('w:val', ucfirst($this->referenceType));
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->startElement("w:{$this->referenceType}");
        $xmlWriter->writeAttribute('w:id', $element->getRelationId());
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $this->endElementP();
    }
}
