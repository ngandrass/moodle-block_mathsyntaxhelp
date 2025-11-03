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
 * Plugin strings are defined here.
 *
 * @package     block_mathsyntaxhelp
 * @category    string
 * @copyright   2025 Niels Gandraß <niels@gandrass.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// @codingStandardsIgnoreFile

defined('MOODLE_INTERNAL') || die(); // @codeCoverageIgnore

// General.
$string['pluginname'] = 'Hilfe zur Formeleingabe';
$string['entries'] = 'Einträge';
$string['input_syntax'] = 'Eingabesyntax';
$string['math_expression'] = 'Formel';

// Capabilities.
$string['mathsyntaxhelp:addinstance'] = 'Füge einen neuen Formeleingabehilfe-Block hinzu';
$string['mathsyntaxhelp:customize'] = 'Erlaubt die Anpassung des Inhalts eines einzelnen Formeleingabehilfe-Blocks';
$string['mathsyntaxhelp:myaddinstance'] = 'Füge einen neuen Formeleingabehilfe-Block zur Meine Moodle-Seite hinzu';

// Settings.
$string['customize_block_entries'] = 'Einträge dieses Blocks anpassen';
$string['customize_block_entries_help'] = 'Wenn die lokale Anpassung aktiviert ist, zeigt diese einzelne Blockinstanz die unten konfigurierten Einträge anstelle der standardmäßigen Einträge an. Die leeren Zeilen können verwendet werden um neue Werte hinzuzufügen. Wenn mehr Zeilen benötigt werden, speichern Sie einfach die aktuellen Einträge und es werden danach zusätzliche leere Zeilen angezeigt. Um Einträge zu entfernen, leeren Sie die jeweiligen Felder. Die leeren Zeilen werden beim Speichern entfernt. Um zu den globalen Standardeinträgen zurückzukehren, deaktivieren Sie einfach die Anpassung mit dem obigen Kontrollkästchen und klicken Sie auf Speichern.';
$string['setting_defaultcontent'] = 'Standardeinträge';
$string['setting_defaultcontent_desc'] = 'Die Einträge, die jeder Formeleingabehilfe-Block standardmäßig anzeigt. Dies kann für eine einzelne Blockinstanz geändert oder als Standard belassen werden. Die leeren Zeilen können verwendet werden um neue Einträge hinzuzufügen. Wenn mehr Zeilen benötigt werden, speichern Sie einfach die aktuellen Einträge und es werden danach zusätzliche leere Zeilen angezeigt. Um Einträge zu entfernen, leeren Sie die jeweiligen Felder. Die leeren Zeilen werden beim Speichern entfernt.';

// Privacy.
$string['privacy:metadata'] = 'Der Formeleingabehilfe-Block speichert keine personenbezogenen Daten.';
