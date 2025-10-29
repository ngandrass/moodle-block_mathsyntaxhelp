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

// @codingStandardsIgnoreLine
defined('MOODLE_INTERNAL') || die(); // @codeCoverageIgnore


if ($hassiteconfig) {
    // Default block contents.
    $settings->add(new admin_setting_configtextarea(
        'block_mathsyntaxhelp/defaultcontent',
        get_string('setting_defaultcontent', 'block_mathsyntaxhelp'),
        get_string('setting_defaultcontent_desc', 'block_mathsyntaxhelp'),
        json_encode([
            "\\( 4{,}2 \\)" => "4<b>.</b>2",
            "\\( 3x \\)" => "3*x",
            "\\( \\pi \\)" => "pi",
            "\\( e \\)" => "%e",
            "\\( \\infty, -\\infty \\)" => "inf, minf",
            "\\( \\frac{2}{5} \\)" => "2/5",
            "\\( \\frac{1}{x+2} \\)" => "1/(x+2)",
            "\\( x^n \\)" => "x^n",
            "\\( x^n+3x \\)" => "x^n+3*x",
            "\\( \\sqrt{x}, \\sqrt[2]{x} \\)" => "sqrt(x)",
            "\\( \\sqrt[5]{y} \\)" => "y^(1/5)",
            "\\( \\sin(x) \\)" => "sin(x)",
            "\\( \\cos(2y) \\)" => "cos(2*y)",
            "\\( \\tan(z + 3) \\)" => "tan(z+3)",
            "\\( \\arcsin x \\)" => "asin(x)",
            "\\( \\arccos(2y) \\)" => "acos(2*y)",
            "\\( \\arctan(z + 3) \\)" => "atan(z+3)",
            "\\( e^x, \\exp(x) \\)" => "e^x, exp(x)",
            "\\( \\log_e(y) \\)" => "ln(y)",
            "\\( \\log_{10}(x) \\)" => "lg(x)",
            "\\( |x-3| \\)" => "abs(x-3)",
            "\\( x \\geq 1 \\)" => "x>=1",
            "\\( 1 \\leq x < 2 \\)" => "1<=x <b>and</b> x<2",
            "Set \\(\\lbrace-1,0,1.5\\rbrace \\)" => "{-1,0,1.5}",
            "List: 1 2 1" => "[1,2,1]",
        ], JSON_PRETTY_PRINT)
    ));
}
