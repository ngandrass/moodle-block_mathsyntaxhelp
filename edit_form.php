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
 * Block edit form class for the block_mathsyntaxhelp plugin.
 *
 * @package   block_mathsyntaxhelp
 * @copyright 2025 Niels Gandraß <niels@gandrass.de>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// phpcs:ignore
defined('MOODLE_INTERNAL') || die(); // @codeCoverageIgnore

/**
 * Block edit form class for the block_mathsyntaxhelp plugin.
 */
class block_mathsyntaxhelp_edit_form extends block_edit_form {
    /**
     * Creates the form fields for the block instance configuration.
     *
     * @param MoodleQuickForm $mform Moodle form to populate
     * @return void
     * @throws block_not_on_page_exception
     * @throws coding_exception
     * @throws dml_exception
     * @throws moodle_exception
     */
    protected function specific_definition($mform) {
        /** @var block_mathsyntaxhelp $block */
        $block = $this->get_block();

        // Check if the user has the capability to customize block entries.
        if (!has_capability('block/mathsyntaxhelp:customize', $block->context)) {
            return;
        }

        // Checkbox to enable/disable block entry customization.
        $customentriescheckbox = $mform->addElement(
            'advcheckbox',
            'config_usecustomentries',
            get_string('entries', 'block_mathsyntaxhelp'),
            get_string('customize_block_entries', 'block_mathsyntaxhelp'),
            [],
            [0, 1]
        );
        $mform->setDefault($customentriescheckbox->getName(), $block->has_custom_entries() ? 1 : 0);
        $mform->addHelpButton(
            $customentriescheckbox->getName(),
            'customize_block_entries',
            'block_mathsyntaxhelp'
        );

        // Create entry headers.
        $headerattributes = [
            'disabled' => 'disabled',
            'style' => '
                border: 0;
                font-weight: bold;
                color: #000000;
                background-color: transparent;
                padding: 0;
                height: unset;
                cursor: default;
            ',
        ];
        $headerentryout = $mform->createElement('text', 'header_entry_out', '', $headerattributes);
        $mform->setDefault($headerentryout->getName(), get_string('math_expression', 'block_mathsyntaxhelp'));
        $headerentryin = $mform->createElement('text', 'header_entry_in', '', $headerattributes);
        $mform->setDefault($headerentryin->getName(), get_string('input_syntax', 'block_mathsyntaxhelp'));
        $mform->addGroup([$headerentryout, $headerentryin]);

        // Add existing block entries.
        $entryidx = 0;  // Running index for entry fields.
        foreach ($block->get_entries() as $entry) {
            $outentry = $mform->createElement('text', "raw_entry[{$entryidx}][out]");
            $mform->setType($outentry->getName(), PARAM_RAW);
            $mform->setDefault($outentry->getName(), $entry->out);
            $mform->disabledIf($outentry->getName(), 'config_usecustomentries', 'notchecked');

            $inentry = $mform->createElement('text', "raw_entry[{$entryidx}][in]");
            $mform->setType($inentry->getName(), PARAM_RAW);
            $mform->setDefault($inentry->getName(), $entry->in);
            $mform->disabledIf($inentry->getName(), 'config_usecustomentries', 'notchecked');

            $mform->addGroup([$outentry, $inentry]);
            $entryidx++;
        }

        // Add blank entry rows if instance customization is enabled.
        for ($i = 0; $i < 5; $i++) {
            $outentry = $mform->createElement('text', "raw_entry[{$entryidx}][out]");
            $mform->setType($outentry->getName(), PARAM_RAW);

            $inentry = $mform->createElement('text', "raw_entry[{$entryidx}][in]");
            $mform->setType($inentry->getName(), PARAM_RAW);

            $group = $mform->addGroup([$outentry, $inentry]);
            $mform->hideIf($group->getName(), 'config_usecustomentries', 'notchecked');
            $entryidx++;
        }
    }

    /**
     * Return submitted data if properly submitted or returns NULL if validation fails or
     * if there is no submitted data.
     *
     * @return stdClass submitted data; NULL if not valid or not submitted or cancelled
     * @throws block_not_on_page_exception
     * @throws coding_exception
     * @throws moodle_exception
     */
    public function get_data() {
        $data = parent::get_data();

        // If the user does not have the capability to customize, ignore any custom entries.
        if (!has_capability('block/mathsyntaxhelp:customize', $this->get_block()->context)) {
            $data->config_usecustomentries = 0;
            unset($data->raw_entry);

            return $data;
        }

        // Process custom entries.
        if (isset($data->raw_entry)) {
            // Pop raw entries off the data object.
            $rawentries = $data->raw_entry;
            unset($data->raw_entry);

            // Only process custom entries if the corresponding checkbox was checked.
            if ($data->config_usecustomentries) {
                // Process raw entries into serialized format for storage.
                $entries = [];
                foreach ($rawentries as $entry) {
                    $out = trim($entry['out']);
                    $in = trim($entry['in']);

                    // Only keep valid entries.
                    if ($out && $in) {
                        $entries[] = [
                            'out' => $out,
                            'in' => $in,
                        ];
                    }
                }

                $data->config_customentries = json_encode($entries);
            } else {
                $data->config_customentries = '';
            }
        }

        return $data;
    }
}
