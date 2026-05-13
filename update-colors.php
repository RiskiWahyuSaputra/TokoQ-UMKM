#!/usr/bin/env php
<?php

$files = [
    '/mnt/c/xampp/htdocs/TokoQ-UMKM/resources/views/owner/ai/index.blade.php',
    '/mnt/c/xampp/htdocs/TokoQ-UMKM/resources/views/owner/inventory/create.blade.php',
    '/mnt/c/xampp/htdocs/TokoQ-UMKM/resources/views/owner/inventory/edit.blade.php',
    '/mnt/c/xampp/htdocs/TokoQ-UMKM/resources/views/owner/inventory/index.blade.php',
    '/mnt/c/xampp/htdocs/TokoQ-UMKM/resources/views/owner/pos/index.blade.php',
    '/mnt/c/xampp/htdocs/TokoQ-UMKM/resources/views/owner/reports/index.blade.php',
    '/mnt/c/xampp/htdocs/TokoQ-UMKM/resources/views/owner/sales/index.blade.php',
    '/mnt/c/xampp/htdocs/TokoQ-UMKM/resources/views/owner/settings/index.blade.php',
];

$newConfig = '<link href="/css/tokoq-colors.css" rel="stylesheet"/>
<script src="/js/tailwind-config.js"></script>';

foreach ($files as $file) {
    if (!file_exists($file)) {
        echo "File not found: $file\n";
        continue;
    }
    
    $content = file_get_contents($file);
    
    // Replace tailwind config
    $pattern = '/<script id="tailwind-config">.*?<\/script>/s';
    $content = preg_replace($pattern, $newConfig, $content);
    
    // Replace old color references
    $colorReplacements = [
        // Primary colors
        '#40521d' => '#10B981',
        '#576b33' => '#10B981',
        '#51652e' => '#10B981',
        '#d3eba6' => '#34D399',
        '#d3eba5' => '#34D399',
        
        // Background colors
        '#f8fbea' => '#ECFDF5',
        '#edefdf' => '#ffffff',
        '#e1e4d4' => '#F3F4F6',
        
        // Text colors
        '#191d13' => '#374151',
        '#45483d' => '#374151',
        
        // Border colors
        '#c5c8b9' => '#D1D5DB',
        '#dde3d2' => '#D1D5DB',
        
        // Classes
        'bg-background' => 'bg-secondary',
        'text-on-background' => 'text-text',
        'bg-surface' => 'bg-surface',
        'text-on-surface' => 'text-text',
        'bg-primary-container' => 'bg-primary',
        'text-primary-container' => 'text-primary',
    ];
    
    foreach ($colorReplacements as $old => $new) {
        $content = str_replace($old, $new, $content);
    }
    
    file_put_contents($file, $content);
    echo "Updated: $file\n";
}

echo "\nAll files updated successfully!\n";
