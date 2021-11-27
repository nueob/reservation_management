<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user_info';
    protected $primaryKey = 'user_idx';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true; //true이면 delete* 메소드 호출은 실제로 행을 삭제하는 대신 데이터베이스의 deleted_at 필드를 설정

    protected $allowedFields = [
        'user_name','user_mp','user_birth','user_id','user_password'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_dt';
    //protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_dt';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}