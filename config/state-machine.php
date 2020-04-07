<?php

return [
    'inventory_requests' => [
        // class of your domain object
        'class' => \Modules\IMS\Entities\InventoryRequest::class,

        // name of the graph (default is "default")
        'graph' => 'workflow',

        // property of your object holding the actual state (default is "state")
        'property_path' => 'status',

        // list of all possible states
        'states' => [
            [
                'name' => 'new',
            ],
            [
                'name' => 'pending',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [

                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'ROLE_INVENTORY_REQUEST_REJECT',
                                    'ROLE_INVENTORY_REQUEST_SHARE',
                                ],
                                'entity' => [
                                    'name' => 'User',
                                    'key' => 'id',
                                    'values' => [8,9,12]
                                ]
                            ]
                        ]
                    ],
                    'url' => 'inventory-request.workflow.show'
                ]
            ],
            [
                'name' => 'shared',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'ROLE_INVENTORY_REQUEST_REJECT',
                                    'ROLE_INVENTORY_REQUEST_APPROVE',
                                    'ROLE_INVENTORY_REQUEST_SHARE',
                                ],
                                'entity' => [
                                    'name' => 'User',
                                    'key' => 'id',
                                    'values' => [8,9,12]
                                ]
                            ]
                        ]
                    ],
                    'url' => 'inventory-request.workflow.show'
                ]
            ],
            [
                'name' => 'approved',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'keys' => [
                                    'requester_id'
                                ]
                            ],
                            // needs to provide the recipients
                            'before' => [
                                'roles' => [
                                    'INVENTORY_REQUEST_RECEIVE',
                                ],
                                'entity' => [
                                    'name' => 'User',
                                    'key' => 'id',
                                    'values' => [8,9,12]
                                ]
                            ]
                        ]
                    ],
                    'url' => 'inventory-request.workflow.show'
                ]
            ],
            [
                'name' => 'received',
                'metadata' => [
                    'url' => 'inventory-request.workflow.show'
                ]
            ],
            [
                'name' => 'rejected',
                'metadata' => [
                    'recipients' => [
                        'type' => [
                            // automatically selects the recipients
                            'after' => [
                                'keys' => [
                                    'requester_id'
                                ]
                            ]
                        ]
                    ],
                    'url' => 'inventory-request.workflow.show'
                ]
            ]

        ],

        // list of all possible transitions
        'transitions' => [
            'pending' => [
                'from' => ['new'],
                'to' => 'pending',
                'metadata' => [
                    'next_state' => 'pending'
                ]
            ],
            'share' => [
                'from' => ['pending', 'shared'],
                'to' => 'shared',
                'metadata' => [
                    'next_state' => 'shared',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_SHARE'
                    ]
                ]
            ],
            'approve' => [
                'from' =>  ['shared', 'pending'],
                'to' => 'approved',
                'metadata' => [
                    'next_state' => 'approved',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_APPROVE'
                    ]
                ]
            ],
            'receive' => [
                'from' => ['approved'],
                'to' =>  'received',
                'metadata' => [
                    'next_state' => 'received',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_RECEIVE'
                    ]
                ]
            ],
            'reject' => [
                'from' => ['pending', 'shared'],
                'to' => 'rejected',
                'metadata' => [
                    'next_state' => 'rejected',
                    'action' => [
                        'role' => 'ROLE_INVENTORY_REQUEST_REJECT'
                    ]
                ]
            ],
        ],

        // list of all callbacks
        'callbacks' => [
            // will be called when testing a transition
            'guard' => [
                /*'guard_on_reviewing' => [
                    // call the callback on a specific transition
                    'on' => 'review',
                    // will call the method of this class
                    'do' => ['MyClass', 'handle'],
                    // arguments for the callback
                    'args' => ['object'],
                ],
                'guard_on_approving' => [
                    // call the callback on a specific transition
                    'on' => 'approve',
                    // will check the ability on the gate or the class policy
                    'can' => 'approve',
                ],*/
            ],

            // will be called before applying a transition
            'before' => [],

            // will be called after applying a transition
            'after' => [
                'history' => [
                    'do' => 'StateHistoryManager@storeHistory'
                ],
//                'recipients' => [
//                    'do' => 'StateRecipientsManager@store'
//                ]
            ],
        ],

    ],
];
