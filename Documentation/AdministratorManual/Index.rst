.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _admin-manual:

Administrator Manual
====================


Installation
------------

After installing the extension you only need to take care to put the template of the additional view into the correct directory.

If you use the default templates of EXT:news
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you are using the default templates of the news extension and haven't adopted those at all, all you need to do is using this TypoScript:

.. code-block:: typoscript

	plugin.tx_news {
	  view {
		templateRootPaths {
			0 = {$plugin.tx_news.view.templateRootPath}
			1 = EXT:eventnews/Resources/Private/Templates/
		}
	  }
	}

Using your own templates
^^^^^^^^^^^^^^^^^^^^^^^^

If you are using your own templates, just copy the template *EXT:eventnews/Resources/Private/Templates/Month.html* into the same directory
where also the files like *List.html* or *Detail.html* are saved.

Configuration
-------------

The following TypoScript options are available: ::

	startingpointLocation
	startingpointOrganizer
