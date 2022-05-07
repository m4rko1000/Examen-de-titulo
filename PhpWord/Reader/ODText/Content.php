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

namespace PhpOffice\PhpWord\Reader\ODText;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\XMLReader;

/**
 * Content reader
 *
 * @since 0.10.0
 */
class Content extends AbstractPart
{
    /**
     * Read content.xml.
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     * @return void
     */
    public function read(PhpWord $phpWord)
    {
        $xmlReader = new XMLReader();
        $xmlReader->getDomFromZip($this->docFile, $this->xmlFile);

        $nodes = $xmlReader->getElements('office:body/office:text/*');
        if ($nodes->length > 0) {
            $section = $phpWord->addSection();
            foreach ($nodes as $node) {

                switch ($node->nodeName) {

                    case 'text:h':
                        $depth = $xmlReader->getAttribute('text:outline-level', $node);
                        $section->addTitle($node->nodeValue, $depth);
                        break;

                    case 'text:p':
                        $section->addText($node->nodeValue);
                        break;

                    case 'text:list':
                        $listItems = $xmlReader->getElements('text:list-item/text:p', $node);
                        foreach ($listItems as $listItem) {

                            $section->addListItem($listItem->nodeValue, 0);
                        }
                        break;
                }
            }
        }
    }
}
