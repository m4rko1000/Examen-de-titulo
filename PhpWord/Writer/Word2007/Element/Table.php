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

namespace PhpOffice\PhpWord\Writer\Word2007\Element;

use PhpOffice\PhpWord\Element\Cell as CellElement;
use PhpOffice\PhpWord\Element\Row as RowElement;
use PhpOffice\PhpWord\Element\Table as TableElement;
use PhpOffice\PhpWord\Shared\XMLWriter;
use PhpOffice\PhpWord\Style\Cell as CellStyle;
use PhpOffice\PhpWord\Style\Row as RowStyle;
use PhpOffice\PhpWord\Writer\Word2007\Style\Cell as CellStyleWriter;
use PhpOffice\PhpWord\Writer\Word2007\Style\Row as RowStyleWriter;
use PhpOffice\PhpWord\Writer\Word2007\Style\Table as TableStyleWriter;

/**
 * Table element writer
 *
 * @since 0.10.0
 */
class Table extends AbstractElement
{
    /**
     * Write element.
     *
     * @return void
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();
        $element = $this->getElement();
        if (!$element instanceof TableElement) {
            return;
        }

        $rows = $element->getRows();
        $rowCount = count($rows);

        if ($rowCount > 0) {
            $xmlWriter->startElement('w:tbl');


            $this->writeColumns($xmlWriter, $element);


            $styleWriter = new TableStyleWriter($xmlWriter, $element->getStyle());
            $styleWriter->setWidth($element->getWidth());
            $styleWriter->write();


            for ($i = 0; $i < $rowCount; $i++) {
                $this->writeRow($xmlWriter, $rows[$i]);
            }

            $xmlWriter->endElement();
        }
    }

    /**
     * Write column.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \PhpOffice\PhpWord\Element\Table $element
     * @return void
     */
    private function writeColumns(XMLWriter $xmlWriter, TableElement $element)
    {
        $rows = $element->getRows();
        $rowCount = count($rows);

        $cellWidths = array();
        for ($i = 0; $i < $rowCount; $i++) {
            $row = $rows[$i];
            $cells = $row->getCells();
            if (count($cells) <= count($cellWidths)) {
                continue;
            }
            $cellWidths = array();
            foreach ($cells as $cell) {
                $cellWidths[] = $cell->getWidth();
            }
        }

        $xmlWriter->startElement('w:tblGrid');
        foreach ($cellWidths as $width) {
            $xmlWriter->startElement('w:gridCol');
            if ($width !== null) {
                $xmlWriter->writeAttribute('w:w', $width);
                $xmlWriter->writeAttribute('w:type', 'dxa');
            }
            $xmlWriter->endElement();
        }
        $xmlWriter->endElement();
    }

    /**
     * Write row.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \PhpOffice\PhpWord\Element\Row $row
     * @return void
     */
    private function writeRow(XMLWriter $xmlWriter, RowElement $row)
    {
        $xmlWriter->startElement('w:tr');


        $rowStyle = $row->getStyle();
        if ($rowStyle instanceof RowStyle) {
            $styleWriter = new RowStyleWriter($xmlWriter, $rowStyle);
            $styleWriter->setHeight($row->getHeight());
            $styleWriter->write();
        }


        foreach ($row->getCells() as $cell) {
            $this->writeCell($xmlWriter, $cell);
        }

        $xmlWriter->endElement();
    }

    /**
     * Write cell.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param \PhpOffice\PhpWord\Element\Cell $cell
     * @return void
     */
    private function writeCell(XMLWriter $xmlWriter, CellElement $cell)
    {

        $xmlWriter->startElement('w:tc');


        $cellStyle = $cell->getStyle();
        if ($cellStyle instanceof CellStyle) {
            $styleWriter = new CellStyleWriter($xmlWriter, $cellStyle);
            $styleWriter->setWidth($cell->getWidth());
            $styleWriter->write();
        }


        $containerWriter = new Container($xmlWriter, $cell);
        $containerWriter->write();

        $xmlWriter->endElement();
    }
}
