<?php

$baseDir = __DIR__;

$level = Symfony\CS\FixerInterface::PSR2_LEVEL;

$fixers = [
    'array_element_no_space_before_comma',
    'array_element_white_space_after_comma',
    'blankline_after_open_tag',
    'extra_empty_lines',
    'new_with_braces',
    'no_blank_lines_after_class_opening',
    'operators_spaces',
    'ordered_use',
    'remove_lines_between_uses',
    'short_array_syntax',
    'single_array_no_trailing_comma',
    'single_blank_line_before_namespace',
    'ternary_spaces',
    'unused_use'
];

$finder = Symfony\Component\Finder\Finder::create()
    ->files()
    ->in("{$baseDir}/src")
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
    ->exclude('vendor');

return Symfony\CS\Config\Config::create()
    ->finder($finder)
    ->level($level)
    ->fixers($fixers);
