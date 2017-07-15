<?php
namespace CakeUpload\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;
use CakeUpload\Controller\AppController;
use Cake\ORM\Table;

/**
 * Uploads Controller
 *
 * @Author Sahil Chadha(saahil.chadha@yahoo.com)
 */
class UploadsController extends AppController {
	/**
	*	Loading Flash Component to show success or failure message.
	*/
	public function inialize() {
		$this->loadComponent('Flash');
	}
	/**
	*	index action will pass file name
	*   and file created date to index.ctp.
	*/
	public function index() {

        $uploads = TableRegistry::get('CakeUpload.Logos');
		$this->set('uploads', $uploads->find('all'));
	}
	/**
	*	file upload logic.
	*   to upload the file in webroot/files folder.
	*	to save the file data in uploads table in database.
	*	_processFile method is called from UploadsTable class to move uploaded file to webroot/files folder.
	*/
	public $Logos;
	public function upload($file) {
        $this->Logos = TableRegistry::get('Logos');
	
		$dsn = 'mysql://root:@localhost/cake_bookmarks';
		 ConnectionManager::config('default2',['url'=>$dsn]);
		$conn = ConnectionManager::get('default');

        $uploads = TableRegistry::get('CakeUpload.Logos');

		if ($this->request->is('post')) {




            $this->request->data['file']=  $file['file'];
			$this->request->data['file']['path'] = WWW_ROOT. 'files/'. $file['file']['name'];
		//to move uploaded file to webroot/files folder.
			if (!empty($file['file']['size'])) {
				if ( $uploads->_processFile($this->request->data) ) {


                    $logo = $this->Logos->newEntity();
                    $logo = $this->Logos->patchEntity($logo, $this->request->getData('file'));

					if( $this->Logos->save($logo)) {
			                        return $logo->id;
					} else {
									return false;
				
							}
				}
			} else {
						 return false;
				
				}
		}
		
		$this->set('uploads',$uploads);
	}
	
}
