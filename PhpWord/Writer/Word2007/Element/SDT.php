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

use PhpOffice\PhpWord\Element\SDT as SDTElement;
use PhpOffice\PhpWord\Shared\XMLWriter;

/**
 * Structured document tag element writer
 *
 * @since 0.12.0
 * @link http:
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
 */
class SDT extends Text
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
        if (!$element instanceof SDTElement) {
            return;
        }
        $type = $element->getType();
        $writeFormField = "write{$type}";

        $this->startElementP();

        $xmlWriter->startElement('w:sdt');


        $xmlWriter->startElement('w:sdtPr');
        $xmlWriter->writeElementBlock('w:id', 'w:val', rand(100000000, 999999999));
        $xmlWriter->writeElementBlock('w:lock', 'w:val', 'sdtLocked');
        $this->$writeFormField($xmlWriter, $element);
        $xmlWriter->endElement();


        $xmlWriter->startElement('w:sdtContent');
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:t');
        $xmlWriter->writeRaw('Pick value');
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $xmlWriter->endElement();

        $this->endElementP();
    }

    /**
     * Write combo box.
     *
     * @link http:
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \PhpOffice\PhpWord\Element\SDT $element
     * @return void
     */
    private function writeComboBox(XMLWriter $xmlWriter, SDTElement $element)
    {
        $type = $element->getType();
        $listItems = $element->getListItems();

        $xmlWriter->startElement("w:{$type}");
        foreach ($listItems as $key => $val) {
            $xmlWriter->writeElementBlock('w:listItem', array('w:value' => $key, 'w:displayText' => $val));
        }
        $xmlWriter->endElement();
    }

    /**
     * Write drop down list.
     *
     * @link http:
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \PhpOffice\PhpWord\Element\SDT $element
     * @return void
     */
    private function writeDropDownList(XMLWriter $xmlWriter, SDTElement $element)
    {
        $this->writecomboBox($xmlWriter, $element);
    }

    /**
     * Write date.
     *
     * @link http:
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \PhpOffice\PhpWord\Element\SDT $element
     * @return void
     */
    private function writeDate(XMLWriter $xmlWriter, SDTElement $element)
    {
        $type = $element->getType();

        $xmlWriter->startElement("w:{$type}");
        $xmlWriter->writeElementBlock('w:dateFormat', 'w:val', 'd/M/yyyy');
        $xmlWriter->writeElementBlock('w:lid', 'w:val', 'en-US');
        $xmlWriter->writeElementBlock('w:storeMappedDataAs', 'w:val', 'dateTime');
        $xmlWriter->writeElementBlock('w:calendar', 'w:val', 'gregorian');
        $xmlWriter->endElement();
    }
}
