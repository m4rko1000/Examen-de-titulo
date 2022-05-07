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

namespace PhpOffice\PhpWord\Writer\RTF\Part;

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Writer\RTF\Element\Container;
use PhpOffice\PhpWord\Writer\RTF\Style\Section as SectionStyleWriter;

/**
 * RTF document part writer
 *
 * @since 0.11.0
 * @link http:
 */
class Document extends AbstractPart
{
    /**
     * Write part
     *
     * @return string
     */
    public function write()
    {
        $content = '';

        $content .= $this->writeInfo();
        $content .= $this->writeFormatting();
        $content .= $this->writeSections();

        return $content;
    }

    /**
     * Write document information
     *
     * @return string
     */
    private function writeInfo()
    {
        $docProps = $this->getParentWriter()->getPhpWord()->getDocInfo();
        $properties = array(
            'title', 'subject', 'category', 'keywords', 'comment',
            'author', 'operator', 'creatim', 'revtim', 'company', 'manager'
        );
        $mapping = array(
            'comment' => 'description', 'author' => 'creator', 'operator' => 'lastModifiedBy',
            'creatim' => 'created', 'revtim' => 'modified'
        );
        $dateFields = array('creatim', 'revtim');

        $content = '';

        $content .= '{';
        $content .= '\info';
        foreach ($properties as $property) {
            $method = 'get' . (isset($mapping[$property]) ? $mapping[$property] : $property);
            $value = $docProps->$method();
            $value = in_array($property, $dateFields) ? $this->getDateValue($value) : $value;
            $content .= "{\\{$property} {$value}}";
        }
        $content .= '}';
        $content .= PHP_EOL;

        return $content;
    }

    /**
     * Write document formatting properties
     *
     * @return string
     */
    private function writeFormatting()
    {
        $content = '';

        $content .= '\deftab720';
        $content .= '\viewkind1';

        $content .= '\uc1';
        $content .= '\pard';
        $content .= '\nowidctlpar';
        $content .= '\lang1036';
        $content .= '\kerning1';
        $content .= '\fs' . (Settings::getDefaultFontSize() * 2);
        $content .= PHP_EOL;

        return $content;
    }

    /**
     * Write sections
     *
     * @return string
     */
    private function writeSections()
    {

        $content = '';

        $sections = $this->getParentWriter()->getPhpWord()->getSections();
        foreach ($sections as $section) {
            $styleWriter = new SectionStyleWriter($section->getStyle());
            $styleWriter->setParentWriter($this->getParentWriter());
            $content .= $styleWriter->write();

            $elementWriter = new Container($this->getParentWriter(), $section);
            $content .= $elementWriter->write();

            $content .= '\sect' . PHP_EOL;
        }

        return $content;
    }

    /**
     * Get date value
     *
     * The format of date value is `\yr?\mo?\dy?\hr?\min?\sec?`
     *
     * @param int $value
     * @return string
     */
    private function getDateValue($value)
    {
        $dateParts = array(
            'Y' => 'yr',
            'm' => 'mo',
            'd' => 'dy',
            'H' => 'hr',
            'i' => 'min',
            's' => 'sec',
        );
        $result = '';
        foreach ($dateParts as $dateFormat => $controlWord) {
            $result .= '\\' . $controlWord . date($dateFormat, $value);
        }

        return $result;
    }
}
