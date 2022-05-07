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

namespace PhpOffice\PhpWord\Writer\Word2007\Style;

use PhpOffice\PhpWord\Style\Cell as CellStyle;

/**
 * Cell style writer
 *
 * @since 0.10.0
 */
class Cell extends AbstractStyle
{
    /**
     * @var int Cell width
     */
    private $width;

    /**
     * Write style.
     *
     * @return void
     */
    public function write()
    {
        $style = $this->getStyle();
        if (!$style instanceof CellStyle) {
            return;
        }
        $xmlWriter = $this->getXmlWriter();

        $xmlWriter->startElement('w:tcPr');


        $xmlWriter->startElement('w:tcW');
        $xmlWriter->writeAttribute('w:w', $this->width);
        $xmlWriter->writeAttribute('w:type', 'dxa');
        $xmlWriter->endElement();


        $textDir = $style->getTextDirection();
        $xmlWriter->writeElementIf(!is_null($textDir), 'w:textDirection', 'w:val', $textDir);


        $vAlign = $style->getVAlign();
        $xmlWriter->writeElementIf(!is_null($vAlign), 'w:vAlign', 'w:val', $vAlign);


        if ($style->hasBorder()) {
            $xmlWriter->startElement('w:tcBorders');

            $styleWriter = new MarginBorder($xmlWriter);
            $styleWriter->setSizes($style->getBorderSize());
            $styleWriter->setColors($style->getBorderColor());
            $styleWriter->setAttributes(array('defaultColor' => CellStyle::DEFAULT_BORDER_COLOR));
            $styleWriter->write();

            $xmlWriter->endElement();
        }


        $shading = $style->getShading();
        if (!is_null($shading)) {
            $styleWriter = new Shading($xmlWriter, $shading);
            $styleWriter->write();
        }


        $gridSpan = $style->getGridSpan();
        $vMerge = $style->getVMerge();
        $xmlWriter->writeElementIf(!is_null($gridSpan), 'w:gridSpan', 'w:val', $gridSpan);
        $xmlWriter->writeElementIf(!is_null($vMerge), 'w:vMerge', 'w:val', $vMerge);

        $xmlWriter->endElement();
    }

    /**
     * Set width.
     *
     * @param int $value
     * @return void
     */
    public function setWidth($value = null)
    {
        $this->width = $value;
    }
}
