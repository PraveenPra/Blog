@props([
    'title' => 'Default Title',
    'metaDescription' => 'Default description',
    'metaKeywords' => 'default, keywords',
    'metaAuthor' => 'Default Author',
   
])

<!-- Dynamic Title -->
<title>{{ $title }}</title>

<!-- SEO Meta Tags -->
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ $metaKeywords }}">
<meta name="author" content="{{ $metaAuthor }}">
