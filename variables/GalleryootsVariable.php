<?php

namespace Craft;

/**
 * Galleryoots Variable provides access to database objects from templates ie. from Admin CP
 */
class GalleryootsVariable
{
    /**
     * Get all available Images
     *
     * @return array
     */
    public function getAll()
    {
        return craft()->galleryoots->getAll();
    }

    //get all assets folder name
    public function getAssetFolders()
    {
        return craft()->galleryoots->getAssetFolders();
    }

    //get all Transformations related to folder
    public function getTransformations()
    {
        return craft()->galleryoots->getTransformations();
    }

    //get all Transformations related to folder
    public function getGalleryById($id)
    {
        return craft()->galleryoots->getGalleryById($id);
    }

    //get number of all galleries
    public function getTotalGalleries()
    {
        return craft()->galleryoots->getTotalGalleries();
    }

    public function getActiveGalleries()
    {
        return craft()->galleryoots->getActiveGalleries();
     
    }

    public function getActiveGalleriesArray()
    {
        $arr = array();

        foreach(craft()->galleryoots->getActiveGalleries() as $gallery){
            array_push($arr, $gallery->id);
        }

        return $arr;
    }


    public function getActiveGalleriesNo()
    {
        return craft()->galleryoots->getActiveGalleriesNo();
    }

    public function getTotalFiles(){

        return craft()->galleryoots->getTotalFiles();
    }

    public function getAllFilesToDisplay($sourceId){
        return craft()->galleryoots->displayAllFiles($sourceId);
    }
}







