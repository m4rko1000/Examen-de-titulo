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

namespace PhpOffice\PhpWord\Reader\Word2007;

use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\XMLReader;

/**
 * Document reader
 *
 * @since 0.10.0
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod) For readWPNode
 */
class Document extends AbstractPart
{
    /**
     * PhpWord object
     *
     * @var \PhpOffice\PhpWord\PhpWord
     */
    private $phpWord;

    /**
     * Read document.xml.
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     * @return void
     */
    public function read(PhpWord $phpWord)
    {
        $this->phpWord = $phpWord;
        $xmlReader = new XMLReader();
        $xmlReader->getDomFromZip($this->docFile, $this->xmlFile);
        $readMethods = array('w:p' => 'readWPNode', 'w:tbl' => 'readTable', 'w:sectPr' => 'readWSectPrNode');

        $nodes = $xmlReader->getElements('w:body/*');
        if ($nodes->length > 0) {
            $section = $this->phpWord->addSection();
            foreach ($nodes as $node) {
                if (isset($readMethods[$node->nodeName])) {
                    $readMethod = $readMethods[$node->nodeName];
                    $this->$readMethod($xmlReader, $node, $section);
                }
            }
        }
    }

    /**
     * Read header footer.
     *
     * @param array $settings
     * @param \PhpOffice\PhpWord\Element\Section &$section
     * @return void
     */
    private function readHeaderFooter($settings, Section &$section)
    {
        $readMethods = array('w:p' => 'readParagraph', 'w:tbl' => 'readTable');

        if (is_array($settings) && isset($settings['hf'])) {
            foreach ($settings['hf'] as $rId => $hfSetting) {
                if (isset($this->rels['document'][$rId])) {
                    list($hfType, $xmlFile, $docPart) = array_values($this->rels['document'][$rId]);
                    $addMethod = "add{$hfType}";
                    $hfObject = $section->$addMethod($hfSetting['type']);


                    $xmlReader = new XMLReader();
                    $xmlReader->getDomFromZip($this->docFile, $xmlFile);
                    $nodes = $xmlReader->getElements('*');
                    if ($nodes->length > 0) {
                        foreach ($nodes as $node) {
                            if (isset($readMethods[$node->nodeName])) {
                                $readMethod = $readMethods[$node->nodeName];
                                $this->$readMethod($xmlReader, $node, $hfObject, $docPart);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Read w:sectPr
     *
     * @param \PhpOffice\PhpWord\Shared\XMLReader $xmlReader
     * @param \DOMElement $domNode
     * @ignoreScrutinizerPatch
     * @return array
     */
    private function readSectionStyle(XMLReader $xmlReader, \DOMElement $domNode)
    {
        $styleDefs = array(
            'breakType'     => array(self::READ_VALUE, 'w:type'),
            'pageSizeW'     => array(self::READ_VALUE, 'w:pgSz', 'w:w'),
            'pageSizeH'     => array(self::READ_VALUE, 'w:pgSz', 'w:h'),
            'orientation'   => array(self::READ_VALUE, 'w:pgSz', 'w:orient'),
            'colsNum'       => array(self::READ_VALUE, 'w:cols', 'w:num'),
            'colsSpace'     => array(self::READ_VALUE, 'w:cols', 'w:space'),
            'topMargin'     => array(self::READ_VALUE, 'w:pgMar', 'w:top'),
            'leftMargin'    => array(self::READ_VALUE, 'w:pgMar', 'w:left'),
            'bottomMargin'  => array(self::READ_VALUE, 'w:pgMar', 'w:bottom'),
            'rightMargin'   => array(self::READ_VALUE, 'w:pgMar', 'w:right'),
            'headerHeight'  => array(self::READ_VALUE, 'w:pgMar', 'w:header'),
            'footerHeight'  => array(self::READ_VALUE, 'w:pgMar', 'w:footer'),
            'gutter'        => array(self::READ_VALUE, 'w:pgMar', 'w:gutter'),
        );
        $styles = $this->readStyleDefs($xmlReader, $domNode, $styleDefs);



        $nodes = $xmlReader->getElements('*', $domNode);
        foreach ($nodes as $node) {
            if ($node->nodeName == 'w:headerReference' || $node->nodeName == 'w:footerReference') {
                $id = $xmlReader->getAttribute('r:id', $node);
                $styles['hf'][$id] = array(
                    'method' => str_replace('w:', '', str_replace('Reference', '', $node->nodeName)),
                    'type' => $xmlReader->getAttribute('w:type', $node),
                );
            }
        }

        return $styles;
    }

    /**
     * Read w:p node.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLReader $xmlReader
     * @param \DOMElement $node
     * @param \PhpOffice\PhpWord\Element\Section &$section
     * @return void
     *
     * @todo <w:lastRenderedPageBreak>
     */
    private function readWPNode(XMLReader $xmlReader, \DOMElement $node, Section &$section)
    {

        if ($xmlReader->getAttribute('w:type', $node, 'w:r/w:br') == 'page') {
            $section->addPageBreak();
        }


        $this->readParagraph($xmlReader, $node, $section);


        if ($xmlReader->elementExists('w:pPr/w:sectPr', $node)) {
            $sectPrNode = $xmlReader->getElement('w:pPr/w:sectPr', $node);
            if ($sectPrNode !== null) {
                $this->readWSectPrNode($xmlReader, $sectPrNode, $section);
            }
            $section = $this->phpWord->addSection();
        }
    }

    /**
     * Read w:sectPr node.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLReader $xmlReader
     * @param \DOMElement $node
     * @param \PhpOffice\PhpWord\Element\Section &$section
     * @return void
     */
    private function readWSectPrNode(XMLReader $xmlReader, \DOMElement $node, Section &$section)
    {
        $style = $this->readSectionStyle($xmlReader, $node);
        $section->setStyle($style);
        $this->readHeaderFooter($style, $section);
    }
}
