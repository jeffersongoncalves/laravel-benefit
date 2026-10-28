# Changelog

All notable changes to this project will be documented in this file.

## 1.0.1 - 2026-10-28

Tests now load the package migrations with jeffersongoncalves/pest-plugin-database-migrations, in the order declared by the service provider, instead of copying the .php.stub files by hand. No runtime changes.

## 1.0.0 - 2026-08-30

Initial release: Benefit model with spatie/laravel-translatable support for name and description fields, migration, factory, service provider, and Pest test suite.

## [Unreleased]

### Added

- Initial release: `Benefit` model with translatable `name`/`description` fields, unique `slug`, migration, config, factory, and tests
