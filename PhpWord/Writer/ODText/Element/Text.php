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

namespace PhpOffice\PhpWord\Writer\ODText\Element;

use PhpOffice\PhpWord\Exception\Exception;

/**
 * Text element writer
 *
 * @since 0.10.0
 */
class Text extends AbstractElement
{
    /**
     * Write element
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();
        $element = $this->getElement();
        if (!$element instanceof \PhpOffice\PhpWord\Element\Text) {
            return;
        }
        $fontStyle = $element->getFontStyle();
        $paragraphStyle = $element->getParagraphStyle();



        $fStyleIsObject = false;

        if ($fStyleIsObject) {

            throw new Exception('PhpWord : $fStyleIsObject wouldn\'t be an object');
        } else {
            if (!$this->withoutP) {
                $xmlWriter->startElement('text:p');
            }
            if (empty($fontStyle)) {
                if (empty($paragraphStyle)) {
                    $xmlWriter->writeAttribute('text:style-name', 'P1');
                } elseif (is_string($paragraphStyle)) {
                    $xmlWriter->writeAttribute('text:style-name', $paragraphStyle);
                }
                $xmlWriter->writeRaw($element->getText());
            } else {
                if (empty($paragraphStyle)) {
                    $xmlWriter->writeAttribute('text:style-name', 'Standard');
                } elseif (is_string($paragraphStyle)) {
                    $xmlWriter->writeAttribute('text:style-name', $paragraphStyle);
                }

                $xmlWriter->startElement('text:span');
                if (is_string($fontStyle)) {
                    $xmlWriter->writeAttribute('text:style-name', $fontStyle);
                }
                $xmlWriter->writeRaw($element->getText());
                $xmlWriter->endElement();
            }
            if (!$this->withoutP) {
                $xmlWriter->endElement();
            }
        }
    }
}
