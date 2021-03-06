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

namespace PhpOffice\PhpWord\Writer\Word2007\Part;

use PhpOffice\PhpWord\Settings as PhpWordSettings;
use PhpOffice\PhpWord\Shared\XMLWriter;
use PhpOffice\PhpWord\Style;
use PhpOffice\PhpWord\Style\Font as FontStyle;
use PhpOffice\PhpWord\Style\Paragraph as ParagraphStyle;
use PhpOffice\PhpWord\Style\Table as TableStyle;
use PhpOffice\PhpWord\Writer\Word2007\Style\Font as FontStyleWriter;
use PhpOffice\PhpWord\Writer\Word2007\Style\Paragraph as ParagraphStyleWriter;
use PhpOffice\PhpWord\Writer\Word2007\Style\Table as TableStyleWriter;

/**
 * Word2007 styles part writer: word/styles.xml
 *
 * @todo Do something with the numbering style introduced in 0.10.0
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod) For writeFontStyle, writeParagraphStyle, and writeTableStyle
 */
class Styles extends AbstractPart
{
    /**
     * Write part
     *
     * @return string
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();

        $xmlWriter->startDocument('1.0', 'UTF-8', 'yes');
        $xmlWriter->startElement('w:styles');
        $xmlWriter->writeAttribute('xmlns:r', 'http:
        $xmlWriter->writeAttribute('xmlns:w', 'http:

        
        $styles = Style::getStyles();
        $this->writeDefaultStyles($xmlWriter, $styles);

        
        if (count($styles) > 0) {
            foreach ($styles as $styleName => $style) {
                if ($styleName == 'Normal') {
                    continue;
                }

                
                $styleClass = substr(get_class($style), strrpos(get_class($style), '\\') + 1);
                $method = "write{$styleClass}Style";
                if (method_exists($this, $method)) {
                    $this->$method($xmlWriter, $styleName, $style);
                }
            }
        }

        $xmlWriter->endElement(); 

        return $xmlWriter->getData();
    }

    /**
     * Write default font and other default styles.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \PhpOffice\PhpWord\Style\AbstractStyle[] $styles
     * @return void
     */
    private function writeDefaultStyles(XMLWriter $xmlWriter, $styles)
    {
        $fontName = PhpWordSettings::getDefaultFontName();
        $fontSize = PhpWordSettings::getDefaultFontSize();

        
        $xmlWriter->startElement('w:docDefaults');
        $xmlWriter->startElement('w:rPrDefault');
        $xmlWriter->startElement('w:rPr');
        $xmlWriter->startElement('w:rFonts');
        $xmlWriter->writeAttribute('w:ascii', $fontName);
        $xmlWriter->writeAttribute('w:hAnsi', $fontName);
        $xmlWriter->writeAttribute('w:eastAsia', $fontName);
        $xmlWriter->writeAttribute('w:cs', $fontName);
        $xmlWriter->endElement(); 
        $xmlWriter->startElement('w:sz');
        $xmlWriter->writeAttribute('w:val', $fontSize * 2);
        $xmlWriter->endElement(); 
        $xmlWriter->startElement('w:szCs');
        $xmlWriter->writeAttribute('w:val', $fontSize * 2);
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 

        
        $xmlWriter->startElement('w:style');
        $xmlWriter->writeAttribute('w:type', 'paragraph');
        $xmlWriter->writeAttribute('w:default', '1');
        $xmlWriter->writeAttribute('w:styleId', 'Normal');
        $xmlWriter->startElement('w:name');
        $xmlWriter->writeAttribute('w:val', 'Normal');
        $xmlWriter->endElement(); 
        if (isset($styles['Normal'])) {
            $styleWriter = new ParagraphStyleWriter($xmlWriter, $styles['Normal']);
            $styleWriter->write();
        }
        $xmlWriter->endElement(); 

        
        if (!isset($styles['FootnoteReference'])) {
            $xmlWriter->startElement('w:style');
            $xmlWriter->writeAttribute('w:type', 'character');
            $xmlWriter->writeAttribute('w:styleId', 'FootnoteReference');
            $xmlWriter->startElement('w:name');
            $xmlWriter->writeAttribute('w:val', 'Footnote Reference');
            $xmlWriter->endElement(); 
            $xmlWriter->writeElement('w:semiHidden');
            $xmlWriter->writeElement('w:unhideWhenUsed');
            $xmlWriter->startElement('w:rPr');
            $xmlWriter->startElement('w:vertAlign');
            $xmlWriter->writeAttribute('w:val', 'superscript');
            $xmlWriter->endElement(); 
            $xmlWriter->endElement(); 
            $xmlWriter->endElement(); 
        }
    }

