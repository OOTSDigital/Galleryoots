<?php
namespace Craft;

class GalleryootsRecord extends BaseRecord
{
    public function getTableName()
    {
        return 'galleryoots_records';
    }

    public function defineAttributes()
    {
        return array(

            'name' => array(AttributeType::String, 'required' => true),
            'assets_folder_id' => array(AttributeType::Number, 'required' => true),
            'transformation' => array(AttributeType::String, 'required' => true),
            'total_images' => array(AttributeType::Number, 'required' => true),
            'selected_images' => array(AttributeType::String),
            'status' => array(AttributeType::String, 'required' => true),  //status(Active/Inactive)
        );
    }    

    /**
     * Create a new instance of the current class. This allows us to
     * properly unit test our service layer.
     *
     * @return BaseRecord
     */
    public function create()
    {
        $class = get_class($this);
        $record = new $class();

        return $record;
    }     
}