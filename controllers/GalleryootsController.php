<?php
namespace Craft;

/**
 * Galleryoots controller
 */
class GalleryootsController extends BaseController
{
	/**
	 * @var Allows anonymous access to this controller's actions.
	 * @access protected
	 */
	protected $allowAnonymous = true;

	public function actionIndex()
	{
        // Load index template
    	$this->renderTemplate('galleryoots/index');
	}



	public function actionShow()
	{
	  	// Load show template
    	$this->renderTemplate('galleryoots/_show');
	}

	//edit will need to pull data from the db and display on the template
	//once the data is changed and user click save, data is saved to the db
	public function actionEdit()
	{
	  	// render the template, pass model on render template
    	$this->renderTemplate('galleryoots/_edit');
	}


	public function actionDelete()
    {
    	//delete record from the database using the id passed
    	if($_POST["id"]){
    		$id = $_POST["id"];
    		craft()->galleryoots->deleteRecordById($id); //call deleteRecordById from service	

    		//give feedback that it has been deleted
    		craft()->userSession->setNotice('Gallery has been deleted.');
    	}
    }

	public function actionUpdate()
	{
	     //update gallery details
		$id = craft()->request->getPost('id'); // get id

		$gallery = new GalleryootsModel();  //get model by id

		$gallery->name  = craft()->request->getPost('name');
		$gallery->assets_folder_id  = craft()->request->getPost('assets_folder_id');
		$gallery->transformation  = craft()->request->getPost('transformation');
		$gallery->total_images  = craft()->request->getPost('total_images');
		$gallery->status  = craft()->request->getPost('status');

		//$successRedirectUrl = craft()->request->getPost('successRedirectUrl');
		$selected_images_arr = craft()->request->getPost('selected_images');
		$gallery->selected_images  = implode (",", $selected_images_arr);
		$call_update_record = craft()->galleryoots->update($gallery,$id);

		craft()->galleryoots->update($gallery,$id); //calls the update service, pass model and id
		$this->returnSuccess();
		//}
	}


	public function actionNew()
	{
    	$this->renderTemplate('galleryoots/_new');
	}

	/**
	 * Add Gallery based on posted params.
	 *
	 * @throws Exception
	 */
	public function actionAdd()
	{
		if(!craft()->request->getPost('name')){

			$this->renderTemplate('galleryoots/_new');

		}else{
		
			//call the service to add this to db
			$gallery = new GalleryootsModel();

			$gallery->name  = craft()->request->getPost('name');
			$gallery->assets_folder_id  = craft()->request->getPost('assets_folder_id');
			$gallery->transformation  = craft()->request->getPost('transformation');
			$gallery->total_images  = craft()->request->getPost('total_images');
			$gallery->selected_images  = "none"; //when adding set selected images to "none" to avoid setting null
			$gallery->status  = craft()->request->getPost('status');

			craft()->galleryoots->add($gallery); //call to save gallery

			$this->returnSuccess(); //this is where it redirects to the edit route
 
		}
	}

	/**
	 * Returns a 'success' response.
	 *
	 * @return void
	 */
	protected function returnSuccess()
	{
		if (craft()->request->isAjaxRequest())
		{
			$this->returnJson(array('success' => true));
		}
		else
		{
			// Deprecated. Use 'redirect' instead.
			$successRedirectUrl = craft()->request->getPost('successRedirectUrl');

			if ($successRedirectUrl)
			{
				$_POST['redirect'] = $successRedirectUrl;
			}

			craft()->userSession->setNotice('Gallery has been updated.');
			$this->redirectToPostedUrl();
		}
	}
}