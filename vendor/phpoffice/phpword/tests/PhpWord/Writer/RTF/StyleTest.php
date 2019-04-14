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
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2016 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer\RTF;

/**
 * Test class for PhpOffice\PhpWord\Writer\RTF\Style subnamespace
 */
class StyleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test empty styles
     */
    public function testEmptyStyles()
    {
        $styles = ['Font', 'Paragraph', 'Section'];
        foreach ($styles as $style) {
            $objectClass = 'PhpOffice\\PhpWord\\Writer\\RTF\\Style\\' . $style;
            $object = new $objectClass();

            $this->assertEquals('', $object->write());
        }
    }
}
