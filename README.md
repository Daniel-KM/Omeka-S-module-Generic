Generic Module (module for Omeka S)
===================================


> __New versions of this module and support for Omeka S version 3.0 and above
> are available on [GitLab], which seems to respect users and privacy better
> than the previous repository.__


[Generic Module] is a module for [Omeka S] that allows to manage all common one
time tasks (install, config, settings management…) from the config of another
module, so it avoids the developer to copy-paste common code between modules.

Internally, the logic is "config over code": so all settings have just to be set
in the main `config/module.config.php` file, inside a key with the lowercase
module name, with sub-keys `config`, `settings`, `site_settings`, `user_settings`
and `block_settings`. All the forms have just to be standard Zend forms.
Eventual install and uninstall sql can be set in `data/install/` and upgrade
code in `data/scripts`. Another class allows to check and install resources
(vocabulary, resource templates, custom vocab, etc.).


Installation
------------

Uncompress files and rename module folder `Generic`.

Unlike other modules, this one is available once unzipped, even if it is not
installed or not enabled in the admin modules panel.


Usage (for developer)
---------------------

### Main Usage

This module contains a generic abstract class `AbstractModule`, that extends
itself the Omeka one, so make your module extends it.

Replace the following:

```php
namespace MyModule;
use Omeka\Module\AbstractModule;
class Module extends AbstractModule
{}
```

with:

```php
namespace MyModule;
require_once dirname(__DIR__) . '/Generic/AbstractModule.php';
use Generic\AbstractModule;
class Module extends AbstractModule
{
    const NAMESPACE = __NAMESPACE__;
}
```

If you prefer not to force install of module Generic, you can copy the file `Generic/AbstractModule.php`
in folder `src/` of your module, then require it like that:

```php
namespace MyModule;
if (!class_exists(\Generic\AbstractModule::class)) {
    require file_exists(dirname(__DIR__) . '/Generic/AbstractModule.php')
        ? dirname(__DIR__) . '/Generic/AbstractModule.php'
        : __DIR__ . '/src/Generic/AbstractModule.php';
}
use Generic\AbstractModule;
class Module extends AbstractModule
{
    const NAMESPACE = __NAMESPACE__;
}
```

### Installing resources

To install resources, you need to include the file `InstallResources.php`. The
files that contains vocabs, custom vocabs, and templates inside `data/` will be
automatically imported.


Warning
-------

Use it at your own risk.

It’s always recommended to backup your files and your databases and to check
your archives regularly so you can roll back if needed.


Troubleshooting
---------------

See online issues on the [module issues] page on GitLab.


License
-------

This module is published under the [CeCILL v2.1] license, compatible with
[GNU/GPL] and approved by [FSF] and [OSI].

In consideration of access to the source code and the rights to copy, modify and
redistribute granted by the license, users are provided only with a limited
warranty and the software’s author, the holder of the economic rights, and the
successive licensors only have limited liability.

In this respect, the risks associated with loading, using, modifying and/or
developing or reproducing the software by the user are brought to the user’s
attention, given its Free Software status, which may make it complicated to use,
with the result that its use is reserved for developers and experienced
professionals having in-depth computer knowledge. Users are therefore encouraged
to load and test the suitability of the software as regards their requirements
in conditions enabling the security of their systems and/or data to be ensured
and, more generally, to use and operate it in the same conditions of security.
This Agreement may be freely reproduced and published, provided it is not
altered, and that no provisions are either added or removed herefrom.


Copyright
---------

* Copyright Daniel Berthereau, 2018-2021 (see [Daniel-KM] on GitLab)


[Generic module]: https://gitlab.com/Daniel-KM/Omeka-S-module-Generic
[Omeka S]: https://omeka.org/s
[GitLab]: https://gitlab.com/Daniel-KM/Omeka-S-module-Generic
[module issues]: https://gitlab.com/Daniel-KM/Omeka-S-module-Generic/-/issues
[CeCILL v2.1]: https://www.cecill.info/licences/Licence_CeCILL_V2.1-en.html
[GNU/GPL]: https://www.gnu.org/licenses/gpl-3.0.html
[FSF]: https://www.fsf.org
[OSI]: http://opensource.org
[MIT]: http://http://opensource.org/licenses/MIT
[Daniel-KM]: https://gitlab.com/Daniel-KM "Daniel Berthereau"
