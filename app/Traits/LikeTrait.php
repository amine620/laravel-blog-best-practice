<?php
namespace App\Traits;



trait LikeTrait{



public function likeTrait($model,$user_id)
{
        $model->likes()->create([
            'user_id' => $user_id,
        ]);
}


}