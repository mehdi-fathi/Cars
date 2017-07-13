<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Logos Controller
 *
 * @property \App\Model\Table\LogosTable $Logos
 *
 * @method \App\Model\Entity\Logo[] paginate($object = null, array $settings = [])
 */
class LogosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $logos = $this->paginate($this->Logos);

        $this->set(compact('logos'));
        $this->set('_serialize', ['logos']);
    }

    /**
     * View method
     *
     * @param string|null $id Logo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $logo = $this->Logos->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('logo', $logo);
        $this->set('_serialize', ['logo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $logo = $this->Logos->newEntity();
        if ($this->request->is('post')) {
            $logo = $this->Logos->patchEntity($logo, $this->request->getData());
            if ($this->Logos->save($logo)) {
                $this->Flash->success(__('The logo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The logo could not be saved. Please, try again.'));
        }
        $this->set(compact('logo'));
        $this->set('_serialize', ['logo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Logo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $logo = $this->Logos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $logo = $this->Logos->patchEntity($logo, $this->request->getData());
            if ($this->Logos->save($logo)) {
                $this->Flash->success(__('The logo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The logo could not be saved. Please, try again.'));
        }
        $this->set(compact('logo'));
        $this->set('_serialize', ['logo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Logo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $logo = $this->Logos->get($id);
        if ($this->Logos->delete($logo)) {
            $this->Flash->success(__('The logo has been deleted.'));
        } else {
            $this->Flash->error(__('The logo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
