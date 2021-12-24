<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'company';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['company_name'];

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
    public function getCompanyData() 
    {
        $this->select('id, company_name');
        $company = $this->orderBy('company_name', 'ASC')->findAll();
        $company_arr[''] = '--Select Company--';
        foreach ($company as $key => $com) {
            $company_arr[$com['id']] = $com['company_name'];
        }
        return $company_arr;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return array
     */
    public function getStatusData() 
    {
        $status_arr[''] = "--Select Status--";
        foreach (['Approved', 'Pending', 'Reject'] as $key => $status) {
            $status_arr[$status] = $status;
        }
        return $status_arr;
    }
}
