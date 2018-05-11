wp-newslist
======

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/elseifab/wp-newslist.git)
[![Build Status](https://travis-ci.org/elseifab/wp-newslist.svg?branch=master)](https://travis-ci.org/elseifab/wp-newslist)
[![GitHub release](https://img.shields.io/github/release/elseifab/wp-newslist.svg)](https://github.com/elseifab/wp-newslist/archive/master.zip)

THIS IS A FORK FROM ARLIMA (https://github.com/victorjonsson/Arlima)

**WORK IN PROGRESS**

The plugin license is converted to MIT.

The plugin in is intended to be backwards compatible with Arlima but with the following requirements:

* PHP version 7 and above.
* WordPress version 4.9 and above.

This is an open source project meaning that the time spent on this project will vary and contributions are welcome.

Some rewrites will be done as first version 3.2 planned as first stable release.

### PHPUnit
Attention! `composer update` before any unit testing!

We run docker containers to unit tests in real WordPress (no mock).
[https://github.com/frozzare/docker-wptest](https://github.com/frozzare/docker-wptest)
[https://github.com/wpup/test-suite](https://github.com/wpup/test-suite)
Special thanks to Frozzare!

To initialize tests with docker, run: `docker run --name mysql -e MYSQL_ALLOW_EMPTY_PASSWORD=true -d mysql:latest`

To run tests, in the plugin folder, eg: `docker run -e WP_VERSION=4.9 --rm -v $(pwd):/opt --link mysql frozzare/wptest:7.0 vendor/bin/phpunit`

PHPUnit testing with docker:
[https://youtu.be/9CEoapNrrSc](Video)


---

# Arlima inherited readme text:

*This Wordpress plugin was created by Swedish newspaper Västerbottens-Kuriren to give its editorial
staff an easy to use tool for customizing the front pages of their online magazines. It's 
used on a daily basis at http://www.folkbladet.nu and http://www.vk.se, websites that 
together has over 200 000 unique visitors per week.*

## Getting started

1. Download the latest release from github and unzip the folder in your plugin directory
2. Go to "Article lists" -> "Edit lists" in wp-admin and create your first article list.
3. Open up a page (or create it) in wp-admin. Down to the right you will see a meta box labeled "Arlima" where you choose
the list that you created on step 2.
4. Go to "Article lists" -> "Manage lists" and start stuffing your article list with interesting content.

*Tip! Install the plugin "Scissors Continued" to get even more functionality out of Arlima*

## Authors

[@chredd](http://twitter.com/chredd) [@znoid](http://twitter.com/znoid) [@victor_jonsson](http://twitter.com/victor_jonsson)
[@lefalque](http://twitter.com/lefalque)


## Wiki

#### User manual

- [Publishing article lists](https://github.com/victorjonsson/Arlima/wiki/Publishing-article-lists)
- [Interface walkthrough](https://github.com/victorjonsson/Arlima/wiki/Interface-walkthrough) *(updated for version 3.0)*
- [Keyboard shortcuts in the list manager](https://github.com/victorjonsson/Arlima/wiki/Keyboard-shortcuts) *(updated for version 3.0)*
- Importing article lists from remote websites
- [Importing RSS-feeds](https://github.com/victorjonsson/Arlima/wiki/Importing-RSS-feeds)

#### Developer manual

- [Custom CSS](https://github.com/victorjonsson/Arlima/wiki/Custom-css)
- [Creating a custom page template](https://github.com/victorjonsson/Arlima/wiki/Writing-a-custom-page-template)
- [Filters and actions](https://github.com/victorjonsson/Arlima/wiki/Filters-and-actions) *(updated for version 3.0)*
- [Programmatically insert article lists in your template](https://github.com/victorjonsson/Arlima/wiki/Programmatically-insert-lists)
- [Creating custom article templates](https://github.com/victorjonsson/Arlima/wiki/Custom-article-templates) *(updated for version 3.0)*
- [Customized streamers](https://github.com/victorjonsson/Arlima/wiki/Custom-streamers)
- [Article formats](https://github.com/victorjonsson/Arlima/wiki/Article-formats)
- [Cache management](https://github.com/victorjonsson/Arlima/wiki/Cache-management)
- [How to modify the post search](https://github.com/victorjonsson/Arlima/wiki/Modified-search)
- [Include PHP files in articles](https://github.com/victorjonsson/Arlima/wiki/File-includes)
- [Article list sections](https://github.com/victorjonsson/Arlima/wiki/Article-list-sections)
- Using Arlima in the ordinary category loop
- [Modifing the list manager with javascript](https://github.com/victorjonsson/Arlima/wiki/Modifing-the-list-manager-with-javascript) *(updated for version 3.0)*


#### Contributer manual

- [Install, configure and build](https://github.com/victorjonsson/Arlima/wiki/Install,-configure-and-build)
- [Server-side, in depth](https://github.com/victorjonsson/Arlima/wiki/Server-side,-in-depth)
- [Front-end, in depth](https://github.com/victorjonsson/Arlima/wiki/Front-end,-in-depth)

#### Misc

- [Upgrading from version 2.x to 3.0](https://github.com/victorjonsson/Arlima/wiki/Upgrading-from-version-2.x-to-3.0)
- [Using other plugins together with Arlima](https://github.com/victorjonsson/Arlima/wiki/Extending-arlima)
- [FAQ](https://github.com/victorjonsson/Arlima/wiki/FAQ)


## Some websites using this plugin

- http://www.vk.se/
- http://norran.se/
- http://www.folkbladet.nu/
- http://esport.aftonbladet.se/
- http://lifesciencesweden.se/
- http://malarnasfacktidning.se/
- http://tidningenelektrikern.se/
- http://www.skolporten.se/
- http://handelstrender.se/
- http://magazin24.se/
