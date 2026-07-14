<?php

namespace App\Support;

class ContentCategories
{
    public static function services(): array
    {
        return [
            'Tax' => 'Tax',
            'Audit' => 'Audit',
            'Accounting' => 'Accounting',
            'Advisory' => 'Advisory',
            'Compliance' => 'Compliance',
            'Registration' => 'Registration',
        ];
    }

    public static function posts(): array
    {
        return [
            'Tax Tips' => 'Tax Tips',
            'Compliance' => 'Compliance',
            'Business Advice' => 'Business Advice',
            'Firm News' => 'Firm News',
        ];
    }

    public static function faqs(): array
    {
        return [
            'General' => 'General',
            'Tax' => 'Tax',
            'Audit' => 'Audit',
            'Pricing' => 'Pricing',
            'Engagement' => 'Engagement',
        ];
    }
}
