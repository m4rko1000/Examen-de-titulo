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

namespace PhpOffice\PhpWord\Writer\ODText\Part;

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\XMLWriter;
use PhpOffice\PhpWord\Style;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Writer\Word2007\Part\AbstractPart as Word2007AbstractPart;

/**
 * ODText writer part abstract
 */
abstract class AbstractPart extends Word2007AbstractPart
{
    /**
     * @var string Date format
     */
    protected $dateFormat = 'Y-m-d\TH:i:s.000';

    /**
     * Write common root attributes.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @return void
     */
    protected function writeCommonRootAttributes(XMLWriter $xmlWriter)
    {
        $xmlWriter->writeAttribute('office:version', '1.2');
        $xmlWriter->writeAttribute('xmlns:office', 'urn:oasis:names:tc:opendocument:xmlns:office:1.0');
        $xmlWriter->writeAttribute('xmlns:style', 'urn:oasis:names:tc:opendocument:xmlns:style:1.0');
        $xmlWriter->writeAttribute('xmlns:text', 'urn:oasis:names:tc:opendocument:xmlns:text:1.0');
        $xmlWriter->writeAttribute('xmlns:table', 'urn:oasis:names:tc:opendocument:xmlns:table:1.0');
        $xmlWriter->writeAttribute('xmlns:draw', 'urn:oasis:names:tc:opendocument:xmlns:drawing:1.0');
        $xmlWriter->writeAttribute('xmlns:fo', 'urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0');
        $xmlWriter->writeAttribute('xmlns:xlink', 'http:
        $xmlWriter->writeAttribute('xmlns:dc', 'http:
        $xmlWriter->writeAttribute('xmlns:meta', 'urn:oasis:names:tc:opendocument:xmlns:meta:1.0');
        $xmlWriter->writeAttribute('xmlns:number', 'urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0');
        $xmlWriter->writeAttribute('xmlns:svg', 'urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0');
        $xmlWriter->writeAttribute('xmlns:chart', 'urn:oasis:names:tc:opendocument:xmlns:chart:1.0');
        $xmlWriter->writeAttribute('xmlns:dr3d', 'urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0');
        $xmlWriter->writeAttribute('xmlns:math', 'http:
        $xmlWriter->writeAttribute('xmlns:form', 'urn:oasis:names:tc:opendocument:xmlns:form:1.0');
        $xmlWriter->writeAttribute('xmlns:script', 'urn:oasis:names:tc:opendocument:xmlns:script:1.0');
        $xmlWriter->writeAttribute('xmlns:ooo', 'http:
        $xmlWriter->writeAttribute('xmlns:ooow', 'http:
        $xmlWriter->writeAttribute('xmlns:oooc', 'http:
        $xmlWriter->writeAttribute('xmlns:dom', 'http:
        $xmlWriter->writeAttribute('xmlns:rpt', 'http:
        $xmlWriter->writeAttribute('xmlns:of', 'urn:oasis:names:tc:opendocument:xmlns:of:1.2');
        $xmlWriter->writeAttribute('xmlns:xhtml', 'http:
        $xmlWriter->writeAttribute('xmlns:grddl', 'http:
        $xmlWriter->writeAttribute('xmlns:tableooo', 'http:
        $xmlWriter->writeAttribute('xmlns:css3t', 'http:
    }

    /**
     * Write font faces declaration.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @return void
     */
    protected function writeFontFaces(XMLWriter $xmlWriter)
    {
        $xmlWriter->startElement('office:font-face-decls');
        $fontTable = array();
        $styles = Style::getStyles();
        $numFonts = 0;
        if (count($styles) > 0) {
            foreach ($styles as $style) {
                
                if ($style instanceof Font) {
                    $numFonts++;
                    $name = $style->getName();
                    if (!in_array($name, $fontTable)) {
                        $fontTable[] = $name;

                        
                        $xmlWriter->startElement('style:font-face');
                        $xmlWriter->writeAttribute('style:name', $name);
                        $xmlWriter->writeAttribute('svg:font-family', $name);
                        $xmlWriter->endElement();
                    }
                }
            }
        }
        if (!in_array(Settings::getDefaultFontName(), $fontTable)) {
            $xmlWriter->startElement('style:font-face');
            $xmlWriter->writeAttribute('style:name', Settings::getDefaultFontName());
            $xmlWriter->writeAttribute('svg:font-family', Settings::getDefaultFontName());
            $xmlWriter->endElement();
        }
        $xmlWriter->endElement();
    }
}
