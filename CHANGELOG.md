# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## [v1.2.3 (2019-07-26)](https://github.com/clickstorm/cs_file_meta_fill/compare/v1.2.2...v1.2.3)

> This Release resolves an issue with non-composer TYPO3 projects.

### Fixed

- Removed doctrine/inflector dependency, since we literally only used one method and it broke non-composer usage

### Miscellaneous

- Disallow failure of php7.3 tests
- fixed composer.json deprecation
- updated php-cs-fixer ruleset to match current TYPO3 Core ruleset

## [v1.2.2 (2019-03-05)](https://github.com/clickstorm/cs_file_meta_fill/compare/v1.2.1...v1.2.2)

### Fixed

- Fixed a regression introduced in v1.2.0 which caused the OriginalFileNameRepository to return a boolean
 instead of string|null when no original filename was found.

## [v1.2.1 (2019-02-21)](https://github.com/clickstorm/cs_file_meta_fill/compare/v1.2.0...v1.2.1)

### Fixed

- Fixed a regression introduced in v1.2.0 which caused the Extension to stop working in TYPO3 v9

### Added

- Added official TER Documentation Link
- Implemented gitlab-ci configuration
- php-codesniffer configuration
- Adapted composer.json for CI

## [v1.2.0 (2019-02-15)](https://github.com/clickstorm/cs_file_meta_fill/compare/v1.1.1...v1.2.0)

### Added

- Added possibility to disable the automatic population of title fields in the extension settings
- TER Documentation


### Fixed

- Fixed wrong composer.json version constraint

## [v1.1.1 (2019-02-11)](https://github.com/clickstorm/cs_file_meta_fill/compare/v1.1.0...v1.1.1)

### Added

- composer.json version
- TER Hook

## [v1.1.0 (2019-02-10)](https://github.com/clickstorm/cs_file_meta_fill/compare/v1.0.1...v1.1.0)

### Added

- Added possibility to create fluent file metadata from respective original file names (see #1)
- A database update is required to add necessary table

## [v1.0.1 (2019-02-08)](https://github.com/clickstorm/cs_file_meta_fill/compare/v1.0.0...v1.0.1)

### Fixed

- Fixed issue with wrong doctrine/inflector requirement

## v1.0.0 (2019-02-08)

> Initial Release
