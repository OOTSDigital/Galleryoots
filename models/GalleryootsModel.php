<?php
namespace Craft;

//Galleryoots model class
class GalleryootsModel extends BaseModel
{
	protected function defineAttributes()
	{
		return array(

			'id'    => AttributeType::Number,
			'dateCreated'=>AttributeType::DateTime,  //add this if you want to query record using dateCreated
			'name' => array(AttributeType::String, 'required' => true),
            'assets_folder_id' => array(AttributeType::Number, 'required' => true),
            'transformation' => array(AttributeType::String, 'required' => true),
            'total_images' => array(AttributeType::Number, 'required' => true),
            'selected_images' => array(AttributeType::String),
            'status' => array(AttributeType::String, 'required' => true),  //status(Active/Inactive)

		);
	}
}