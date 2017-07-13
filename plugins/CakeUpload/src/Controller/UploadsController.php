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
	public function upload() {
	    $uploads = TableRegistry::get('CakeUpload.Logos');
	
		$dsn = 'mysql://root:@localhost/cake_bookmarks';
		 ConnectionManager::config('default2',['url'=>$dsn]);
		$conn = ConnectionManager::get('default');

        $uploads = TableRegistry::get('CakeUpload.Logos');
		
		if ($this->request->is('post')) {
			$this->request->data['file']['path'] = WWW_ROOT. 'files/'. $this->request->data['file']['name'];
			$this->request->data['file']['mime'] = $this->request->data['file']['type'];
		//to move uploaded file to webroot/files folder.
			if (!empty($this->request->data['file']['size'])) {
				if ( $uploads->_processFile($this->request->data) ) {
			
			
					if( $conn->insert('logos', [
							'path' =>  $this->request->data['file']['path'],
							'created' => date('Y-m-d h:i:s',time())
							])) {
			 
									$this->Flash->success(__('New file uploaded'));
			
									return $this->redirect(['action' => 'index']);
					} else {
									$this->Flash->error(__('Could not upload file'));
				
							}
				}
			} else {
						 $this->Flash->error(__('Could not upload file'));
				
				}
		}
		
		$this->set('uploads',$uploads);
	}
	
}