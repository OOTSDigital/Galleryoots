<?php
namespace Craft;

/**
 * Galleryoots service
 */
class GalleryootsService extends BaseApplicationComponent
{
     protected $galleryootsRecord;

    /**
     * Create a new instance of the Galleryoots Service.
     * Constructor allows GalleryootsRecord dependency to be injected to assist with unit testing.
     *
     * @param @galleryootsRecord to access the database
     */
    public function __construct($galleryootsRecord= null)
    {
        $this->galleryootsRecord = $galleryootsRecord;
        if (is_null($this->galleryootsRecord)) {

            $this->galleryootsRecord = GalleryootsRecord::model();
        }
    }
    
    /**
     * Save a new record to the database.
     *
     * @param  GalleryootsModel $model
     * @return bool
     */
    public function add(GalleryootsModel &$model)
    {


       $record = $this->galleryootsRecord->create();

       $attributes = array(
       						'name' =>$model->name,
       						'assets_folder_id'=>$model->assets_folder_id, 
       						'transformation'=>$model->transformation, 
       						'total_images'=>$model->total_images, 
                            'selected_images'=>$model->selected_images, 
       						'status'=>$model->status
       					   );
       
       $record->setAttributes($attributes,false);  //if you don't put false it won't save for non-mandatory field.
       
       $record->save();

    }

    //update service
    public function update(GalleryootsModel &$model, $id)
    {

       $record = $this->galleryootsRecord->findById($id); //get record by Id

       $attributes = array(
                            'name' =>$model->name,
                            'assets_folder_id'=>$model->assets_folder_id, 
                            'transformation'=>$model->transformation, 
                            'total_images'=>$model->total_images, 
                            'selected_images'=>$model->selected_images, 
                            'status'=>$model->status
                           );

       $record->setAttributes($attributes,false);  //if you don't put false it won't save for non-mandatory field.
       $record->save();
    }

     /**
     * Delete an record from the database.
     *
     * @param  int $id
     * @return int The number of rows affected
     */
    public function deleteRecordById($id)
    {
        return $this->galleryootsRecord->deleteByPk($id);
    }

    /**
     * GetAll.
     * @param $id = ad id 
     * @throws Exception
     * @return bool
     */
    public function getAll()
    {
        $records = $this->galleryootsRecord->findAll(array('order'=>'t.dateCreated'));
        return GalleryootsModel::populateModels($records, 'id'); //populate models into models array by id ascending, it will return array of all models
    }

     public function getTotalGalleries()
    {
        $records = $this->galleryootsRecord->findAll(array('order'=>'t.dateCreated'));
        return count($records);
    }

    //get gallery by Id
      public function getGalleryById($id)
    {
        $record = $this->galleryootsRecord->findById($id); //search record by id from the galleryoots_records table

        return $record;
    }

     //get number of active galleries
      public function getActiveGalleriesNo()
    {
        $records = GalleryootsRecord::model()->findAllByAttributes(array('status' => 'active')); //why here record acts like a model?
        return count($records);
    }

     public function getActiveGalleries()
    {
        $records = GalleryootsRecord::model()->findAllByAttributes(array('status' => 'active')); //why here record acts like a model?
        return GalleryootsModel::populateModels($records, 'id'); //populate models into models array by id ascending, it will return array of all models
    }

     /**
     * Get Asset Folder Names.
     * @param $id = ad id 
     * @throws Exception
     * @return bool
     */
    public function getAssetFolders()
    {
        $assetFolderRecord = new AssetFolderRecord();
        //$assetsSourceService = new AssetsSourcesService();
        //$records = $assetsSourceService->getFilesBySourceId(1);
        //$records = $assetFolderRecord->findAll(array('order'=>'t.dateCreated'));

        //select all assetfiles where sourceId = 1
        $records = $assetFolderRecord->findAll(array('order'=>'t.dateCreated'));
        


        return AssetFolderModel::populateModels($records, 'id'); //populate models into models array by id ascending, it will return array of all models
    }

     /**
     * Get Transformations related to selected Assets Folder.
     * @param $id = ad id 
     * @throws Exception
     * @return bool
     */
    public function getTransformations()
    {
        $assetTransformRecord = new AssetTransformRecord();

        $records = $assetTransformRecord->findAll(array('order'=>'t.dateCreated'));
        return AssetTransformModel::populateModels($records, 'id'); //populate models into models array by id ascending, it will return array of all models
    }


    //This function returns total number of files in assets
    //check it out
    public function getTotalFiles(){
        $assetsServices = new AssetsService();
        return $assetsServices->getTotalFiles($criteria = null);
    }

    public function displayAllFiles($sourceId){
        $assetsServices = new AssetsService();
        return $assetsServices->getFilesBySourceId($sourceId, $indexBy = null);
    }

	/**
	 * Fires an 'onBeforeSend' event.
	 *
	 * @param GalleryootsEvent $event
	 */
	public function onBeforeSend(GalleryootsEvent $event)
	{
		$this->raiseEvent('onBeforeSend', $event);
	}
}