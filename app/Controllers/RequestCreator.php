<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\CompanyModel;
use App\Models\RequestCreatorModel;
use App\Models\RequestUploadModel;
use Exception;

class RequestCreator extends ResourceController
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
        $data['company_arr'] = $company->getCompanyData();
        $data['status_arr'] = $company->getStatusData();
        return view('request_creator/request_creator', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $requestCreator = new RequestCreatorModel();
        try{
            $requestCreator->transStart();
            $data = [
                'company_id' => $this->request->getPost('company_id'),
                'request_id' => $this->request->getPost('request_id'),
            ];
            $requestCreator->insert($data);
            $id = $requestCreator->getInsertID();
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
                $requestUpload = new RequestUploadModel();
                $requestUpload->insertBatch($upload_arr);
            }
            $requestCreator->transComplete();
            return redirect()->route("users")->with("result", "Request added successfully");
        } catch (Exception $ex) {
            $requestCreator->transRollback();
            return redirect()->to(base_url('/request_creator'))->with("result", "Something went wrong");
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function lists()
    {
        $requestCreator = new RequestCreatorModel();
        $status = $this->request->getPost('filter');
        $result = $requestCreator->getAllRow($status);
        $json_data = array(
            "recordsTotal" => count($result),
            "recordsFiltered" => count($result),
            "data" => $result
        );
        return $this->response->setJSON($json_data);
    }
}
