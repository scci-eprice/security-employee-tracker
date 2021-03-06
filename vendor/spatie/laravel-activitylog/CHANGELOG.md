# Changelog

All notable changes to `spatie/laravel-activitylog` will be documented in this file

## 1.12.1 - 2017-02-12
- avoid PHP error when dealing with placeholders that cannot be filled

## 1.12.0 - 2017-02-04
- drop support for L5.2 and lower
- add ability to log attributes of related models

## 1.11.0 - 2017-01-23
- add support for L5.4

## 1.10.4 - 2017-01-20
- `Activity` now extends from `Model` instead of `Eloquent`

## 1.10.2 - 2016-11-26
- fix compatibilty for Laravel 5.1

## 1.10.1 - 2016-10-11
- fix `scopeCausedBy` and `scopeForSubject`

## 1.10.0 - 2016-10-10
- add support for `restored` event

## 1.9.2 - 2016-09-27 
- fixed a bug where the delete event would not be logged

## 1.9.1 - 2016-09-16
- fixed the return value of `activity()->log()`. It will now return the created `Activity`-model.

## 1.9.0 - 2016-09-16
- added `Macroable` to `ActivityLogger`

## 1.8.0 - 2016-09-12
- added `causedBy` and `forSubject` scopes

## 1.7.1 - 2016-08-23
- Added L5.3 compatibility

## 1.7.0 - 2016-08-17
- Added `enabled` option in the config file.

## 1.6.0 - 2016-08-11
- Added `ignoreChangedAttributes`

## 1.5.0 - 2016-08-11
- Added support for using a custom `Activity` model

## 1.4.0 - 2016-08-10
- Added support for soft deletes

## 1.3.2 - 2016-08-09
- This version replaces version `1.3.0`
- Dropped L5.1 compatibility

## 1.3.1 - 2016-08-09
- this version removes the features introduced in 1.3.0 and is compatible with L5.1

## 1.3.0 - 2016-07-29

**DO NOT USE THIS VERSION IF YOU'RE ON L5.1**

Please upgrade to:
- `1.3.1` for Laravel 5.1
- `1.3.2` for Laravel 5.2 and higher

Introduced features
- made the auth driver configurable

## 1.3.0 - 2016-07-29

- made the auth driver configurable

## 1.2.1 - 2016-07-09

- use config repo contract

## 1.2.0 - 2016-07-08

- added `getLogNameToUse`

## 1.1.0 - 2016-07-04

- added `activity`-method on both the `CausesActivity` and `LogsActivity`-trait

## 1.0.3 - 2016-07-01

- the package is now compatible with Laravel 5.1

## 1.0.2 - 2016-06-29

- fixed naming of `inLog` scope
- add `inLog` function alias

## 1.0.1 - 2016-06-29

- fixed error when publishing migrations

## 1.0.0 - 2016-06-28

- initial release
