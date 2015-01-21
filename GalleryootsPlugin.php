<?php
namespace Craft;

class GalleryootsPlugin extends BasePlugin
{
	function getName()
	{
		return 'Gallery OOTS';
	}

	function getVersion()
	{
		return '1.0';
	}

	function getDeveloper()
	{
		return 'Out Of The Square Media - OOTS';
	}

	function getDeveloperUrl()
	{
		return 'http://outofthesquare.com.au';
	}

	public function hasCpSection()
    {
        return true;
    }

    /**
     * Register control panel routes
     */
    public function registerCpRoutes()
	{
  		return array(
  			'galleryoots/index' => array('action' => 'galleryoots'),
  			'galleryoots/new' => array('action' => 'galleryoots/new'),
    		'galleryoots/add' => array('action' => 'galleryoots/add'),
    		'galleryoots/edit/(?P<requestId>\d+)' => array('action' => 'galleryoots/edit'), //edit route
    		'galleryoots/delete/(?P<requestId>\d+)' => array('action' => 'galleryoots/delete'),
  		);
	} 
}