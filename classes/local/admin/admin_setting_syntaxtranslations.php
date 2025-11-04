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

namespace block_mathsyntaxhelp\local\admin;

use core\exception\moodle_exception;

// phpcs:ignore
defined('MOODLE_INTERNAL') || die(); // @codeCoverageIgnore


/**
 * Custom admin setting to manage multiple syntax translations.
 *
 * @package   block_mathsyntaxhelp
 * @copyright 2025 Niels Gandraß <niels@gandrass.de>
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class admin_setting_syntaxtranslations extends \admin_setting {
    /**
     * Constructor
     * @param string $name unique ascii name, either 'mysetting' for settings that in config,
     *                     or 'myplugin/mysetting' for ones in config_plugins.
     * @param string $visiblename localised name
     * @param string $description localised long description
     * @param mixed $defaultsetting string or array depending on implementation
     */
    public function __construct($name, $visiblename, $description, $defaultsetting) {
        $this->paramtype = PARAM_RAW;

        parent::__construct($name, $visiblename, $description, $defaultsetting);
    }

    /**
     * Return part of form with setting
     * This function should always be overwritten
     *
     * @param mixed $data array or string depending on setting
     * @param string $query
     * @return string
     * @throws moodle_exception
     */
    public function output_html($data, $query = '') {
        global $OUTPUT;

        // Prepare template data.
        $formulahelpdata = [];
        $idx = 0;
        foreach (json_decode($data) as $entry) {
            $formulahelpdata[] = [
                'id' => $idx++,
                'out' => $entry->out,
                'in' => $entry->in,
            ];
        }
        // Add extra empty rows for new entries.
        for ($i = 0; $i < 5; $i++) {
            $formulahelpdata[] = [
                'id' => $idx++,
                'out' => '',
                'in' => '',
            ];
        }

        $element = $OUTPUT->render_from_template(
            'block_mathsyntaxhelp/admin/setting/syntaxtranslation',
            [
                'name' => $this->get_full_name(),
                'entries' => $formulahelpdata,
            ]
        );

        return format_admin_setting($this, $this->visiblename, $element, $this->description, true, '', null, $query);
    }

    /**
     * Returns current value of this setting
     *
     * @return mixed array or string depending on instance, NULL means not set yet
     */
    public function get_setting() {
        return $this->config_read($this->name);
    }

    /**
     * Store new setting
     *
     * @param mixed $data string or array, must not be NULL
     * @return string empty string if ok, string error message otherwise
     * @throws \coding_exception
     */
    public function write_setting($data) {
        // Validate input.
        if (!isset($data) || !is_iterable($data)) {
            return $this->config_write($this->name, '') ? '' : get_string('errorsetting', 'admin');
        }

        // Convert form data to compact format for storage.
        $translations = [];
        foreach ($data as $entry) {
            $out = trim($entry['out']);
            $in = trim($entry['in']);

            // Only keep valid entries.
            if ($out && $in) {
                $translations[] = [
                    'out' => $out,
                    'in' => $in,
                ];
            }
        }

        // Save entries.
        return $this->config_write($this->name, json_encode($translations)) ? '' : get_string('errorsetting', 'admin');
    }
}
