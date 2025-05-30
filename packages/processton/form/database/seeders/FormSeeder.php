<?php

namespace Processton\Form\Seeders;

use Illuminate\Database\Seeder;
use Processton\Form\Models\Form;

class FormSeeder extends Seeder
{
    public function run()
    {
        Form::create([
            'name' => 'Contact Us',
            'slug' => 'contact-us',
            'campaign_id' => 1,
            'is_published' => 1,
            'schema' => [
                'rows' => [
                    [
                        'id' => 1,
                        'class' => '',
                        'elements' => [
                            [
                                'id' => 11,
                                'type' => 'heading',
                                'label' => 'Contact us',
                                'headingLevel' => 3,
                                'colspan_xs' => 12,
                                'colspan_sm' => 12,
                                'colspan_md' => 12,
                                'colspan_lg' => 12,
                                'colspan_xl' => 12,
                            ],
                            [
                                'id' => 12,
                                'type' => 'subheading',
                                'subText' => 'Please fillout and submit the form, we will get to you asap',
                                'colspan_xs' => 12,
                                'colspan_sm' => 12,
                                'colspan_md' => 12,
                                'colspan_lg' => 12,
                                'colspan_xl' => 12,
                            ],
                        ],
                    ],
                    [
                        'id' => 2,
                        'class' => '',
                        'elements' => [
                            [
                                'id' => 21,
                                'type' => 'select',
                                'label' => 'Prefix',
                                'name' => 'prefix',
                                'options' => ['Mr', 'Mrs', 'Ms'],
                                'colspan_xs' => 5,
                                'colspan_sm' => 4,
                                'colspan_md' => 3,
                                'colspan_lg' => 3,
                                'colspan_xl' => 3,
                                'required' => false,
                            ],
                            [
                                'id' => 22,
                                'type' => 'text',
                                'label' => 'First Name',
                                'name' => 'first_name',
                                'colspan_xs' => 7,
                                'colspan_sm' => 8,
                                'colspan_md' => 4,
                                'colspan_lg' => 4,
                                'colspan_xl' => 4,
                                'required' => false,
                            ],
                            [
                                'id' => 23,
                                'type' => 'text',
                                'label' => 'Last Name',
                                'name' => 'last_name',
                                'colspan_xs' => 12,
                                'colspan_sm' => 12,
                                'colspan_md' => 5,
                                'colspan_lg' => 5,
                                'colspan_xl' => 5,
                                'required' => true,
                            ],
                        ],
                    ],
                    [
                        'id' => 3,
                        'class' => '',
                        'elements' => [
                            [
                                'id' => 31,
                                'type' => 'email',
                                'label' => 'Email',
                                'name' => 'email',
                                'colspan_xs' => 12,
                                'colspan_sm' => 12,
                                'colspan_md' => 12,
                                'colspan_lg' => 12,
                                'colspan_xl' => 12,
                                'required' => true,
                            ],
                        ],
                    ],
                    [
                        'id' => 4,
                        'class' => '',
                        'elements' => [
                            [
                                'id' => 41,
                                'type' => 'textarea',
                                'label' => 'Message',
                                'name' => 'message',
                                'rows' => 5,
                                'colspan_xs' => 12,
                                'colspan_sm' => 12,
                                'colspan_md' => 12,
                                'colspan_lg' => 12,
                                'colspan_xl' => 12,
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }
}
