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

namespace PhpOffice\PhpWord\Element;

/**
 * Container abstract class
 *
 * @method Text addText(string $text, mixed $fStyle = null, mixed $pStyle = null)
 * @method TextRun addTextRun(mixed $pStyle = null)
 * @method Bookmark addBookmark(string $name)
 * @method Link addLink(string $target, string $text = null, mixed $fStyle = null, mixed $pStyle = null)
 * @method PreserveText addPreserveText(string $text, mixed $fStyle = null, mixed $pStyle = null)
 * @method void addTextBreak(int $count = 1, mixed $fStyle = null, mixed $pStyle = null)
 * @method ListItem addListItem(string $txt, int $depth = 0, mixed $font = null, mixed $list = null, mixed $para = null)
 * @method ListItemRun addListItemRun(int $depth = 0, mixed $listStyle = null, mixed $pStyle = null)
 * @method Footnote addFootnote(mixed $pStyle = null)
 * @method Endnote addEndnote(mixed $pStyle = null)
 * @method CheckBox addCheckBox(string $name, $text, mixed $fStyle = null, mixed $pStyle = null)
 * @method Title addTitle(string $text, int $depth = 1)
 * @method TOC addTOC(mixed $fontStyle = null, mixed $tocStyle = null, int $minDepth = 1, int $maxDepth = 9)
 *
 * @method PageBreak addPageBreak()
 * @method Table addTable(mixed $style = null)
 * @method Image addImage(string $source, mixed $style = null, bool $isWatermark = false)
 * @method Object addObject(string $source, mixed $style = null)
 * @method TextBox addTextBox(mixed $style = null)
 * @method Field addField(string $type = null, array $properties = array(), array $options = array())
 * @method Line addLine(mixed $lineStyle = null)
 * @method Shape addShape(string $type, mixed $style = null)
 * @method Chart addChart(string $type, array $categories, array $values, array $style = null)
 * @method FormField addFormField(string $type, mixed $fStyle = null, mixed $pStyle = null)
 * @method SDT addSDT(string $type)
 *
 * @since 0.10.0
 */
abstract class AbstractContainer extends AbstractElement
{
    /**
     * Elements collection
     *
     * @var array
     */
    protected $elements = array();

    /**
     * Container type Section|Header|Footer|Footnote|Endnote|Cell|TextRun|TextBox|ListItemRun
     *
     * @var string
     */
    protected $container;

    /**
     * Magic method to catch all 'addElement' variation
     *
     * This removes addText, addTextRun, etc. When adding new element, we have to
     * add the model in the class docblock with `@method`.
     *
     * Warning: This makes capitalization matters, e.g. addCheckbox or addcheckbox won't work.
     *
     * @param mixed $function
     * @param mixed $args
     * @return \PhpOffice\PhpWord\Element\AbstractElement
     */
    public function __call($function, $args)
    {
        $elements = array(
            'Text', 'TextRun', 'Bookmark', 'Link', 'PreserveText', 'TextBreak',
            'ListItem', 'ListItemRun', 'Table', 'Image', 'Object',
            'Footnote', 'Endnote', 'CheckBox', 'TextBox', 'Field',
            'Line', 'Shape', 'Title', 'TOC', 'PageBreak',
            'Chart', 'FormField', 'SDT'
        );
        $functions = array();
        foreach ($elements as $element) {
            $functions['add' . strtolower($element)] = $element;
        }


        $function = strtolower($function);
        if (isset($functions[$function])) {
            $element = $functions[$function];



            if ($element == 'TextBreak') {
                @list($count, $fontStyle, $paragraphStyle) = $args;
                if ($count === null) {
                    $count = 1;
                }
                for ($i = 1; $i <= $count; $i++) {
                    $this->addElement($element, $fontStyle, $paragraphStyle);
                }
            } else {
                array_unshift($args, $element);
                return call_user_func_array(array($this, 'addElement'), $args);
            }
        }

        return null;
    }

