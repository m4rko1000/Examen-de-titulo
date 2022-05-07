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

use PhpOffice\PhpWord\Style\Section as SectionStyle;

/**
 * Section style writer
 *
 * @since 0.10.0
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
        $style = $this->getStyle();
        if (!$style instanceof SectionStyle) {
            return;
        }
        $xmlWriter = $this->getXmlWriter();


        $breakType = $style->getBreakType();
        $xmlWriter->writeElementIf(!is_null($breakType), 'w:type', 'w:val', $breakType);


        $xmlWriter->startElement('w:pgSz');
        $xmlWriter->writeAttribute('w:orient', $style->getOrientation());
        $xmlWriter->writeAttribute('w:w', $style->getPageSizeW());
        $xmlWriter->writeAttribute('w:h', $style->getPageSizeH());
        $xmlWriter->endElement();


        $margins = array(
            'w:top'    => array('getMarginTop', SectionStyle::DEFAULT_MARGIN),
            'w:right'  => array('getMarginRight', SectionStyle::DEFAULT_MARGIN),
            'w:bottom' => array('getMarginBottom', SectionStyle::DEFAULT_MARGIN),
            'w:left'   => array('getMarginLeft', SectionStyle::DEFAULT_MARGIN),
            'w:header' => array('getHeaderHeight', SectionStyle::DEFAULT_HEADER_HEIGHT),
            'w:footer' => array('getFooterHeight', SectionStyle::DEFAULT_FOOTER_HEIGHT),
            'w:gutter' => array('getGutter', SectionStyle::DEFAULT_GUTTER),
        );
        $xmlWriter->startElement('w:pgMar');
        foreach ($margins as $attribute => $value) {
            list($method, $default) = $value;
            $xmlWriter->writeAttribute($attribute, $this->convertTwip($style->$method(), $default));
        }
        $xmlWriter->endElement();


        if ($style->hasBorder()) {
            $xmlWriter->startElement('w:pgBorders');
            $xmlWriter->writeAttribute('w:offsetFrom', 'page');

            $styleWriter = new MarginBorder($xmlWriter);
            $styleWriter->setSizes($style->getBorderSize());
            $styleWriter->setColors($style->getBorderColor());
            $styleWriter->setAttributes(array('space' => '24'));
            $styleWriter->write();

            $xmlWriter->endElement();
        }


        $colsSpace = $style->getColsSpace();
        $xmlWriter->startElement('w:cols');
        $xmlWriter->writeAttribute('w:num', $style->getColsNum());
        $xmlWriter->writeAttribute('w:space', $this->convertTwip($colsSpace, SectionStyle::DEFAULT_COLUMN_SPACING));
        $xmlWriter->endElement();


        $pageNum = $style->getPageNumberingStart();
        $xmlWriter->writeElementIf(!is_null($pageNum), 'w:pgNumType', 'w:start', $pageNum);


        $styleWriter = new LineNumbering($xmlWriter, $style->getLineNumbering());
        $styleWriter->write();
    }
}
