<?php
declare(strict_types=1);

function services(): array
{
    return [
        [
            'slug' => 'data-management',
            'title' => 'Data Management',
            'accent' => '#B4D33D',
            'items' => [
                'Data Architecture and Engineering',
                'Data Warehousing',
                'Data Migration',
                'Data Quality',
            ],
        ],
        [
            'slug' => 'clm',
            'title' => 'Contract Lifecycle Management (CLM)',
            'accent' => '#234576',
            'items' => [
                'CLM Vendor (Product) Selection',
                'CLM Strategy',
                'CLM Readiness',
                'CLM Implementation',
                'Data Extraction & Data Migration',
                'Managed Services',
            ],
        ],
        [
            'slug' => 'analytics-ai',
            'title' => 'Analytics & AI',
            'accent' => '#B4D33D',
            'items' => [
                'Data Analytics',
                'Data Visualization',
                'AI/ML',
            ],
        ],
        [
            'slug' => 'devops',
            'title' => 'DevOps & Infrastructure',
            'accent' => '#B4D33D',
            'items' => [
                'IaaS, SaaS & PaaS',
                'Grid Computing',
                'IBM Platform Product Suite',
                'AWS, Azure, VMware',
            ],
        ],
        [
            'slug' => 'application-development',
            'title' => 'Application Development & Support',
            'accent' => '#B4D33D',
            'items' => [
                'Salesforce',
                'ServiceNow',
                'Full Stack Development',
                'Waterfall & Agile Methodologies',
            ],
        ],
        [
            'slug' => 'strategic-consulting',
            'title' => 'Strategic Consulting',
            'accent' => '#B4D33D',
            'items' => [
                'Enterprise Data Strategy',
                'IT Strategy',
                'Network & Storage Strategy',
                'Re-Platforming',
                'Legacy DB platform migrations (For eg., Sybase to PostgreSQL, Oracle to MySQL, etc.)',
            ],
        ],
        [
            'slug' => 'database',
            'title' => 'Database Design & Administration',
            'accent' => '#B4D33D',
            'items' => [
                'AWS RDS, AWS Aurora, PostgreSQL, ORACLE, Sybase, MS-SQL Server Administration & Support',
                'Database Design & Architecture',
                'Performance Tuning',
            ],
        ],
    ];
}

function service_by_slug(string $slug): ?array
{
    foreach (services() as $service) {
        if ($service['slug'] === $slug) {
            return $service;
        }
    }
    return null;
}

function client_logos(): array
{
    return [
        ['name' => 'SunTrust', 'file' => 'suntrust.png'],
        ['name' => 'Freddie Mac', 'file' => 'freddie-mac.png'],
        ['name' => 'The World Bank', 'file' => 'world-bank.png'],
        ['name' => 'IFC', 'file' => 'ifc.png'],
        ['name' => 'Merrill', 'file' => 'merrill.png'],
        ['name' => 'Autodesk', 'file' => 'autodesk.png'],
    ];
}

function clients(): array
{
    return [
        'Merrill',
        'FIS',
        'SunTrust',
        'Freddie Mac',
        'Booz Allen Hamilton',
        'NSF',
        'The World Bank',
        'IFC',
        'CACI',
        'Autodesk',
        'Societe Generale',
        'Citigroup',
        'Sodexo',
        'TECAN',
        'SanDisk',
        'PTC',
        'Fannie Mae',
    ];
}

function alliances(): array
{
    return [
        'Conga',
        'Agiloft',
        'Ironclad',
        'Malbek',
        'DocuSign',
        'LEAH',
        'IntelAgree',
        'Zoho Contracts',
    ];
}

function alliance_logos(): array
{
    return [
        ['name' => 'Autodesk', 'file' => 'autodesk.png'],
        ['name' => 'ServiceNow', 'file' => 'servicenow.png'],
        ['name' => 'VMware', 'file' => 'vmware.png'],
        ['name' => 'MSDN', 'file' => 'msdn.png'],
        ['name' => 'Salesforce', 'file' => 'salesforce.png'],
        ['name' => 'SAP', 'file' => 'sap.png'],
        ['name' => 'Microsoft Azure', 'file' => 'azure.png'],
        ['name' => 'Amazon Web Services', 'file' => 'aws.png'],
    ];
}

