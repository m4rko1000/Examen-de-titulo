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
 * Font style writer
 *
 * @since 0.10.0
 */
class Font extends AbstractStyle
{
    /**
     * Write style.
     *
     * @return void
     */
    public function write()
    {
        $style = $this->getStyle();
        if (!$style instanceof \PhpOffice\PhpWord\Style\Font) {
            return;
        }
        $xmlWriter = $this->getXmlWriter();

        $xmlWriter->startElement('style:style');
        $xmlWriter->writeAttribute('style:name', $style->getStyleName());
        $xmlWriter->writeAttribute('style:family', 'text');
        $xmlWriter->startElement('style:text-properties');


        $font = $style->getName();
        $xmlWriter->writeAttributeIf($font != '', 'style:font-name', $font);
        $xmlWriter->writeAttributeIf($font != '', 'style:font-name-complex', $font);
        $size = $style->getSize();


        $xmlWriter->writeAttributeIf(is_numeric($size), 'fo:font-size', $size . 'pt');
        $xmlWriter->writeAttributeIf(is_numeric($size), 'style:font-size-asian', $size . 'pt');
        $xmlWriter->writeAttributeIf(is_numeric($size), 'style:font-size-complex', $size . 'pt');


        $color = $style->getColor();
        $xmlWriter->writeAttributeIf($color != '', 'fo:color', '#' . $color);


        $xmlWriter->writeAttributeIf($style->isBold(), 'fo:font-weight', 'bold');
        $xmlWriter->writeAttributeIf($style->isBold(), 'style:font-weight-asian', 'bold');
        $xmlWriter->writeAttributeIf($style->isItalic(), 'fo:font-style', 'italic');
        $xmlWriter->writeAttributeIf($style->isItalic(), 'style:font-style-asian', 'italic');
        $xmlWriter->writeAttributeIf($style->isItalic(), 'style:font-style-complex', 'italic');



        $underline = $style->getUnderline();
        $xmlWriter->writeAttributeIf($underline != 'none', 'style:text-underline-style', 'solid');


        $xmlWriter->writeAttributeIf($style->isStrikethrough(), 'style:text-line-through-type', 'single');
        $xmlWriter->writeAttributeIf($style->isDoubleStrikethrough(), 'style:text-line-through-type', 'double');


        $xmlWriter->writeAttributeIf($style->isSmallCaps(), 'fo:font-variant', 'small-caps');
        $xmlWriter->writeAttributeIf($style->isAllCaps(), 'fo:text-transform', 'uppercase');


        $xmlWriter->writeAttributeIf($style->isSuperScript(), 'style:text-position', 'super');
        $xmlWriter->writeAttributeIf($style->isSubScript(), 'style:text-position', 'sub');





        $xmlWriter->endElement();
        $xmlWriter->endElement();
    }
}
