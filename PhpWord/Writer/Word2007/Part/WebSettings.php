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
 * Word2007 web settings part writer: word/webSettings.xml
 */
class WebSettings extends Settings
{
    /**
     * Write part
     *
     * @return string
     */
    public function write()
    {
        $settings = array(
            'w:optimizeForBrowser' => '',
        );

        $xmlWriter = $this->getXmlWriter();

        $xmlWriter->startDocument('1.0', 'UTF-8', 'yes');
        $xmlWriter->startElement('w:webSettings');
        $xmlWriter->writeAttribute('xmlns:r', 'http:
        $xmlWriter->writeAttribute('xmlns:w', 'http:

        foreach ($settings as $settingKey => $settingValue) {
            $this->writeSetting($xmlWriter, $settingKey, $settingValue);
        }

        $xmlWriter->endElement(); 

        return $xmlWriter->getData();
    }
}
