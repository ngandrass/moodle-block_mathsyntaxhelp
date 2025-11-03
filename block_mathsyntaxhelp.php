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
 * Block definition class for the block_mathsyntaxhelp plugin.
 *
 * @package   block_mathsyntaxhelp
 * @copyright 2025 Niels Gandraß <niels@gandrass.de>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// phpcs:ignore
defined('MOODLE_INTERNAL') || die(); // @codeCoverageIgnore

/**
 * Block definition class for the block_mathsyntaxhelp plugin.
 */
class block_mathsyntaxhelp extends block_base {
    /**
     * Block initialization hook.
     *
     * @return void
     * @throws coding_exception
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_mathsyntaxhelp');
    }

    /**
     * Defines in which pages this block can be added.
     *
     * @return array of the pages where the block can be added.
     */
    public function applicable_formats() {
        return [
            'all' => true,
        ];
    }

    /**
     * Subclasses should override this and return true if the
     * subclass block has a settings.php file.
     *
     * @return boolean
     */
    public function has_config() {
        return true;
    }

    /**
     * Are you going to allow multiple instances of each block?
     * If yes, then it is assumed that the block WILL USE per-instance configuration
     *
     * @return boolean
     */
    public function instance_allow_multiple() {
        return true;
    }

    /**
     * Gets the block contents.
     *
     * @return \stdClass The block HTML.
     * @throws \core\exception\moodle_exception
     */
    public function get_content() {
        global $OUTPUT;

        // Check if content is already set.
        if ($this->content !== null) {
            return $this->content;
        }

        // Build template context.
        $formulahelpdata = [];
        foreach ($this->get_entries() as $entry) {
            $formulahelpdata[] = [
                'mathjax' => format_text($entry->out),
                'syntax' => format_text($entry->in),
            ];
        }

        // Render content.
        $this->content = (object) [
            'text' => $OUTPUT->render_from_template(
                'block_mathsyntaxhelp/block',
                ["content" => $formulahelpdata]
            ),
            'footer' => '',
        ];

        return $this->content;
    }

    /**
     * Determines if this block instance has custom entries or relies on the global defaults.
     *
     * @return bool True if custom entries exist, false otherwise.
     */
    public function has_custom_entries(): bool {
        if (!isset($this->config)) {
            return false;
        }

        if (!isset($this->config->usecustomentries) || !isset($this->config->customentries)) {
            return false;
        }

        return $this->config->usecustomentries == true && !empty($this->config->customentries);
    }

    /**
     * Retrieves the syntax help entries for this block instance.
     *
     * @return array The array of syntax help entries with a shape of [{'out': '\( 42 * \pi \)', 'in': '42 * pi'}, ...].
     * @throws dml_exception
     */
    public function get_entries(): array {
        return $this->has_custom_entries()
            ? json_decode($this->config->customentries)
            : json_decode(get_config('block_mathsyntaxhelp', 'defaultcontent'));
    }
}
