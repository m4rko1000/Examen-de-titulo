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

namespace PhpOffice\PhpWord\Writer\PDF;

use PhpOffice\PhpWord\Writer\WriterInterface;

/**
 * TCPDF writer
 *
 * @link http:
 * @since 0.11.0
 */
class TCPDF extends AbstractRenderer implements WriterInterface
{
    /**
     * Name of renderer include file
     *
     * @var string
     */
    protected $includeFile = 'tcpdf.php';

    /**
     * Save PhpWord to file.
     *
     * @param string $filename Name of the file to save as
     * @return vois
     */
    public function save($filename = null)
    {
        $fileHandle = parent::prepareForSave($filename);


        $paperSize = 'A4';
        $orientation = 'P';


        $pdf = new \TCPDF($orientation, 'pt', $paperSize);
        $pdf->setFontSubsetting(false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->addPage();
        $pdf->setFont($this->getFont());
        $pdf->writeHTML($this->getContent());


        $phpWord = $this->getPhpWord();
        $docProps = $phpWord->getDocInfo();
        $pdf->setTitle($docProps->getTitle());
        $pdf->setAuthor($docProps->getCreator());
        $pdf->setSubject($docProps->getSubject());
        $pdf->setKeywords($docProps->getKeywords());
        $pdf->setCreator($docProps->getCreator());


        fwrite($fileHandle, $pdf->output($filename, 'S'));

        parent::restoreStateAfterSave($fileHandle);
    }
}
