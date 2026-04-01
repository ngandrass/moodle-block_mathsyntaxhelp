<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Tests for block class
 *
 * @package   block_mathsyntaxhelp
 * @copyright 2026 Niels Gandraß <niels@gandrass.de>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_mathsyntaxhelp;

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/blocks/moodleblock.class.php');
require_once($CFG->dirroot . '/blocks/mathsyntaxhelp/block_mathsyntaxhelp.php');

/**
 * Tests for the block class
 */
final class block_mathsyntaxhelp_test extends \advanced_testcase {
    /**
     * Tests block initialization
     *
     * @covers \block_mathsyntaxhelp
     *
     * @return void
     * @throws \coding_exception
     */
    public function test_init(): void {
        $block = new \block_mathsyntaxhelp();
        $block->init();

        $this->assertEquals(get_string('pluginname', 'block_mathsyntaxhelp'), $block->title, 'Block title should be set');
        $this->assertEquals(['all' => true], $block->applicable_formats(), 'Block should be applicable everywhere.');
        $this->assertTrue($block->has_config(), 'Block should indicate instance config presence.');
        $this->assertTrue($block->instance_allow_multiple(), 'Block should allow multiple instances.');
    }

    /**
     * Tests block content generation with default entries
     *
     * @covers \block_mathsyntaxhelp
     *
     * @return void
     * @throws \coding_exception
     * @throws \core\exception\moodle_exception
     */
    public function test_default_block_contents(): void {
        // Prepare a block with default contents.
        $this->resetAfterTest();
        $entries = [
            ['out' => '\( 42 * pi \)', 'in' => '42 * pi'],
            ['out' => '\( \sqrt(1337) \)', 'in' => 'sqrt(1337)'],
        ];
        set_config('defaultcontent', json_encode($entries), 'block_mathsyntaxhelp');

        $block = new \block_mathsyntaxhelp();
        $block->init();

        // Simulate the get_content method call.
        $content = $block->get_content();

        // Check that the content is not null and has expected properties.
        $this->assertNotNull($content, 'Block content should not be null.');
        $this->assertIsString($content->text, 'Block content text should be a string.');
        $this->assertIsString($content->footer, 'Block content footer should be a string.');

        // Try to find the default entries in the content text.
        foreach ($entries as $entry) {
            $this->assertStringContainsString(
                $entry['in'],
                $content->text,
                'Block content should contain the default input syntax.'
            );
        }
    }

    /**
     * Tests the block content generation with custom entries
     *
     * @covers \block_mathsyntaxhelp
     *
     * @return void
     * @throws \coding_exception
     * @throws \core\exception\moodle_exception
     */
    public function test_custom_block_contents(): void {
        // Prepare  contents.
        $this->resetAfterTest();
        $defaultentries = [
            ['out' => '\( 42 * pi \)', 'in' => '42 * pi'],
            ['out' => '\( \sqrt(1337) \)', 'in' => 'sqrt(1337)'],
        ];
        set_config('defaultcontent', json_encode($defaultentries), 'block_mathsyntaxhelp');

        $customentries = [
            ['out' => '\( foo \)', 'in' => 'bar'],
            ['out' => '\( E = mc^2 \)', 'in' => 'E = mc^2'],
        ];

        $block = new \block_mathsyntaxhelp();
        $block->init();
        $block->config = (object) [
            'usecustomentries' => 1,
            'customentries' => json_encode($customentries),
        ];

        // Simulate the get_content method call.
        $content = $block->get_content();

        // Check that the content is not null and has expected properties.
        $this->assertNotNull($content, 'Block content should not be null.');
        $this->assertIsString($content->text, 'Block content text should be a string.');
        $this->assertIsString($content->footer, 'Block content footer should be a string.');

        // Try to find the custom entries in the content text.
        foreach ($customentries as $entry) {
            $this->assertStringContainsString(
                $entry['in'],
                $content->text,
                'Block content should contain the custom input syntax.'
            );
        }

        // Ensure that the default entries are not present.
        foreach ($defaultentries as $entry) {
            $this->assertStringNotContainsString(
                $entry['in'],
                $content->text,
                'Block content should not contain the default input syntax when custom entries are used.'
            );
        }
    }
}
