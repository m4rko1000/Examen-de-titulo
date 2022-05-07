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

use PhpOffice\PhpWord\Element\Chart as ChartElement;
use PhpOffice\PhpWord\Shared\XMLWriter;

/**
 * Word2007 chart part writer: word/charts/chartx.xml
 *
 * @since 0.12.0
 * @link http:
 */
class Chart extends AbstractPart
{
    /**
     * Chart element
     *
     * @var \PhpOffice\PhpWord\Element\Chart $element
     */
    private $element;

    /**
     * Type definition
     *
     * @var array
     */
    private $types = array(
        'pie'       => array('type' => 'pie', 'colors' => 1),
        'doughnut'  => array('type' => 'doughnut', 'colors' => 1, 'hole' => 75, 'no3d' => true),
        'bar'       => array('type' => 'bar', 'colors' => 0, 'axes' => true, 'bar' => 'bar'),
        'column'    => array('type' => 'bar', 'colors' => 0, 'axes' => true, 'bar' => 'col'),
        'line'      => array('type' => 'line', 'colors' => 0, 'axes' => true),
        'area'      => array('type' => 'area', 'colors' => 0, 'axes' => true),
        'radar'     => array('type' => 'radar', 'colors' => 0, 'axes' => true, 'radar' => 'standard', 'no3d' => true),
        'scatter'   => array('type' => 'scatter', 'colors' => 0, 'axes' => true, 'scatter' => 'marker', 'no3d' => true),
    );

    /**
     * Chart options
     *
     * @var array
     */
    private $options = array();

    /**
     * Set chart element.
     *
     * @param \PhpOffice\PhpWord\Element\Chart $element
     * @return void
     */
    public function setElement(ChartElement $element)
    {
        $this->element = $element;
    }

