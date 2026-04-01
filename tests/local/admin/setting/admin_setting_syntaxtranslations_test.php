<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Tests for the admin_setting_syntaxtranslations class.
 *
 * @package   block_mathsyntaxhelp
 * @copyright 2026 Niels Gandraß <niels@gandrass.de>
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_mathsyntaxhelp\local\admin\setting;


/**
 * Tests for the admin_setting_syntaxtranslations class.
 */
final class admin_setting_syntaxtranslations_test extends \advanced_testcase {
    /**
     * Tests rendering of the HTML output for the setting.
     *
     * @covers \block_mathsyntaxhelp\local\admin\setting\admin_setting_syntaxtranslations
     *
     * @return void
     * @throws \core\exception\moodle_exception
     */
    public function test_output_html(): void {
        $this->resetAfterTest();

        // Create a setting instance with default entries.
        $defaultentries = [
            ['out' => 'foo', 'in' => 'bar'],
            ['out' => '\( x^2 \)', 'in' => 'x^2'],
            ['out' => '\[ \frac{a}{b} \]', 'in' => 'a/b'],
        ];
        $setting = new admin_setting_syntaxtranslations(
            'block_mathsyntaxhelp/testsetting',
            'Test Setting',
            'Test Description',
            json_encode($defaultentries)
        );

        // Generate the HTML output.
        $html = $setting->output_html(json_encode($defaultentries));

        // Check that the output contains the expected entries.
        foreach ($defaultentries as $entry) {
            $this->assertStringContainsString(htmlspecialchars($entry['out']), $html, 'Output entry should be present in HTML.');
            $this->assertStringContainsString(htmlspecialchars($entry['in']), $html, 'Input entry should be present in HTML.');
        }
    }

    /**
     * Tests reading and writing the settings value.
     *
     * @covers \block_mathsyntaxhelp\local\admin\setting\admin_setting_syntaxtranslations
     *
     * @return void
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function test_setting_read_write(): void {
        $this->resetAfterTest();

        // Create a setting instance with default entries.
        $defaultentries = [
            ['out' => 'foo', 'in' => 'bar'],
            ['out' => '\( x^2 \)', 'in' => 'x^2'],
            ['out' => '\[ \frac{a}{b} \]', 'in' => 'a/b'],
        ];
        $setting = new admin_setting_syntaxtranslations(
            'block_mathsyntaxhelp/testsetting',
            'Test Setting',
            'Test Description',
            json_encode($defaultentries)
        );
        set_config($setting->name, json_encode($defaultentries), 'block_mathsyntaxhelp');

        // Try to read the default setting.
        $storedvalue = $setting->get_setting();
        $this->assertEquals(json_encode($defaultentries), $storedvalue, 'Stored setting should match the default entries.');

        // Write a new setting.
        $newentries = [
            ['out' => '\( E = mc^2 \)', 'in' => 'E = mc^2'],
        ];
        $setting->write_setting($newentries);
        $storedvalue = $setting->get_setting();
        $this->assertEquals(json_encode($newentries), $storedvalue, 'Stored setting should match the new entries.');
        $directreadvalue = get_config('block_mathsyntaxhelp', 'testsetting');
        $this->assertEquals(json_encode($newentries), $directreadvalue, 'Directly read config should match the new entries.');
    }

    /**
     * Tests writing an invalid setting value.
     *
     * @covers \block_mathsyntaxhelp\local\admin\setting\admin_setting_syntaxtranslations
     *
     * @return void
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function test_writing_invalid_setting(): void {
        $this->resetAfterTest();

        // Create a setting instance with default entries.
        $setting = new admin_setting_syntaxtranslations(
            'block_mathsyntaxhelp/testsetting',
            'Test Setting',
            'Test Description',
            json_encode([])
        );

        $entries = [
            ['out' => 'foo', 'in' => 'bar'],
            ['out' => 'lorem', 'in' => 'ipsum'],
        ];
        set_config($setting->name, json_encode($entries), 'block_mathsyntaxhelp');

        // Try to write invalid data.
        $setting->write_setting('foo bar baz');
        $this->assertEmpty(get_config('block_mathsyntaxhelp', 'testsetting'), 'Invalid settings should default to empty string.');
    }
}
