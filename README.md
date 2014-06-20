Bravo3 Standards
================

This is revision 1.0.0 of the Bravo3 Coding Standards for PHP.


General
-------

* All Bravo3 projects must be licensed under the MIT license
* The composer.json should reflect an MIT license
* This library may be included in a project to require all Bravo3 required libraries, such as phpunit, psr/log and eloquent/enumeration

### Platform support

* The minimum requirements for a Bravo3 application is PHP 5.4
* All code must be platform independent
* Do not use functions that only work on a single platform (eg `money_format`)
* Do not ever reference an absolute path on the filesystem
* Do not require a particular webserver (eg do not rely on an .htaccess)
* Do not require a virtual machine
* Do not require 3rd party utilities that cannot be installed with Composer (eg Cucumber)

### Front controllers / Application environment

* Your application must always have a single entry point
* Do not expect pre-set environment variables

#### For web applications

* Your environment must be defined by the entry point
* Your vhost config must direct all traffic to the front controller

#### For console applications

* Your environment must be defined by an argument
* Your entry point must be executable on Linux systems, and safe to run via `php` on non-Linux systems

### Configuration

* No passwords can be in application configuration or under version control
* Use a parameters file that is excluded from the git repository to bring in environment-specific config
* Use the `incenteev/composer-parameter-handler` package to define default parameters

### Version Control System

* All code must be maintained in Git
* All repositories must be in the Bravo3 Organisation on Github

### Composer

* All libraries and projects must have dependencies controlled via Composer
* Composer should define a PSR-0 autoloader to include `src/` and `tests/`

```
"autoload": {
    "psr-0": { "": ["src/", "tests/"] }
},
```

### Project structure

* All projects must contain code formatted in a PSR-0 structure under the `src/` directory
* All tests must be in the `tests/` directory (see Testing)
* All documentation must be in the `docs/` directory (see Documentation)
* A `phpunit.xml.dist` file must exist in the root or an appropriate application directory (eg "app/")
* A `README.md` file must exist in the root directory
* If a web root exists, it must be a stand-alone folder off the root with an appropriate name (eg "web/")
* If a binary directory is required, it should be "bin/"

### Versioning

* Applications should follow the version standard `x.y.z[-stablity]`, where:
    * `x` is the major release version: increment on rebuilds or major incompatibilities
    * `y` is the minor release version: increment on minor incompatibilities
    * `z` is the revision: increment only if there are no backwards incompatibilities
    * `-stability` is optional and one of:
        * `-stable`
        * `-rc`
        * `-beta`
        * `-alpha`
        * `-dev`
* Examples:
    * `1.0.4-beta`
    * `1.3.34`
* Tag commits in VCS when releasing a new version
* Do NOT tag or version with a 'v' prefix (eg `v1.0.3`)

Documentation
-------------

* All documentation should be in the form of Markdown in the projects `docs/` folder
* All projects should have a `README.md` containing an overview, brief usage examples and links to further documentation

Coding Standard
---------------

* All code must follow PSR-1 standards
* All further standards in this section extend beyond those rules

### SPL Usage

* Where possible, you should extend or take advantage of SPL data-structures and classes

### Naming Convention

* All namespace and class names must be in upper camel case (eg `MyStuff\ClassName`)
* Acronyms must be treated like a word (eg "CIA" should be cased "Cia")
* All method names must be in lower camel case (eg `getSomeProperty()`)
* All variables and properties must be in snake case  (eg `$some_variable`)
* All libraries and projects must have a 2nd tier namespace (eg `Bravo3\Standards`)

### Type Hinting

* All method arguments should include type-hints where possible
* If an array is being passed, the `array` type-hint should be used

Code Style
----------

* All code must follow PSR-2 standards
* All further standards in this section extend beyond those rules

### Extended Styles

* All non-root namespaces should be imported via a 'use' statement
* Constructors should always include parenthesis
* Array declarations should use square brackets, never `array()` (eg `$my_array = ['hello' => 'world'];`)

### Documentation

* A methods return variable should never be unknown
* If a method returns multiple options, the PHPDoc block should include all options separated by a pipe (eg `@return SomeClass|null`)
* PHPDoc blocks should never be inaccurate
* `@param`, `@return` and `@throws` should always include a type-hint
* PHPDoc blocks are not mandatory, unless the return variable will be unknown


Code Requirements
-----------------

### Error Handling

* PHP errors and warnings should always be converted to exceptions.

### Enumeration

* Enumerations should extend the `eloquent/enumeration` package


```php
use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static HttpRequestMethod GET()
 * @method static HttpRequestMethod POST()
 * @method static HttpRequestMethod PUT()
 * @method static HttpRequestMethod DELETE()
 */
final class HttpRequestMethod extends AbstractEnumeration
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
}
```


### Logging

* All code should take advantage of the PSR-3 logger interfaces

### Exceptions

* All 2nd tier namespaces should have an `Exception/` directory
* All 2nd tier namespaces should have a generic exception interface
* All exceptions should implement the 2nd tier generic interface, and extend an SPL exception class
    * eg `class SomeException extends \RuntimeException implements MyBundleException`

### Collections

* When returning a collection of objects, your method should return a `\Traversable` object instead of an array
* This can be quickly implemented using the ArrayIterator class, see [SampleItemCollection.php](docs\SampleItemCollection.php)


### Principles

* All code should pass all SOLID principles
* All services and libraries should be stand-alone, heavily interfaced and use abstractions to communicate with other services

### Interfacing

* Where applicable, objects should implement an interface
* Where applicable, an interface should be the type-hint of method arguments (not implementations, see LSP)
* Main interfaces should include abstract implementations where appropriate
* Supporting interfaces should include trait implementations where appropriate

Branching
---------

* Feature branches must be directly off the master
* Feature branch names should be in the format of "feature-<feature-name>"
* Hot-fix branch names should be in the format of "hotfix-<name>"


Testing
-------

* Unit tests must use the latest PHPUnit and should use the latest version of PHPUnit
* Unit tests should be in the `tests/` folder off the root
* Test cases should follow PSR-0 namespace standards
* Test cases should be under the 2nd tier namespace, followed by 'Tests/'
    * eg `tests/Bravo3/Standards/Tests/UtilityTest.php` would test `src/Bravo3/Standards/Utility.php`
* All PHP code should have 90%-100% PHPUnit test coverage with the following exclusions:
    * Exceptions
    * Test related content
    * Impossible to test scenarios (use `@codeCoverageIgnoreStart` and `@codeCoverageIgnoreEnd` to exclude these)
* Live integration testing requiring 3rd party APIs should be added to an `@integration` group and excluded by default
