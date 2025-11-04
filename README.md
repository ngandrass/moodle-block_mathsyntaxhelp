# Math Syntax Help Block

[![Latest Version](https://img.shields.io/github/v/release/ngandrass/moodle-block_mathsyntaxhelp)](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/releases)
[![PHP Support](https://img.shields.io/badge/dynamic/regex?url=https%3A%2F%2Fraw.githubusercontent.com%2Fngandrass%2Fmoodle-block_mathsyntaxhelp%2Frefs%2Fheads%2Fmaster%2Fversion.php&search=meta-supported-php%7B(%3F%3Cdata%3E%5B%5E%7D%5D%2B)%7D&replace=%24%3Cdata%3E&label=PHP&color=blue)](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/blob/master/version.php)
[![Moodle Support](https://img.shields.io/badge/dynamic/regex?url=https%3A%2F%2Fraw.githubusercontent.com%2Fngandrass%2Fmoodle-block_mathsyntaxhelp%2Frefs%2Fheads%2Fmaster%2Fversion.php&search=meta-supported-moodle%7B(%3F%3Cdata%3E%5B%5E%7D%5D%2B)%7D&replace=%24%3Cdata%3E&label=Moodle&color=orange)](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/blob/master/version.php)
[![GitHub Workflow Status: Moodle Plugin CI](https://img.shields.io/github/actions/workflow/status/ngandrass/moodle-block_mathsyntaxhelp/moodle-plugin-ci.yml?label=Moodle%20Plugin%20CI)](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/actions/workflows/moodle-plugin-ci.yml)
[![Code Coverage](https://img.shields.io/coverallsCoverage/github/ngandrass/moodle-block_mathsyntaxhelp)](https://coveralls.io/github/ngandrass/moodle-block_mathsyntaxhelp)
[![GitHub Issues](https://img.shields.io/github/issues/ngandrass/moodle-block_mathsyntaxhelp)](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/issues)
[![GitHub Pull Requests](https://img.shields.io/github/issues-pr/ngandrass/moodle-block_mathsyntaxhelp)](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/pulls)
[![Maintenance Status](https://img.shields.io/maintenance/yes/9999)](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/)
[![License](https://img.shields.io/github/license/ngandrass/moodle-block_mathsyntaxhelp)](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/blob/master/LICENSE)
[![Donate with PayPal](https://img.shields.io/badge/PayPal-donate-d85fa0)](https://www.paypal.me/ngandrass)
[![Sponsor with GitHub](https://img.shields.io/badge/GitHub-sponsor-d85fa0)](https://github.com/sponsors/ngandrass)
[![GitHub Stars](https://img.shields.io/github/stars/ngandrass/moodle-block_mathsyntaxhelp?style=social)](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/stargazers)
[![GitHub Forks](https://img.shields.io/github/forks/ngandrass/moodle-block_mathsyntaxhelp?style=social)](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/network/members)
[![GitHub Contributors](https://img.shields.io/github/contributors/ngandrass/moodle-block_mathsyntaxhelp?style=social)](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/graphs/contributors)

A Moodle block that displays a configurable list of common math input syntax examples alongside their rendered MathJax
equivalents. This block serves as a quick reference guide for users when entering mathematical expressions in Moodle,
especially in conjunction with [STACK](https://stack-assessment.org/).

The math syntax help block is available via the [Moodle plugin directory](https://moodle.org/plugins/block_mathsyntaxhelp):

[![Moodle plugin directory](docs/assets/moodle-plugin-directory-button.png)](https://moodle.org/plugins/block_mathsyntaxhelp)


## Features

- Display rendered math expressions alongside their input syntax
- Configurable list of common math syntax examples
- Use of global site-wide default entries or custom entries for single block instances
- Customizable display density and entry background colors
- Usable in any Moodle block area (e.g., in quizzes, courses, ...)
- Control of block instance customization via Moodle capabilities


## Configuration and Usage

After installation, the block will be populated with a default set of math syntax help entries. These default entries
can be customized via the site administration at _Site administration > Plugins > Blocks > Math Syntax Help Block_ (see
[admin block settings](#admin-block-settings)).

By default, all freshly created block instance will use the configured default entries. If a user has the capability
`block/mathsyntaxhelp:customize`, they can customize the entries of any specific block instance via the block instance
settings (see [block instance customization](#block-instance-customization)). If no custom entries are defined for a
block instance, the global default entries will always be used and will automatically be updated on any change via the
block admin settings page.

If you wish to customize the way the math syntax help entries are displayed, you can adjust the table density, i.e.,
row height, and the background color of the entries via the block admin settings page.


## Installation

This plugin can be installed like any other Moodle plugin by placing its source code inside your Moodle installation and
executing the upgrade routine afterward.


### Installing via the site administration (uploaded ZIP file)

1. Download the latest release of this plugin from the [Moodle plugin directory](https://moodle.org/plugins/block_mathsyntaxhelp).
2. Log in to your Moodle site as an admin and go to _Site administration > Plugins > Install plugins_.
3. Upload the ZIP file with the plugin code.
4. Check the plugin validation report and finish the installation.


### Installing manually

The plugin can be also installed by putting the contents of this directory into

```
{your/moodle/dirroot}/blocks/mathsyntaxhelp
```

Afterwards, log in to your Moodle site as an admin and go to _Site administration > Notifications_ to complete the
installation.

Alternatively, you can run `php admin/cli/upgrade.php` from the command line to complete the installation.


## Reporting a bug or requesting a feature

If you find a bug or have a feature request, please open an issue via the [GitHub issue tracker](https://github.com/ngandrass/moodle-block_mathsyntaxhelp/issues).

Please do not use the comments section within the Moodle plugin directory. Thanks :)


## Screenshots

### Example block

![Example block instance](docs/assets/screenshots/block.png)

### Block instance customization

![Block instance customization](docs/assets/screenshots/block_customization.png)

### Admin block settings

![Admin block settings](docs/assets/screenshots/settings.png)


## License

2025 Niels Gandraß <niels@gandrass.de>

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.