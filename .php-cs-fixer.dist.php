<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('vendor')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@PSR12' => true,
        '@DoctrineAnnotation' => true,
        '@PHP80Migration' => true,
        'array_syntax' => ['syntax' => 'short'],
        'array_indentation' => true,
        'blank_line_after_opening_tag' => true,
        'declare_strict_types' => true,
        'concat_space' => ['spacing' => 'one'],
        'multiline_whitespace_before_semicolons' => true,
        'method_chaining_indentation' => true,
        'no_superfluous_elseif' => true,
        'no_superfluous_phpdoc_tags' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'void_return' => true,
    ])
    ->setFinder($finder)
    ->setUsingCache(true)
    ->setRiskyAllowed(true)
    ;
