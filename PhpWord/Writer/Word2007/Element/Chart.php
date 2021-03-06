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

use PhpOffice\PhpWord\Element\Chart as ChartElement;

/**
 * Chart element writer
 *
 * @since 0.12.0
 */
class Chart extends AbstractElement
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
        if (!$element instanceof ChartElement) {
            return;
        }

        $rId = $element->getRelationId();
        $style = $element->getStyle();

        if (!$this->withoutP) {
            $xmlWriter->startElement('w:p');
        }

        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:drawing');
        $xmlWriter->startElement('wp:inline');

        
        $xmlWriter->writeElementBlock('wp:extent', array('cx' => $style->getWidth(), 'cy' => $style->getHeight()));
        $xmlWriter->writeElementBlock('wp:docPr', array('id' => $rId, 'name' => "Chart{$rId}"));

        $xmlWriter->startElement('a:graphic');
        $xmlWriter->writeAttribute('xmlns:a', 'http:
        $xmlWriter->startElement('a:graphicData');
        $xmlWriter->writeAttribute('uri', 'http:

        $xmlWriter->startElement('c:chart');
        $xmlWriter->writeAttribute('r:id', "rId{$rId}");
        $xmlWriter->writeAttribute('xmlns:c', 'http:
        $xmlWriter->writeAttribute('xmlns:r', 'http:
        $xmlWriter->endElement(); 

        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 

        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 

        $this->endElementP(); 
    }
}
