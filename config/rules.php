<?php

return [
    'admin' => [
        'user' => [
            'login' => [
                'username' => 'required|exists:admin_users',
                'password' => 'required|between:6,20',
            ],
            'store' => [
                'username' => 'required|unique:admin_users',
                'name'     => 'required',
                'password' => 'required|min:6|max:20',
                'is_super' => 'nullable',
                'roles'    => 'array|nullable'
            ],
            'update' => [
                'username' => 'required',
                'name'     => 'required',
                'password' => 'nullable',
                'is_super' => 'nullable',
                'roles'    => 'array|nullable'
            ]
        ],
        'permission' => [
            'store' => [
                'name'     => 'required|max:191|unique:permissions',
                'icon'     => 'nullable|max:191',
                'weight'   => 'numeric|nullable',
                'fid'   => 'required|numeric',
                'display_name' => 'max:191|nullable',
                'is_menu' => 'nullable',
            ]
        ],
        'role' => [
            'store' => [
                'alias' => 'required',
                'name' => 'required|between:2,20|unique:roles',
                'description' => 'required',
                'permissions' => 'array|nullable'
            ],
            'update' => [
                'alias' => 'required',
                'name' => 'required|between:2,20',
                'description' => 'required',
                'permissions' => 'array|nullable'
            ]
        ],
        'account' => [
            'password' => [
                'old_password' => 'required',
                'password' => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required'
            ]
        ],
        'ad' => [
            'store' => [
                'title' => 'required',
                'image' => 'required',
                'link' => 'required'
            ],
            'update' => [
                'title' => 'required',
                'image' => 'required',
                'link' => 'required',
                'weight' =>'nullable'
            ]
        ],
        'album' => [
            'store' => [
                'title' => 'required|unique:albums',
                'description' => 'required',
                'image' => 'required',
                'is_high' => 'nullable'
            ],
            'update' => [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required',
                'weight' => 'nullable',
                'is_high' => 'nullable'
            ]
        ],
        'tag' => [
            'store' => [
                'title' => 'required|unique:tags',
                'weight' => 'required|numeric'
            ],
            'update' => [
                'title' => 'required',
                'weight' => 'required|numeric'
            ]
        ],
        'article' => [
            'store' => [
                'title' => 'required',
                'image' => 'required',
                'album_id' => 'required',
                'tag_id' => 'required|array',
                'content_raw' => 'required'
            ],
            'update' => [
                'title' => 'required',
                'image' => 'required',
                'album_id' => 'required',
                'tag_id' => 'required|array',
                'content_raw' => 'required'
            ]
        ]
    ]
];
