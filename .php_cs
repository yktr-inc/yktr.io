<?php

$finder = PhpCsFixer\Finder::create()
    ->in('./src');

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        'array_indentation' => true,
        'indentation_type' => true,
        'align_multiline_comment' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setIndent("\t")
    ->setLineEnding("\r\n")
    ->setFinder($finder);