    /**
     * Add element
     *
     * Each element has different number of parameters passed
     *
     * @param string $elementName
     * @return \PhpOffice\PhpWord\Element\AbstractElement
     */
    protected function addElement($elementName)
    {
        $elementClass = __NAMESPACE__ . '\\' . $elementName;
        $this->checkValidity($elementName);


        $args = func_get_args();
        $withoutP = in_array($this->container, array('TextRun', 'Footnote', 'Endnote', 'ListItemRun', 'Field'));
        if ($withoutP && ($elementName == 'Text' || $elementName == 'PreserveText')) {
            $args[3] = null;
        }


        $reflection = new \ReflectionClass($elementClass);
        $elementArgs = $args;
        array_shift($elementArgs);

        /** @var \PhpOffice\PhpWord\Element\AbstractElement $element Type hint */
        $element = $reflection->newInstanceArgs($elementArgs);


        $element->setParentContainer($this);
        $element->setElementIndex($this->countElements() + 1);
        $element->setElementId();

        $this->elements[] = $element;

        return $element;
    }

    /**
     * Get all elements
     *
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Count elements
     *
     * @return int
     */
    public function countElements()
    {
        return count($this->elements);
    }

    /**
     * Check if a method is allowed for the current container
     *
     * @param string $method
     * @return bool
     * @throws \BadMethodCallException
     */
    private function checkValidity($method)
    {
        $generalContainers = array(
            'Section', 'Header', 'Footer', 'Footnote', 'Endnote', 'Cell', 'TextRun', 'TextBox', 'ListItemRun',
        );

        $validContainers = array(
            'Text'          => $generalContainers,
            'Bookmark'      => $generalContainers,
            'Link'          => $generalContainers,
            'TextBreak'     => $generalContainers,
            'Image'         => $generalContainers,
            'Object'        => $generalContainers,
            'Field'         => $generalContainers,
            'Line'          => $generalContainers,
            'Shape'         => $generalContainers,
            'FormField'     => $generalContainers,
            'SDT'           => $generalContainers,
            'TextRun'       => array('Section', 'Header', 'Footer', 'Cell', 'TextBox'),
            'ListItem'      => array('Section', 'Header', 'Footer', 'Cell', 'TextBox'),
            'ListItemRun'   => array('Section', 'Header', 'Footer', 'Cell', 'TextBox'),
            'Table'         => array('Section', 'Header', 'Footer', 'Cell', 'TextBox'),
            'CheckBox'      => array('Section', 'Header', 'Footer', 'Cell'),
            'TextBox'       => array('Section', 'Header', 'Footer', 'Cell'),
            'Footnote'      => array('Section', 'TextRun', 'Cell'),
            'Endnote'       => array('Section', 'TextRun', 'Cell'),
            'PreserveText'  => array('Header', 'Footer', 'Cell'),
            'Title'         => array('Section'),
            'TOC'           => array('Section'),
            'PageBreak'     => array('Section'),
            'Chart'         => array('Section'),
        );



        $validSubcontainers = array(
            'PreserveText'  => array(array('Cell'), array('Header', 'Footer')),
            'Footnote'      => array(array('Cell', 'TextRun'), array('Section')),
            'Endnote'       => array(array('Cell', 'TextRun'), array('Section')),
        );


        if (isset($validContainers[$method])) {
            if (!in_array($this->container, $validContainers[$method])) {
                throw new \BadMethodCallException("Cannot add {$method} in {$this->container}.");
            }
        }


        if (isset($validSubcontainers[$method])) {
            $rules = $validSubcontainers[$method];
            $containers = $rules[0];
            $allowedDocParts = $rules[1];
            foreach ($containers as $container) {
                if ($this->container == $container && !in_array($this->getDocPart(), $allowedDocParts)) {
                    throw new \BadMethodCallException("Cannot add {$method} in {$this->container}.");
                }
            }
        }

        return true;
    }

    /**
     * Add memory image element
     *
     * @param string $src
     * @param mixed $style
     * @return \PhpOffice\PhpWord\Element\Image
     * @deprecated 0.9.0
     * @codeCoverageIgnore
     */
    public function addMemoryImage($src, $style = null)
    {
        return $this->addImage($src, $style);
    }

    /**
     * Create textrun element
     *
     * @param mixed $paragraphStyle
     * @return \PhpOffice\PhpWord\Element\TextRun
     * @deprecated 0.10.0
     * @codeCoverageIgnore
     */
    public function createTextRun($paragraphStyle = null)
    {
        return $this->addTextRun($paragraphStyle);
    }

    /**
     * Create footnote element
     *
     * @param mixed $paragraphStyle
     * @return \PhpOffice\PhpWord\Element\Footnote
     * @deprecated 0.10.0
     * @codeCoverageIgnore
     */
    public function createFootnote($paragraphStyle = null)
    {
        return $this->addFootnote($paragraphStyle);
    }
}
