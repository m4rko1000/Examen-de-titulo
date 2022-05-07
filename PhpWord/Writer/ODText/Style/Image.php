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
 * Image style writer
 *
 * @since 0.11.0
 */
class Image extends AbstractStyle
{
    /**
     * Write style.
     *
     * @return void
     */
    public function write()
    {
        /** @var \PhpOffice\PhpWord\Style\Image $style Type hint */
        $style = $this->getStyle();
        if (!$style instanceof \PhpOffice\PhpWord\Style\Image) {
            return;
        }
        $xmlWriter = $this->getXmlWriter();

        $xmlWriter->startElement('style:style');
        $xmlWriter->writeAttribute('style:name', $style->getStyleName());
        $xmlWriter->writeAttribute('style:family', 'graphic');
        $xmlWriter->writeAttribute('style:parent-style-name', 'Graphics');
        $xmlWriter->startElement('style:graphic-properties');
        $xmlWriter->writeAttribute('style:vertical-pos', 'top');
        $xmlWriter->writeAttribute('style:vertical-rel', 'baseline');
        $xmlWriter->endElement();
        $xmlWriter->endElement();
    }
}
