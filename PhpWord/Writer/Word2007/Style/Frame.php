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

use PhpOffice\PhpWord\Shared\XMLWriter;
use PhpOffice\PhpWord\Style\Alignment as AlignmentStyle;
use PhpOffice\PhpWord\Style\Frame as FrameStyle;

/**
 * Frame style writer
 *
 * @since 0.12.0
 */
class Frame extends AbstractStyle
{
    /**
     * Write style.
     *
     * @return void
     */
    public function write()
    {
        $style = $this->getStyle();
        if (!$style instanceof FrameStyle) {
            return;
        }
        $xmlWriter = $this->getXmlWriter();

        $zIndices = array(FrameStyle::WRAP_INFRONT => PHP_INT_MAX, FrameStyle::WRAP_BEHIND => -PHP_INT_MAX);

        $properties = array(
            'width'     => 'width',
            'height'    => 'height',
            'left'      => 'margin-left',
            'top'       => 'margin-top',
        );
        $sizeStyles = $this->getStyles($style, $properties, $style->getUnit());

        $properties = array(
            'pos'       => 'position',
            'hPos'      => 'mso-position-horizontal',
            'vPos'      => 'mso-position-vertical',
            'hPosRelTo' => 'mso-position-horizontal-relative',
            'vPosRelTo' => 'mso-position-vertical-relative',
        );
        $posStyles = $this->getStyles($style, $properties);

        $styles = array_merge($sizeStyles, $posStyles);


        $wrap = $style->getWrap();
        if ($wrap !== null && isset($zIndices[$wrap])) {
            $styles['z-index'] = $zIndices[$wrap];
            $wrap = null;
        }


        $xmlWriter->writeAttribute('style', $this->assembleStyle($styles));

        $this->writeWrap($xmlWriter, $style, $wrap);
    }

    /**
     * Write alignment.
     *
     * @return void
     */
    public function writeAlignment()
    {
        $style = $this->getStyle();
        if (!$style instanceof FrameStyle) {
            return;
        }

        $xmlWriter = $this->getXmlWriter();
        $xmlWriter->startElement('w:pPr');
        $styleWriter = new Alignment($xmlWriter, new AlignmentStyle(array('value' => $style->getAlign())));
        $styleWriter->write();
        $xmlWriter->endElement();
    }

    /**
     * Write alignment.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \PhpOffice\PhpWord\Style\Frame $style
     * @param string $wrap
     * @return void
     */
    private function writeWrap(XMLWriter $xmlWriter, FrameStyle $style, $wrap)
    {
        if ($wrap !== null) {
            $xmlWriter->startElement('w10:wrap');
            $xmlWriter->writeAttribute('type', $wrap);

            $relativePositions = array(
                FrameStyle::POS_RELTO_MARGIN  => 'margin',
                FrameStyle::POS_RELTO_PAGE    => 'page',
                FrameStyle::POS_RELTO_TMARGIN => 'margin',
                FrameStyle::POS_RELTO_BMARGIN => 'page',
                FrameStyle::POS_RELTO_LMARGIN => 'margin',
                FrameStyle::POS_RELTO_RMARGIN => 'page',
            );
            $pos = $style->getPos();
            $hPos = $style->getHPosRelTo();
            $vPos = $style->getVPosRelTo();

            if ($pos == FrameStyle::POS_ABSOLUTE) {
                $xmlWriter->writeAttribute('anchorx', "page");
                $xmlWriter->writeAttribute('anchory', "page");
            } elseif ($pos == FrameStyle::POS_RELATIVE) {
                if (isset($relativePositions[$hPos])) {
                    $xmlWriter->writeAttribute('anchorx', $relativePositions[$hPos]);
                }
                if (isset($relativePositions[$vPos])) {
                    $xmlWriter->writeAttribute('anchory', $relativePositions[$vPos]);
                }
            }

            $xmlWriter->endElement();
        }
    }

    /**
     * Get style values in associative array
     *
     * @param \PhpOffice\PhpWord\Style\Frame $style
     * @param array $properties
     * @param string $suffix
     * @return array
     */
    private function getStyles(FrameStyle $style, $properties, $suffix = '')
    {
        $styles = array();

        foreach ($properties as $key => $property) {
            $method = "get{$key}";
            $value = $style->$method();
            if ($value !== null) {
                $styles[$property] = $style->$method() . $suffix;
            }
        }

        return $styles;
    }
}
