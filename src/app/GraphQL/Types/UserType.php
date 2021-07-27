<?php

namespace App\GraphQL\Types;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\User;

class UserType extends GraphQLType {

    protected $attributes = [
        'name'          => 'User',
        'description'   => 'A User',
        'model'         => User::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the user',
            ],
            'name' => [
                'type'          => Type::string(),
                'description'   => 'Name of the user',
            ],
            'email' => [
                'type'          => Type::string(),
                'description'   => 'Email of the user',
            ],
            'date_of_birth' => [
                'type'          => Type::string(),
                'description'   => 'Email of the user',
            ],
            'is_active' => [
                'type'          => Type::boolean(),
                'description'   => 'Email of the user',
            ],
            'phone' => [
                'type'          => Type::string(),
                'description'   => 'Email of the user',
            ],
            'created_at' => [
                'type'          => Type::string(),
                'description'   => 'Email of the user',
            ],
            'updated_at' => [
                'type'          => Type::string(),
                'description'   => 'Email of the user',
            ],
        ];
    }
}