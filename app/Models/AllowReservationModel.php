<?php

namespace App\Models;

use CodeIgniter\Model;

class AllowReservationModel extends Model
{
    protected $table      = 'allow_reservation';
    protected $primaryKey = 'allow_idx';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true; //true이면 delete* 메소드 호출은 실제로 행을 삭제하는 대신 데이터베이스의 deleted_at 필드를 설정

    protected $allowedFields = [
        'reservation_idx'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_dt';
    //protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_dt';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}