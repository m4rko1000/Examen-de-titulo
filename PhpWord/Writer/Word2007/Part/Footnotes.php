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

use PhpOffice\PhpWord\Element\Footnote;
use PhpOffice\PhpWord\Shared\XMLWriter;
use PhpOffice\PhpWord\Writer\Word2007\Element\Container;
use PhpOffice\PhpWord\Writer\Word2007\Style\Paragraph as ParagraphStyleWriter;

/**
 * Word2007 footnotes part writer: word/(footnotes|endnotes).xml
 */
class Footnotes extends AbstractPart
{
    /**
     * Name of XML root element
     *
     * @var string
     */
    protected $rootNode = 'w:footnotes';

    /**
     * Name of XML node element
     *
     * @var string
     */
    protected $elementNode = 'w:footnote';

    /**
     * Name of XML reference element
     *
     * @var string
     */
    protected $refNode = 'w:footnoteRef';

    /**
     * Reference style name
     *
     * @var string
     */
    protected $refStyle = 'FootnoteReference';

    /**
     * Footnotes/endnotes collection to be written
     *
     * @var \PhpOffice\PhpWord\Collection\Footnotes|\PhpOffice\PhpWord\Collection\Endnotes
     */
    protected $elements;

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
        $xmlWriter->startElement($this->rootNode);
        $xmlWriter->writeAttribute('xmlns:ve', 'http:
        $xmlWriter->writeAttribute('xmlns:o', 'urn:schemas-microsoft-com:office:office');
        $xmlWriter->writeAttribute('xmlns:r', 'http:
        $xmlWriter->writeAttribute('xmlns:m', 'http:
        $xmlWriter->writeAttribute('xmlns:v', 'urn:schemas-microsoft-com:vml');
        $xmlWriter->writeAttribute('xmlns:wp', $drawingSchema);
        $xmlWriter->writeAttribute('xmlns:w10', 'urn:schemas-microsoft-com:office:word');
        $xmlWriter->writeAttribute('xmlns:w', 'http:
        $xmlWriter->writeAttribute('xmlns:wne', 'http:

        
        $xmlWriter->startElement($this->elementNode);
        $xmlWriter->writeAttribute('w:id', -1);
        $xmlWriter->writeAttribute('w:type', 'separator');
        $xmlWriter->startElement('w:p');
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:separator');
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
        $xmlWriter->startElement($this->elementNode);
        $xmlWriter->writeAttribute('w:id', 0);
        $xmlWriter->writeAttribute('w:type', 'continuationSeparator');
        $xmlWriter->startElement('w:p');
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:continuationSeparator');
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 

        /** @var array $elements Type hint */
        $elements = $this->elements;
        foreach ($elements as $element) {
            if ($element instanceof Footnote) {
                $this->writeNote($xmlWriter, $element);
            }
        }

        $xmlWriter->endElement(); 

        return $xmlWriter->getData();
    }

    /**
     * Set element
     *
     * @param \PhpOffice\PhpWord\Collection\Footnotes|\PhpOffice\PhpWord\Collection\Endnotes $elements
     * @return self
     */
    public function setElements($elements)
    {
        $this->elements = $elements;

        return $this;
    }

    /**
     * Write note item.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \PhpOffice\PhpWord\Element\Footnote|\PhpOffice\PhpWord\Element\Endnote $element
     * @return void
     */
    protected function writeNote(XMLWriter $xmlWriter, $element)
    {
        $xmlWriter->startElement($this->elementNode);
        $xmlWriter->writeAttribute('w:id', $element->getRelationId());
        $xmlWriter->startElement('w:p');

        
        $styleWriter = new ParagraphStyleWriter($xmlWriter, $element->getParagraphStyle());
        $styleWriter->setIsInline(true);
        $styleWriter->write();

        
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:rPr');
        $xmlWriter->startElement('w:rStyle');
        $xmlWriter->writeAttribute('w:val', $this->refStyle);
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
        $xmlWriter->writeElement($this->refNode);
        $xmlWriter->endElement(); 

        
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:t');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $xmlWriter->writeRaw(' ');
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 

        $containerWriter = new Container($xmlWriter, $element);
        $containerWriter->write();

        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
    }
}
