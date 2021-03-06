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
 * TextBreak element writer
 *
 * @since 0.10.0
 */
class TextBreak extends Text
{
    /**
     * Write text break element.
     *
     * @return void
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();
        $element = $this->getElement();
        if (!$element instanceof \PhpOffice\PhpWord\Element\TextBreak) {
            return;
        }

        if (!$this->withoutP) {
            $hasStyle = $element->hasStyle();
            $this->startElementP();

            if ($hasStyle) {
                $xmlWriter->startElement('w:pPr');
                $this->writeFontStyle();
                $xmlWriter->endElement();
            }

            $this->endElementP();
        } else {
            $xmlWriter->writeElement('w:br');
        }
    }
}
