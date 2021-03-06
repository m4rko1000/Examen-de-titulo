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

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\XMLReader;

/**
 * Footnotes reader
 *
 * @since 0.10.0
 */
class Footnotes extends AbstractPart
{
    /**
     * Collection name footnotes|endnotes
     *
     * @var string
     */
    protected $collection = 'footnotes';

    /**
     * Element name footnote|endnote
     *
     * @var string
     */
    protected $element = 'footnote';

    /**
     * Read (footnotes|endnotes).xml.
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     * @return void
     */
    public function read(PhpWord $phpWord)
    {
        $getMethod = "get{$this->collection}";
        $collection = $phpWord->$getMethod()->getItems();

        $xmlReader = new XMLReader();
        $xmlReader->getDomFromZip($this->docFile, $this->xmlFile);
        $nodes = $xmlReader->getElements('*');
        if ($nodes->length > 0) {
            foreach ($nodes as $node) {
                $id = $xmlReader->getAttribute('w:id', $node);
                $type = $xmlReader->getAttribute('w:type', $node);



                if (is_null($type) && isset($collection[$id])) {
                    $element = $collection[$id];
                    $pNodes = $xmlReader->getElements('w:p/*', $node);
                    foreach ($pNodes as $pNode) {
                        $this->readRun($xmlReader, $pNode, $element, $this->collection);
                    }
                    $addMethod = "add{$this->element}";
                    $phpWord->$addMethod($element);
                }
            }
        }
    }
}
