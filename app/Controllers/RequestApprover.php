<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\CompanyModel;
use App\Models\UserModel;
use App\Models\RequestCreatorModel;
use App\Models\RequestUploadModel;
use App\Models\ApproverUploadModel;
use Exception;

class RequestApprover extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        helper('form');
        $company = new CompanyModel();
        $user = new UserModel();
        $data['user_arr'] = $user->getUserData();
        $data['status_arr'] = $company->getStatusData();
        return view('request_approver/request_approver', $data);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $requestCreator = new RequestCreatorModel();
        $result = $requestCreator->getPendingRow($id);
        return $this->response->setJSON($result);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $requestCreator = new RequestCreatorModel();
        try{
            $requestCreator->transStart();
            $data = [
                'user_id' => $this->request->getPost('user_id'),
                'status' => $this->request->getPost('status'),
            ];
            $requestCreator->update($id, $data);
            if($imgs = $this->request->getFiles('files')){
                $upload_arr = array();
                foreach ($imgs['files'] as $key => $img) {
                    $img->move(WRITEPATH . 'uploads');
                    $data = [
                       'file_name' =>  $img->getName(),
                       'request_id' =>  $id,
                    ];
                    $upload_arr[] = $data;
                }
                $approverUpload = new ApproverUploadModel();
                $approverUpload->insertBatch($upload_arr);
            }
            $requestCreator->transComplete();
            return redirect()->route("users")->with("result", "Request updated successfully");
        } catch (Exception $ex) {
            $requestCreator->transRollback();
            return redirect()->to(base_url('/approver'))->with("result", "Something went wrong");
        }
    }
}
