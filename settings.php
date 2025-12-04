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
 * Plugin admin setting pages are defined here.
 *
 * @package     block_mathsyntaxhelp
 * @copyright   2025 Niels Gandraß <niels@gandrass.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use block_mathsyntaxhelp\local\admin\setting\admin_setting_syntaxtranslations;

// @codingStandardsIgnoreLine
defined('MOODLE_INTERNAL') || die(); // @codeCoverageIgnore


if ($hassiteconfig) {
    // Entry table density.
    $settings->add(new admin_setting_configselect(
        'block_mathsyntaxhelp/tabledensity',
        get_string('setting_tabledensity', 'block_mathsyntaxhelp'),
        get_string('setting_tabledensity_desc', 'block_mathsyntaxhelp'),
        'normal',
        [
            'normal' => get_string('setting_tabledensity_normal', 'block_mathsyntaxhelp'),
            'compact' => get_string('setting_tabledensity_compact', 'block_mathsyntaxhelp'),
        ]
    ));

    // Entry table row style.
    $settings->add(new admin_setting_configselect(
        'block_mathsyntaxhelp/rowstyle',
        get_string('setting_rowstyle', 'block_mathsyntaxhelp'),
        get_string('setting_rowstyle_desc', 'block_mathsyntaxhelp'),
        'striped',
        [
            'striped' => get_string('setting_rowstyle_striped', 'block_mathsyntaxhelp'),
            'plain' => get_string('setting_rowstyle_plain', 'block_mathsyntaxhelp'),
        ]
    ));

    // Default block contents.
    $settings->add(new admin_setting_syntaxtranslations(
        'block_mathsyntaxhelp/defaultcontent',
        get_string('setting_defaultcontent', 'block_mathsyntaxhelp'),
        get_string('setting_defaultcontent_desc', 'block_mathsyntaxhelp'),
        json_encode([
            ['out' => "\\( 4{,}2 \\)", 'in' => "4<b>.</b>2"],
            ['out' => "\\( 3x \\)", 'in' => "3*x"],
            ['out' => "\\( \\pi \\)", 'in' => "pi"],
            ['out' => "\\( e \\)", 'in' => "%e"],
            ['out' => "\\( \\infty, -\\infty \\)", 'in' => "inf, minf"],
            ['out' => "\\( \\frac{2}{5} \\)", 'in' => "2/5"],
            ['out' => "\\( \\frac{1}{x+2} \\)", 'in' => "1/(x+2)"],
            ['out' => "\\( x^n \\)", 'in' => "x^n"],
            ['out' => "\\( x^n+3x \\)", 'in' => "x^n+3*x"],
            ['out' => "\\( \\sqrt{x}, \\sqrt[2]{x} \\)", 'in' => "sqrt(x)"],
            ['out' => "\\( \\sqrt[5]{y} \\)", 'in' => "y^(1/5)"],
            ['out' => "\\( \\sin(x) \\)", 'in' => "sin(x)"],
            ['out' => "\\( \\cos(2y) \\)", 'in' => "cos(2*y)"],
            ['out' => "\\( \\tan(z + 3) \\)", 'in' => "tan(z+3)"],
            ['out' => "\\( \\arcsin(x) \\)", 'in' => "asin(x)"],
            ['out' => "\\( \\arccos(2y) \\)", 'in' => "acos(2*y)"],
            ['out' => "\\( \\arctan(z + 3) \\)", 'in' => "atan(z+3)"],
            ['out' => "\\( e^x, \\exp(x) \\)", 'in' => "e^x, exp(x)"],
            ['out' => "\\( \\log_e(y) \\)", 'in' => "ln(y)"],
            ['out' => "\\( \\log_{10}(x) \\)", 'in' => "lg(x)"],
            ['out' => "\\( |x-3| \\)", 'in' => "abs(x-3)"],
            ['out' => "\\( x \\geq 1 \\)", 'in' => "x>=1"],
            ['out' => "\\( 1 \\leq x < 2 \\)", 'in' => "1<=x <b>and</b> x<2"],
            ['out' => "Set \\(\\lbrace-1,0,1.5\\rbrace \\)", 'in' => "{-1,0,1.5}"],
            ['out' => "List: 1 2 1", 'in' => "[1,2,1]"],
        ])
    ));
}