    /**
     * Write font style.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param string $styleName
     * @param \PhpOffice\PhpWord\Style\Font $style
     * @return void
     */
    private function writeFontStyle(XMLWriter $xmlWriter, $styleName, FontStyle $style)
    {
        $paragraphStyle = $style->getParagraph();
        $styleType = $style->getStyleType();
        $type = ($styleType == 'title') ? 'paragraph' : 'character';
        if (!is_null($paragraphStyle)) {
            $type = 'paragraph';
        }

        $xmlWriter->startElement('w:style');
        $xmlWriter->writeAttribute('w:type', $type);

        
        if ($styleType == 'title') {
            $arrStyle = explode('_', $styleName);
            $styleId = 'Heading' . $arrStyle[1];
            $styleName = 'heading ' . $arrStyle[1];
            $styleLink = 'Heading' . $arrStyle[1] . 'Char';
            $xmlWriter->writeAttribute('w:styleId', $styleId);

            $xmlWriter->startElement('w:link');
            $xmlWriter->writeAttribute('w:val', $styleLink);
            $xmlWriter->endElement();
        }

        
        $xmlWriter->startElement('w:name');
        $xmlWriter->writeAttribute('w:val', $styleName);
        $xmlWriter->endElement();

        
        $xmlWriter->writeElementIf(!is_null($paragraphStyle), 'w:basedOn', 'w:val', 'Normal');

        
        if (!is_null($paragraphStyle)) {
            $styleWriter = new ParagraphStyleWriter($xmlWriter, $paragraphStyle);
            $styleWriter->write();
        }

        
        $styleWriter = new FontStyleWriter($xmlWriter, $style);
        $styleWriter->write();

        $xmlWriter->endElement();
    }

    /**
     * Write paragraph style.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param string $styleName
     * @param \PhpOffice\PhpWord\Style\Paragraph $style
     * @return void
     */
    private function writeParagraphStyle(XMLWriter $xmlWriter, $styleName, ParagraphStyle $style)
    {
        $xmlWriter->startElement('w:style');
        $xmlWriter->writeAttribute('w:type', 'paragraph');
        $xmlWriter->writeAttribute('w:customStyle', '1');
        $xmlWriter->writeAttribute('w:styleId', $styleName);
        $xmlWriter->startElement('w:name');
        $xmlWriter->writeAttribute('w:val', $styleName);
        $xmlWriter->endElement();

        
        $basedOn = $style->getBasedOn();
        $xmlWriter->writeElementIf(!is_null($basedOn), 'w:basedOn', 'w:val', $basedOn);

        
        $next = $style->getNext();
        $xmlWriter->writeElementIf(!is_null($next), 'w:next', 'w:val', $next);

        
        $styleWriter = new ParagraphStyleWriter($xmlWriter, $style);
        $styleWriter->write();

        $xmlWriter->endElement();
    }

    /**
     * Write table style.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param string $styleName
     * @param \PhpOffice\PhpWord\Style\Table $style
     * @return void
     */
    private function writeTableStyle(XMLWriter $xmlWriter, $styleName, TableStyle $style)
    {
        $xmlWriter->startElement('w:style');
        $xmlWriter->writeAttribute('w:type', 'table');
        $xmlWriter->writeAttribute('w:customStyle', '1');
        $xmlWriter->writeAttribute('w:styleId', $styleName);
        $xmlWriter->startElement('w:name');
        $xmlWriter->writeAttribute('w:val', $styleName);
        $xmlWriter->endElement();
        $xmlWriter->startElement('w:uiPriority');
        $xmlWriter->writeAttribute('w:val', '99');
        $xmlWriter->endElement();

        $styleWriter = new TableStyleWriter($xmlWriter, $style);
        $styleWriter->write();

        $xmlWriter->endElement(); 
    }
}
