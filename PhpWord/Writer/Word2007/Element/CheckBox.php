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
 * CheckBox element writer
 *
 * @since 0.10.0
 */
class CheckBox extends Text
{
    /**
     * Write element.
     *
     * @return void
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();
        $element = $this->getElement();
        if (!$element instanceof \PhpOffice\PhpWord\Element\CheckBox) {
            return;
        }

        $this->startElementP();

        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'begin');
        $xmlWriter->startElement('w:ffData');
        $xmlWriter->startElement('w:name');
        $xmlWriter->writeAttribute('w:val', $this->getText($element->getName()));
        $xmlWriter->endElement();
        $xmlWriter->writeAttribute('w:enabled', '');
        $xmlWriter->startElement('w:calcOnExit');
        $xmlWriter->writeAttribute('w:val', '0');
        $xmlWriter->endElement();
        $xmlWriter->startElement('w:checkBox');
        $xmlWriter->writeAttribute('w:sizeAuto', '');
        $xmlWriter->startElement('w:default');
        $xmlWriter->writeAttribute('w:val', 0);
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $xmlWriter->writeRaw(' FORMCHECKBOX ');
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'separate');
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'end');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $xmlWriter->startElement('w:r');

        $this->writeFontStyle();

        $xmlWriter->startElement('w:t');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $xmlWriter->writeRaw($this->getText($element->getText()));
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $this->endElementP();
    }
}
