<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestCreatorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'request_creator';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['request_id', 'company_id', 'user_id', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return array
     */
    public function getPendingRow($id) 
    {
        $this->select('c.company_name, request_creator.request_id, request_creator.id');
        $this->select('status');
        $this->join('company c',  'c.id = request_creator.company_id');
        $this->groupBy('request_creator.id');
        $this->where('request_creator.status', 'Pending');
        $result = $this->find($id);
        return $result;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return array
     */
    public function getAllRow($status) 
    {
        if($status){
            $this->where('request_creator.status', $status);
        }
        $this->select('c.company_name, request_creator.request_id, request_creator.id');
        $this->select('count(u.id) as upload_document, status');
        $this->select('count(au.id) as approver_document, us.name as action_by');
        $this->join('company c',  'c.id = request_creator.company_id');
        $this->join('request_upload u',  'u.request_id = request_creator.id', 'left');
        $this->join('approver_upload au',  'u.request_id = request_creator.id', 'left');
        $this->join('user us',  'u.id = request_creator.user_id', 'left');
        $this->groupBy('request_creator.id');
        $result = $this->orderBy('id', 'DESC')->findAll();
        return $result;
    }
}
