<?php

return [
    'contact' => [
        'email' => env('PORTFOLIO_EMAIL', 'almadmouj@gmail.com'),
        'phone' => env('PORTFOLIO_PHONE'),
        'location' => 'Amman, Jordan',
        'social' => [
            'github' => env('PORTFOLIO_GITHUB_URL'),
            'linkedin' => env('PORTFOLIO_LINKEDIN_URL'),
        ],
    ],

    'cv_path' => 'cv/anas-almadmouj-cv.pdf',

    'og_image_path' => 'og-image.png',

    /*
     * Structural project data only.
     * Translated copy lives in lang/{locale}/projects.php.
     */
    'projects' => [
        [
            'slug' => 'tourstify',
            'category' => 'travel',
            'year' => 2024,
            'status' => 'completed',
            'technologies' => [
                'Flutter',
                'Dart',
                'BLoC',
                'Audio Waveforms',
                'REST APIs',
                'Firebase',
                'Payment Gateways',
                'AI Chatbot',
            ],
            'image' => 'images/projects/tourstify/1.jpeg',
            'is_featured' => true,
            'is_public' => true,
            'is_confidential' => false,
            'screenshots' => [
                'images/projects/tourstify/1.jpeg',
                'images/projects/tourstify/2.jpeg',
                'images/projects/tourstify/3.jpeg',
                'images/projects/tourstify/4.jpeg',
                'images/projects/tourstify/5.jpeg',
                'images/projects/tourstify/6.jpeg',
            ],
        ],

        [
            'slug' => 'mondoway',
            'category' => 'ecommerce',
            'year' => 2025,
            'status' => 'completed',
            'technologies' => [
                'Flutter',
                'Dart',
                'Clean Architecture',
                'BLoC',
                'REST APIs',
                'Payment Gateways',
            ],
            'image' => 'images/projects/mondoway/1.jpeg',
            'is_featured' => true,
            'is_public' => true,
            'is_confidential' => false,
            'screenshots' => [
                'images/projects/mondoway/1.jpeg',
                'images/projects/mondoway/2.jpeg',
                'images/projects/mondoway/3.jpeg',
                'images/projects/mondoway/4.jpeg',
                'images/projects/mondoway/5.jpeg',
                'images/projects/mondoway/6.jpeg',
                'images/projects/mondoway/7.jpeg',
                'images/projects/mondoway/8.jpeg',
            ],
        ],

        [
            'slug' => 'bravobravo',
            'category' => 'education',
            'year' => 2025,
            'status' => 'completed',
            'technologies' => [
                'Flutter',
                'Dart',
                'GetX',
                'REST APIs',
                'Responsive UI',
                'Cross-Platform Development',
            ],
            'image' => 'images/projects/bravobravo/1.jpeg',
            'is_featured' => true,
            'is_public' => true,
            'is_confidential' => false,
            'screenshots' => [
                'images/projects/bravobravo/1.jpeg',
                'images/projects/bravobravo/2.jpeg',
                'images/projects/bravobravo/3.jpeg',
                'images/projects/bravobravo/4.jpeg',
                'images/projects/bravobravo/5.jpeg',
                'images/projects/bravobravo/6.jpeg',
            ],
        ],

        [
            'slug' => 'ahlan',
            'category' => 'on-demand-services',
            'year' => 2026,
            'status' => 'completed',
            'technologies' => [
                'Flutter',
                'Dart',
                'REST APIs',
                'State Management',
                'Payment Integration',
                'Responsive UI',
            ],
            'image' => 'images/projects/ahlan/1.jpeg',
            'is_featured' => true,
            'is_public' => true,
            'is_confidential' => false,
            'screenshots' => [
                'images/projects/ahlan/1.jpeg',
                'images/projects/ahlan/2.jpeg',
                'images/projects/ahlan/3.jpeg',
                'images/projects/ahlan/4.jpeg',
                'images/projects/ahlan/5.jpeg',
                'images/projects/ahlan/6.jpeg',
                'images/projects/ahlan/7.jpeg',
                'images/projects/ahlan/8.jpeg',
            ],
        ],

        [
            'slug' => 'mobile-banking-app',
            'category' => 'fintech',
            'year' => 2025,
            'status' => 'in-development',
            'technologies' => [
                'Flutter',
                'Dart',
                'BLoC',
                'Firebase',
                'REST APIs',
            ],
            'image' => null,
            'is_featured' => false,
            'is_public' => false,
            'is_confidential' => false,
            'screenshots' => [],
        ],

        [
            'slug' => 'field-service-platform',
            'category' => 'enterprise',
            'year' => 2024,
            'status' => 'completed',
            'technologies' => [
                'Flutter',
                'Dart',
                'Clean Architecture',
                'Laravel',
                'REST APIs',
            ],
            'image' => null,
            'is_featured' => false,
            'is_public' => false,
            'is_confidential' => false,
            'screenshots' => [],
        ],

        [
            'slug' => 'health-tracking-app',
            'category' => 'healthtech',
            'year' => 2023,
            'status' => 'maintained',
            'technologies' => [
                'Flutter',
                'Riverpod',
                'SQLite',
                'Firebase',
            ],
            'image' => null,
            'is_featured' => false,
            'is_public' => false,
            'is_confidential' => false,
            'screenshots' => [],
        ],

        [
            'slug' => 'private-logistics-app',
            'category' => 'logistics',
            'year' => 2025,
            'status' => 'in-development',
            'technologies' => [
                'Flutter',
                'Dart',
                'BLoC',
                'REST APIs',
            ],
            'image' => null,
            'is_featured' => false,
            'is_public' => false,
            'is_confidential' => true,
            'screenshots' => [],
        ],

        [
            'slug' => 'internal-tool-nda',
            'category' => 'internal-tools',
            'year' => 2024,
            'status' => 'completed',
            'technologies' => [
                'Flutter',
                'Dart',
            ],
            'image' => null,
            'is_featured' => false,
            'is_public' => false,
            'is_confidential' => true,
            'screenshots' => [],
        ],
    ],

    /*
     * Structural experience data.
     * Translated copy lives in lang/{locale}/experience.php.
     */
    'experience' => [
        [
            'key' => 'freelance-senior-flutter-developer',
            'period_start' => '2021',
            'period_end' => null,
            'technologies' => [
                'Flutter',
                'Dart',
                'BLoC',
                'Cubit',
                'Clean Architecture',
                'REST APIs',
                'Firebase',
                'WebSockets',
                'Payment Gateways',
            ],
        ],

        [
            'key' => 'tourstify-senior-flutter-developer',
            'period_start' => '2024',
            'period_end' => '2026',
            'technologies' => [
                'Flutter',
                'Dart',
                'BLoC',
                'Clean Architecture',
                'Firebase',
                'REST APIs',
                'Payment Integration',
            ],
        ],

        [
            'key' => 'prosys-junior-web-developer',
            'period_start' => '2023-02',
            'period_end' => '2023-04',
            'technologies' => [
                'ASP.NET',
                'SQL',
                'Web Development',
            ],
        ],

        [
            'key' => 'virtual-data-junior-web-developer',
            'period_start' => '2022-08',
            'period_end' => '2022-10',
            'technologies' => [
                'Web Development',
                'Responsive Design',
                'UI Development',
            ],
        ],
    ],

    /*
     * Skill names remain untranslated.
     * Group labels are resolved from lang/{locale}/skills.php.
     */
    'skills' => [
        [
            'key' => 'mobile',
            'skills' => [
                'Flutter',
                'Dart',
                'Responsive UI',
                'Cross-Platform Mobile Development',
                'iOS',
                'Android',
            ],
        ],

        [
            'key' => 'architecture',
            'skills' => [
                'Clean Architecture',
                'BLoC',
                'Cubit',
                'GetX',
                'Dependency Injection',
                'SOLID Principles',
                'Design Patterns',
            ],
        ],

        [
            'key' => 'backend',
            'skills' => [
                'REST APIs',
                'WebSockets',
                'Firebase Authentication',
                'Firebase Firestore',
                'Firebase Cloud Functions',
                'Firebase Notifications',
                'Payment Gateways',
                'Google Maps APIs',
            ],
        ],

        [
            'key' => 'data',
            'skills' => [
                'SQL',
                'Relational Databases',
                'Database / Schema Design',
                'Firebase Firestore',
                'Data Modeling Fundamentals',
            ],
        ],

        [
            'key' => 'engineering',
            'skills' => [
                'Performance Optimization',
                'Responsive Design',
                'Production Deployment',
                'API Integration',
                'Debugging',
                'Code Maintainability',
                'Scalable Architecture',
            ],
        ],

        [
            'key' => 'tools',
            'skills' => [
                'Git',
                'GitHub',
                'Postman',
                'Android Studio',
                'VS Code',
                'Figma',
                'Agile Methodology',
            ],
        ],
    ],

    /*
     * Service copy lives in lang/{locale}/services.php.
     */
    'services' => [
        [
            'key' => 'flutter-development',
            'icon' => 'smartphone',
        ],

        [
            'key' => 'application-architecture',
            'icon' => 'blueprint',
        ],

        [
            'key' => 'api-integration',
            'icon' => 'plug',
        ],

        [
            'key' => 'realtime-features',
            'icon' => 'radio',
        ],

        [
            'key' => 'payment-integration',
            'icon' => 'credit-card',
        ],

        [
            'key' => 'performance-optimization',
            'icon' => 'gauge',
        ],

        [
            'key' => 'legacy-improvement',
            'icon' => 'refresh',
        ],

        [
            'key' => 'production-deployment',
            'icon' => 'rocket',
        ],

        [
            'key' => 'web-development',
            'icon' => 'globe',
        ],
    ],
];