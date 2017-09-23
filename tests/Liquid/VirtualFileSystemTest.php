<?php

/**
 * This file is part of the Liquid package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Liquid
 */

namespace Liquid;

use Liquid\FileSystem\Virtual;

class VirtualFileSystemTest extends TestCase
{
	/**
	 * @expectedException \Liquid\LiquidException
	 * @expectedExceptionMessage Not a callback
	 */
	public function testInvalidCallback() {
		new Virtual('');
	}

	public function testFeadTemplateFile() {
		$fs = new Virtual(function ($templatePath) {
			if ($templatePath == 'foo') {
				return "Contents of foo";
			}

			if ($templatePath == 'bar') {
				return "Bar";
			}

			return '';
		});

		$this->assertEquals('Contents of foo', $fs->readTemplateFile('foo'));
		$this->assertEquals('Bar', $fs->readTemplateFile('bar'));
		$this->assertEquals('', $fs->readTemplateFile('nothing'));
	}
}