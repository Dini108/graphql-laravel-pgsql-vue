<?php

namespace App\GraphQL\Types;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\PhoneNumber;

class PhoneNumberType extends GraphQLType {

    protected $attributes = [
        'name'          => 'Tag',
        'description'   => 'A Tag',
        'model'         => PhoneNumber::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the tag',
            ],
            'phone_number' => [
                'type'          => Type::string(),
                'description'   => 'Name of the tag',
            ],
        ];
    }

}