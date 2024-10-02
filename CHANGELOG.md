# Change Log

## 1.2.0 - 2024-10-02

### Added

- Added getParams and setParams function to Params class.

## 1.1.2 - 2024-05-21

### Changed

- Params::getString() now supports arrays and will return '0' if empty or '1' if not empty.
- Params::getString() will now trim before testing if empty.

## 1.1.1 - 2024-05-06

### Changed

- Calling Params::getString() will now return '0' if false instead of ''.

## 1.1.0 - 2024-03-22

### Added

- Added AbstractDriver class.
- Added DriverNotFoundException class.

## 1.0.2 - 2023-10-19

### Fixed

- Added missing getDateTime and setDateTime functions to ParamsInterface.

## 1.0.1 - 2023-09-16

### Added

- Added PHPStan static analysis.

### Changed

- The ParamsInterface::getStr() and ParamsInterface::setStr() functions have been deprecated in favor of ParamsInterface::getString and ParamsInterface::setString().

## 1.0.0 - 2022-12-28

Initial release.
