<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/7/2017
 * Time: 8:10 AM
 */

namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id'    => $user->id,
            'email' => $user->email

        ];
    }
}