function jobs(): array
{
    return [
        [
            'slug' => 'ai-ml-developer',
            'title' => 'AI/ML Developer',
            'intro' => 'We are looking for an AI/ML Developer with the following skills and experience:',
            'location' => 'Northern Virginia (Currently Remote)',
            'sections' => [
                [
                    'heading' => 'Responsibilities',
                    'items' => [
                        'Strong development experience on emerging technologies using AI/ML services.',
                        'Experience in all phases of the software development life cycle (SDLC), including design, development, and maintenance of applications.',
                        'Prototype, develop, and analyze software.',
                        'Perform peer reviews on source code to ensure reuse, scalability, and the use of best practices.',
                        'Participate in collaborative technical discussions that focus on software design, architecture, and development as well as user experience.',
                        'Provide continuous feedback to refine current practices, promote timely software release cycles, and improve agile methods.',
                    ],
                ],
                [
                    'heading' => 'Requirements',
                    'items' => [
                        '5+ years of experience with a software development team',
                        '3+ years of experience with agile methodologies',
                        'Experience with C#',
                        'Experience with implementing RESTful APIs',
                        'Experience with Natural Language Processing or chatbot development',
                        'Knowledge of database concepts and CRUD operations',
                        'Experience with Azure Cloud Services',
                        'Experience with JavaScript',
                        'Experience with Python',
                        'Experience with mentoring junior developers',
                        'Professional experience in the AI or Data Science field',
                        'MS degree in CS or an IT related field',
                    ],
                ],
            ],
        ],
        [
            'slug' => 'enterprise-data-architect',
            'title' => 'Enterprise Data Architect',
            'intro' => 'We are looking for an Enterprise Data Architect with the following skill sets.',
            'location' => 'Northern Virginia (Currently Remote)',
            'body' => 'An enterprise data architect’s primary goal is to keep data easily accessible and accurate. To meet that goal, this architect reviews, refines and implements data standards. Examples of data standards include those that define how data is categorized or how alphanumeric codes are assigned to represent specific products, customers and other data types. After gathering information about data use in the workplace, this architect creates a blueprint or road map, showing processes and services that affect data use and data standards. The architect then works with project managers and business stakeholders to implement that design.',
            'sections' => [
                [
                    'heading' => 'Qualifications',
                    'items' => [
                        '8+ years of relevant hands-on technical experience in an enterprise environment',
                        'Preference will be given to those with strong experience in an Agile/DevOps environment.',
                        'Demonstrable senior-level expertise in Cloud Services and Solutions; Database Administration and Development; Analytical Sciences; Information Technology Governance; Information Security; Information Technology Resource Management; Business Case; Business Scenario; Business Process Design; Strategic Planning; and Business Functions.',
                    ],
                ],
            ],
        ],
        [
            'slug' => 'lead-data-scientist',
            'title' => 'Lead Data Scientist',
            'intro' => 'We are looking for a Lead Data Scientist to extract and analyze data from different types of documents. You will be working with large data sets combining structured and unstructured data. You will be building a team of Data Scientists to develop products and tools.',
            'location' => 'Northern Virginia (Currently Remote)',
            'sections' => [
                [
                    'heading' => 'Essential Duties and Responsibilities',
                    'items' => [
                        'Develop and apply the latest innovations in machine learning, artificial intelligence, and related technologies.',
                        'Lead and support research and development efforts to explore the applicability of emerging machine learning and artificial intelligence methods to address client challenges and identify and prioritize emerging methods and challenges for original research or proof of concepts.',
                        'Lead and support efforts to identify, shape, capture, and deliver data science, machine learning, and artificial intelligence contracts.',
                        'Work with clients and internal teams to build analytic strategies, technology roadmaps, implementation plans, and research initiatives.',
                        'Lead and develop a strong team of data scientists, data engineers, machine learning engineers, and artificial intelligence specialists.',
                    ],
                ],
                [
                    'heading' => 'Minimum Qualifications',
                    'items' => [
                        'Over 5 years of experience with machine learning techniques (clustering, decision tree learning, artificial neural networks, natural language processing, and similar methods) and algorithms for addressing a variety of problems.',
                        'Over 5 years of experience leading or managing delivery teams, projects, and development efforts.',
                        'Over 3 years of experience with programming, including machine learning frameworks (TensorFlow, PyTorch), Python, and Spark.',
                        'Very strong experience with distributed data and computing tools: MapReduce, Hadoop, Hive, Spark, and MySQL.',
                        'Experience with business development and client or customer relationship management.',
                        'Experience developing effective delivery or research teams, including recruiting, hiring, mentoring, coaching, and managing team members.',
                        'Ability to communicate results to both technical and non-technical audiences, including presenting to senior executives.',
                        'BA or BS degree in Statistics, Machine Learning, Mathematics, Computer Science, Computer Engineering, Industrial Engineering, or Operations Research.',
                    ],
                ],
                [
                    'heading' => 'Preferred Qualifications',
                    'items' => [
                        'MS degree in Science, Engineering, Mathematics, or a related field preferred; PhD degree a plus.',
                    ],
                ],
            ],
        ],
    ];
}

function job_by_slug(string $slug): ?array
{
    foreach (jobs() as $job) {
        if ($job['slug'] === $slug) {
            return $job;
        }
    }
    return null;
}