    /**
     * Write part
     *
     * @return string
     */
    public function write()
    {
        $xmlWriter = $this->getXmlWriter();

        $xmlWriter->startDocument('1.0', 'UTF-8', 'yes');
        $xmlWriter->startElement('c:chartSpace');
        $xmlWriter->writeAttribute('xmlns:c', 'http:
        $xmlWriter->writeAttribute('xmlns:a', 'http:
        $xmlWriter->writeAttribute('xmlns:r', 'http:

        $this->writeChart($xmlWriter);
        $this->writeShape($xmlWriter);

        $xmlWriter->endElement(); 

        return $xmlWriter->getData();
    }

    /**
     * Write chart
     *
     * @link http:
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @return void
     */
    private function writeChart(XMLWriter $xmlWriter)
    {
        $xmlWriter->startElement('c:chart');

        $xmlWriter->writeElementBlock('c:autoTitleDeleted', 'val', 1);

        $this->writePlotArea($xmlWriter);

        $xmlWriter->endElement(); 
    }

    /**
     * Write plot area.
     *
     * @link http:
     * @link http:
     * @link http:
     * @link http:
     * @link http:
     * @link http:
     * @link http:
     * @link http:
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @return void
     */
    private function writePlotArea(XMLWriter $xmlWriter)
    {
        $type = $this->element->getType();
        $style = $this->element->getStyle();
        $this->options = $this->types[$type];

        $xmlWriter->startElement('c:plotArea');
        $xmlWriter->writeElement('c:layout');

        
        $chartType = $this->options['type'];
        $chartType .= $style->is3d() && !isset($this->options['no3d'])? '3D' : '';
        $chartType .= 'Chart';
        $xmlWriter->startElement("c:{$chartType}");

        $xmlWriter->writeElementBlock('c:varyColors', 'val', $this->options['colors']);
        if ($type == 'area') {
            $xmlWriter->writeElementBlock('c:grouping', 'val', 'standard');
        }
        if (isset($this->options['hole'])) {
            $xmlWriter->writeElementBlock('c:holeSize', 'val', $this->options['hole']);
        }
        if (isset($this->options['bar'])) {
            $xmlWriter->writeElementBlock('c:barDir', 'val', $this->options['bar']); 
            $xmlWriter->writeElementBlock('c:grouping', 'val', 'clustered'); 
        }
        if (isset($this->options['radar'])) {
            $xmlWriter->writeElementBlock('c:radarStyle', 'val', $this->options['radar']);
        }
        if (isset($this->options['scatter'])) {
            $xmlWriter->writeElementBlock('c:scatterStyle', 'val', $this->options['scatter']);
        }

        
        $this->writeSeries($xmlWriter, isset($this->options['scatter']));

        
        if (isset($this->options['axes'])) {
            $xmlWriter->writeElementBlock('c:axId', 'val', 1);
            $xmlWriter->writeElementBlock('c:axId', 'val', 2);
        }

        $xmlWriter->endElement(); 

        
        if (isset($this->options['axes'])) {
            $this->writeAxis($xmlWriter, 'cat');
            $this->writeAxis($xmlWriter, 'val');
        }

        $xmlWriter->endElement(); 
    }

    /**
     * Write series.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param bool $scatter
     * @return void
     */
    private function writeSeries(XMLWriter $xmlWriter, $scatter = false)
    {
        $series = $this->element->getSeries();

        $index = 0;
        foreach ($series as $seriesItem) {
            $categories = $seriesItem['categories'];
            $values = $seriesItem['values'];

            $xmlWriter->startElement('c:ser');

            $xmlWriter->writeElementBlock('c:idx', 'val', $index);
            $xmlWriter->writeElementBlock('c:order', 'val', $index);

            if (isset($this->options['scatter'])) {
                $this->writeShape($xmlWriter);
            }

            if ($scatter === true) {
                $this->writeSeriesItem($xmlWriter, 'xVal', $categories);
                $this->writeSeriesItem($xmlWriter, 'yVal', $values);
            } else {
                $this->writeSeriesItem($xmlWriter, 'cat', $categories);
                $this->writeSeriesItem($xmlWriter, 'val', $values);
            }

            $xmlWriter->endElement(); 
            $index++;
        }

    }

    /**
     * Write series items.
     *
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param string $type
     * @param array $values
     * @return void
     */
    private function writeSeriesItem(XMLWriter $xmlWriter, $type, $values)
    {
        $types = array(
            'cat' => array('c:cat', 'c:strLit'),
            'val' => array('c:val', 'c:numLit'),
            'xVal' => array('c:xVal', 'c:strLit'),
            'yVal' => array('c:yVal', 'c:numLit'),
        );
        list($itemType, $itemLit) = $types[$type];

        $xmlWriter->startElement($itemType);
        $xmlWriter->startElement($itemLit);

        $index = 0;
        foreach ($values as $value) {
            $xmlWriter->startElement('c:pt');
            $xmlWriter->writeAttribute('idx', $index);

            $xmlWriter->startElement('c:v');
            $xmlWriter->writeRaw($value);
            $xmlWriter->endElement(); 

            $xmlWriter->endElement(); 
            $index++;
        }

        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
    }

    /**
     * Write axis
     *
     * @link http:
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param string $type
     * @return void
     */
    private function writeAxis(XMLWriter $xmlWriter, $type)
    {
        $types = array(
            'cat' => array('c:catAx', 1, 'b', 2),
            'val' => array('c:valAx', 2, 'l', 1),
        );
        list($axisType, $axisId, $axisPos, $axisCross) = $types[$type];

        $xmlWriter->startElement($axisType);

        $xmlWriter->writeElementBlock('c:axId', 'val', $axisId);
        $xmlWriter->writeElementBlock('c:axPos', 'val', $axisPos);
        $xmlWriter->writeElementBlock('c:crossAx', 'val', $axisCross);
        $xmlWriter->writeElementBlock('c:auto', 'val', 1);

        if (isset($this->options['axes'])) {
            $xmlWriter->writeElementBlock('c:delete', 'val', 0);
            $xmlWriter->writeElementBlock('c:majorTickMark', 'val', 'none');
            $xmlWriter->writeElementBlock('c:minorTickMark', 'val', 'none');
            $xmlWriter->writeElementBlock('c:tickLblPos', 'val', 'none'); 
            $xmlWriter->writeElementBlock('c:crosses', 'val', 'autoZero');
        }
        if (isset($this->options['radar'])) {
            $xmlWriter->writeElement('c:majorGridlines');
        }

        $xmlWriter->startElement('c:scaling');
        $xmlWriter->writeElementBlock('c:orientation', 'val', 'minMax');
        $xmlWriter->endElement(); 

        $this->writeShape($xmlWriter, true);

        $xmlWriter->endElement(); 
    }

    /**
     * Write shape
     *
     * @link http:
     * @param \PhpOffice\PhpWord\Shared\XMLWriter $xmlWriter
     * @param bool $line
     * @return void
     */
    private function writeShape(XMLWriter $xmlWriter, $line = false)
    {
        $xmlWriter->startElement('c:spPr');
        $xmlWriter->startElement('a:ln');
        if ($line === true) {
            $xmlWriter->writeElement('a:solidFill');
        } else {
            $xmlWriter->writeElement('a:noFill');
        }
        $xmlWriter->endElement(); 
        $xmlWriter->endElement(); 
    }
}
