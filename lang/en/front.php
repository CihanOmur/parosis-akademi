<?php

// Fixed (not database-driven) general front-end phrases. Membership phrases live in lang/en/member.php.
return [
    'follow_us'              => 'Follow Us',
    'newsletter_subscribed'  => 'Thank you! You have subscribed to our newsletter.',
    'newsletter_already'     => 'This e-mail address is already subscribed to our newsletter.',

    'validation' => [
        'newsletter_subscribe' => [
            'email.required' => 'E-mail address is required.',
            'email.email'    => 'Please enter a valid e-mail address.',
            'email.max'      => 'E-mail address may not be longer than :max characters.',
        ],
    ],
];
