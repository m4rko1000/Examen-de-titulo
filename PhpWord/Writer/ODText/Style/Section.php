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

namespace PhpOffice\PhpWord\Writer\ODText\Style;

/**
 * Section style writer
 *
 * @since 0.11.0
 */
class Section extends AbstractStyle
{
    /**
     * Write style.
     *
     * @return void
     */
    public function write()
    {
        /** @var \PhpOffice\PhpWord\Style\Section $style Type hint */
        $style = $this->getStyle();
        if (!$style instanceof \PhpOffice\PhpWord\Style\Section) {
            return;
        }
        $xmlWriter = $this->getXmlWriter();

        $xmlWriter->startElement('style:style');
        $xmlWriter->writeAttribute('style:name', $style->getStyleName());
        $xmlWriter->writeAttribute('style:family', "section");
        $xmlWriter->startElement('style:section-properties');

        $xmlWriter->startElement('style:columns');
        $xmlWriter->writeAttribute('fo:column-count', $style->getColsNum());
        $xmlWriter->endElement();

        $xmlWriter->endElement();
        $xmlWriter->endElement();
    }
}
