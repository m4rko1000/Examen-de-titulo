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

use PhpOffice\PhpWord\Shared\XMLWriter;

/**
 * ODText meta part writer: meta.xml
 *
 * @since 0.11.0
 */
class Meta extends AbstractPart
{
    /**
     * Write part
     *
     * @return string
     */
    public function write()
    {
        $phpWord = $this->getParentWriter()->getPhpWord();
        $docProps = $phpWord->getDocInfo();
        $xmlWriter = $this->getXmlWriter();

        $xmlWriter->startDocument('1.0', 'UTF-8');
        $xmlWriter->startElement('office:document-meta');
        $xmlWriter->writeAttribute('office:version', '1.2');
        $xmlWriter->writeAttribute('xmlns:office', 'urn:oasis:names:tc:opendocument:xmlns:office:1.0');
        $xmlWriter->writeAttribute('xmlns:xlink', 'http:
        $xmlWriter->writeAttribute('xmlns:dc', 'http:
        $xmlWriter->writeAttribute('xmlns:meta', 'urn:oasis:names:tc:opendocument:xmlns:meta:1.0');
        $xmlWriter->writeAttribute('xmlns:ooo', 'http:
        $xmlWriter->writeAttribute('xmlns:grddl', 'http:
        $xmlWriter->startElement('office:meta');

        
        $xmlWriter->writeElement('dc:title', $docProps->getTitle());
        $xmlWriter->writeElement('dc:subject', $docProps->getSubject());
        $xmlWriter->writeElement('dc:description', $docProps->getDescription());
        $xmlWriter->writeElement('dc:creator', $docProps->getLastModifiedBy());
        $xmlWriter->writeElement('dc:date', gmdate($this->dateFormat, $docProps->getModified()));

        
        $xmlWriter->writeElement('meta:generator', 'PHPWord');
        $xmlWriter->writeElement('meta:initial-creator', $docProps->getCreator());
        $xmlWriter->writeElement('meta:creation-date', gmdate($this->dateFormat, $docProps->getCreated()));
        $xmlWriter->writeElement('meta:keyword', $docProps->getKeywords());

        
        $properties = array('Category', 'Company', 'Manager');
        foreach ($properties as $property) {
            $method = "get{$property}";
            if ($docProps->$method() !== null) {
                $this->writeCustomProperty($xmlWriter, $property, $docProps->$method());
            }
        }

        
        
        foreach ($docProps->getCustomProperties() as $property) {
            $value = $docProps->getCustomPropertyValue($property);
            $this->writeCustomProperty($xmlWriter, $property, $value);
        }

        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 

        return $xmlWriter->getData();
    }

    /**
     * Write individual property
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param string $property
     * @param string $value
     * @return void
     *
     * @todo Handle other `$type`: double|date|dateTime|duration|boolean (4th arguments)
     */
    private function writeCustomProperty(XMLWriter $xmlWriter, $property, $value)
    {
        $xmlWriter->startElement('meta:user-defined');
        $xmlWriter->writeAttribute('meta:name', $property);
        
        
        
        $xmlWriter->writeRaw($value);
        $xmlWriter->endElement(); 
    }
}
