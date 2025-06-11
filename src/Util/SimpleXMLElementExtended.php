<?php

declare(strict_types=1);

namespace BigBlueButton\Util;

class SimpleXMLElementExtended extends \SimpleXMLElement
{
    /**
     * Adds a child with $value inside CDATA.
     *
     * @param string $name  the name of the child element
     * @param string $value the value to be wrapped in CDATA
     */
    public function addChildWithCData(string $name, string $value): self
    {
        $child = parent::addChild($name);
        $element = dom_import_simplexml($child);
        $docOwner = $element->ownerDocument;
        $element->appendChild($docOwner->createCDATASection($value));

        return $child;
    }
}
