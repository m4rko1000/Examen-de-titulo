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

/**
 * Word2007 core document properties part writer: docProps/core.xml
 *
 * @since 0.11.0
 */
class DocPropsCore extends AbstractPart
{
    /**
     * Write part
     *
     * @return string
     */
    public function write()
    {
        $phpWord = $this->getParentWriter()->getPhpWord();
        $xmlWriter = $this->getXmlWriter();
        $schema = 'http:

        $xmlWriter->startDocument('1.0', 'UTF-8', 'yes');
        $xmlWriter->startElement('cp:coreProperties');
        $xmlWriter->writeAttribute('xmlns:cp', $schema);
        $xmlWriter->writeAttribute('xmlns:dc', 'http:
        $xmlWriter->writeAttribute('xmlns:dcterms', 'http:
        $xmlWriter->writeAttribute('xmlns:dcmitype', 'http:
        $xmlWriter->writeAttribute('xmlns:xsi', 'http:

        $xmlWriter->writeElement('dc:creator', $phpWord->getDocInfo()->getCreator());
        $xmlWriter->writeElement('dc:title', $phpWord->getDocInfo()->getTitle());
        $xmlWriter->writeElement('dc:description', $phpWord->getDocInfo()->getDescription());
        $xmlWriter->writeElement('dc:subject', $phpWord->getDocInfo()->getSubject());
        $xmlWriter->writeElement('cp:keywords', $phpWord->getDocInfo()->getKeywords());
        $xmlWriter->writeElement('cp:category', $phpWord->getDocInfo()->getCategory());
        $xmlWriter->writeElement('cp:lastModifiedBy', $phpWord->getDocInfo()->getLastModifiedBy());

        
        $xmlWriter->startElement('dcterms:created');
        $xmlWriter->writeAttribute('xsi:type', 'dcterms:W3CDTF');
        $xmlWriter->writeRaw(date($this->dateFormat, $phpWord->getDocInfo()->getCreated()));
        $xmlWriter->endElement();

        
        $xmlWriter->startElement('dcterms:modified');
        $xmlWriter->writeAttribute('xsi:type', 'dcterms:W3CDTF');
        $xmlWriter->writeRaw(date($this->dateFormat, $phpWord->getDocInfo()->getModified()));
        $xmlWriter->endElement();

        $xmlWriter->endElement(); 

        return $xmlWriter->getData();
    }
}
