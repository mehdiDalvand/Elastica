<?php

namespace Elastica\Test\Filter;

use Elastica\Filter\Range;
use Elastica\Test\Base as BaseTest;

class RangeTest extends BaseTest
{
    public function testAddField()
    {
        $rangeFilter = new Range();
        $returnValue = $rangeFilter->addField('fieldName', array('to' => 'value'));
        $this->assertInstanceOf('Elastica\Filter\Range', $returnValue);
    }

    public function testToArray()
    {
        $field = 'field_name';
        $range = array('gte' => 10, 'lte' => 99);

        $filter = new Range();
        $filter->addField($field, $range);
        $expectedArray = array('range' => array($field => $range));
        $this->assertEquals($expectedArray, $filter->toArray());
    }

    public function testSetExecution()
    {
        $field = 'field_name';
        $range = array('gte' => 10, 'lte' => 99);
        $filter = new Range('field_name', $range);

        $filter->setExecution('fielddata');
        $this->assertEquals('fielddata', $filter->getParam('execution'));

        $returnValue = $filter->setExecution('index');
        $this->assertInstanceOf('Elastica\Filter\Range', $returnValue);
    }
}
