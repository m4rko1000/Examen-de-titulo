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

namespace PhpOffice\PhpWord\Writer;

use PhpOffice\PhpWord\Media;
use PhpOffice\PhpWord\PhpWord;

/**
 * ODText writer
 *
 * @since 0.7.0
 */
class ODText extends AbstractWriter implements WriterInterface
{
    /**
     * Create new ODText writer
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     */
    public function __construct(PhpWord $phpWord = null)
    {

        $this->setPhpWord($phpWord);


        $this->parts = array(
            'Mimetype'  => 'mimetype',
            'Content'   => 'content.xml',
            'Meta'      => 'meta.xml',
            'Styles'    => 'styles.xml',
            'Manifest'  => 'META-INF/manifest.xml',
        );
        foreach (array_keys($this->parts) as $partName) {
            $partClass = get_class($this) . '\\Part\\' . $partName;
            if (class_exists($partClass)) {
                /** @var $partObject \PhpOffice\PhpWord\Writer\ODText\Part\AbstractPart Type hint */
                $partObject = new $partClass();
                $partObject->setParentWriter($this);
                $this->writerParts[strtolower($partName)] = $partObject;
            }
        }


        $this->mediaPaths = array('image' => 'Pictures/');
    }

    /**
     * Save PhpWord to file.
     *
     * @param string $filename
     * @return void
     */
    public function save($filename = null)
    {
        $filename = $this->getTempFile($filename);
        $zip = $this->getZipArchive($filename);


        $sectionMedia = Media::getElements('section');
        if (!empty($sectionMedia)) {
            $this->addFilesToPackage($zip, $sectionMedia);
        }


        foreach ($this->parts as $partName => $fileName) {
            if ($fileName != '') {
                $zip->addFromString($fileName, $this->getWriterPart($partName)->write());
            }
        }


        $zip->close();
        $this->cleanupTempFile();
    }
}
