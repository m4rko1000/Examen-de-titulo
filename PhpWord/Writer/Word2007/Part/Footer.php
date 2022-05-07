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

use PhpOffice\PhpWord\Writer\Word2007\Element\Container;

/**
 * Word2007 footer part writer: word/footerx.xml
 */
class Footer extends AbstractPart
{
    /**
     * Root element name
     *
     * @var string
     */
    protected $rootElement = 'w:ftr';

    /**
     * Footer/header element to be written
     *
     * @var \PhpOffice\PhpWord\Element\Footer
     */
    protected $element;

    /**
     * Write part
     *
     * @return string
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();
        $drawingSchema = 'http:

        $xmlWriter->startDocument('1.0', 'UTF-8', 'yes');
        $xmlWriter->startElement($this->rootElement);
        $xmlWriter->writeAttribute('xmlns:ve', 'http:
        $xmlWriter->writeAttribute('xmlns:o', 'urn:schemas-microsoft-com:office:office');
        $xmlWriter->writeAttribute('xmlns:r', 'http:
        $xmlWriter->writeAttribute('xmlns:m', 'http:
        $xmlWriter->writeAttribute('xmlns:v', 'urn:schemas-microsoft-com:vml');
        $xmlWriter->writeAttribute('xmlns:wp', $drawingSchema);
        $xmlWriter->writeAttribute('xmlns:w10', 'urn:schemas-microsoft-com:office:word');
        $xmlWriter->writeAttribute('xmlns:w', 'http:
        $xmlWriter->writeAttribute('xmlns:wne', 'http:

        $containerWriter = new Container($xmlWriter, $this->element);
        $containerWriter->write();

        $xmlWriter->endElement(); 

        return $xmlWriter->getData();
    }

    /**
     * Set element
     *
     * @param \PhpOffice\PhpWord\Element\Footer|\PhpOffice\PhpWord\Element\Header $element
     * @return self
     */
    public function setElement($element)
    {
        $this->element = $element;

        return $this;
    }
}
