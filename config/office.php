<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Office Application Name
    |--------------------------------------------------------------------------
    |
    | Used dynamically for the navbar application branding and browser/page title.
    |
    */

    'app_name' => env('OFFICE_APP_NAME', env('APP_NAME', 'ASTGD Task Tracker')),

    /*
    |--------------------------------------------------------------------------
    | Company Name
    |--------------------------------------------------------------------------
    |
    | Used dynamically for dashboard headings, footer, and company info sections.
    |
    */

    'company_name' => env('COMPANY_NAME', 'ASTGD'),

    /*
    |--------------------------------------------------------------------------
    | Company Email
    |--------------------------------------------------------------------------
    |
    | Used dynamically for footer, about section, and contact information.
    |
    */

    'company_email' => env('COMPANY_EMAIL', 'office@example.com'),

    /*
    |--------------------------------------------------------------------------
    | Tasks Per Page
    |--------------------------------------------------------------------------
    |
    | Controls task-list pagination dynamically.
    |
    */

    'tasks_per_page' => (int) env('TASKS_PER_PAGE', 10),

    /*
    |--------------------------------------------------------------------------
    | Enable Task Export Feature Toggle
    |--------------------------------------------------------------------------
    |
    | Controls whether users can export tasks to CSV/JSON format.
    |
    */

    'enable_task_export' => filter_var(env('ENABLE_TASK_EXPORT', true), FILTER_VALIDATE_BOOLEAN),

];
