<?php

namespace App\GraphQL\Mutations;

use App\Rules\PhoneValidator;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'editUser'
    ];

    public function authorize(array $args = [])
    {
        return true;
    }

    public function rules(array $args = [])
    {
        $rules = [
            'id' => [
                'sometimes',
                'numeric'
            ],
            'name' => [
                'required',
                'max:50'
            ],
            'email' => [
                'sometimes',
                'email',
            ],
            'phone' => [
                'required', new PhoneValidator()
            ],
            'date_of_birth' => [
                'sometimes',
                'date'
            ],
            'is_active' => [
                'sometimes',
                'boolean'
            ]
        ];

        return $rules;
    }

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return  [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],
            'name' => [
                'name' => 'name',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'email' => [
                'name' => 'email',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'phone' => [
                'name' => 'phone',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'date_of_birth' => [
                'name' => 'date_of_birth',
                'type' =>  Type::string(),
            ],
            'is_active' => [
                'name' => 'is_active',
                'type' =>  Type::boolean(),
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $user = isset($args['id']) ? User::findOrFail($args['id']) : new User();
        $user->fill($args);
        $user->save();
        $user->phone()->updateOrCreate([],['phone_number' => $args['phone']]);

        return $user;
    }
}