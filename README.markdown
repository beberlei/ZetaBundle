# ZetaBundle

Integrate [Zeta Components](http://www.ezcomponents.org) into your Symfony2 application using the ZetaBundle.

## Supported Components

Most of the Zeta Components can be used out of the box with our symfony2 application. However there are
some exceptions which need configuration. These components are configured with the Dependency Injection
using this bundle:

* Search

## Configuring ZetaBundle

Add this bundle to your application's kernel:

    // application/ApplicationKernel.php
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Bundle\ZetaBundle\ZetaBundle(),
            // ...
        );
    }

Open up your `src/autoload.php` file and add the Zeta Components Autoloader:

    require_once "Base/base.php";
    spl_autoload_register( array( 'ezcBase', 'autoload' ) );

This tells Syfmony2 where it can locate your `ezcBase` class. Since ZetaComponents does not
yet follow the PSG-0 Naming standards its autoloader has to be attached manually.

See the Zeta Components documentation for more information how to enable autoloading.

## Configuring Search

If you want to use ezcSearch you have to activate in your Symfony2 `application/config/config.yml`:

    zeta:
      search:
        handler: zeta.search.handler.solr

This sets up a ezcSearch session using Solr at "localhost:8983/solr". You can overwrite
the Solr configuration values by setting:

    zeta.search:
      handler: zeta.search.handler.solr
      solr:
        host: localhost
        port: 8983
        location: /solr

You can also use the `Zend_Search_Lucene` component. This requires ZF to be in your include path and bootstrapped
by yourself inside Symfony2. A good place for this is probably `src/autoload.php`.

    zeta.search:
      handler: zeta.search.handler.zendlucene
      zendlucene:
        data_dir: /tmp/lucene

The data_dir value is optional, pointing to "/tmp/lucene" by default.

## Current ezcSearch Limitations

You have to be aware of the following limitations with ezcSearch currently:

* Namespaced classes won't work (yet)
* The Id Property has to be public
* No constructor arguments allowed