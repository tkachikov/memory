# memory

[![Memory release: 1.2](https://img.shields.io/badge/packagist-1.2-00B2EE.svg)](https://packagist.org/packages/tkachikov/memory)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

This package need to convert bytes to view. Exmaple: 4194304 => 4 MB

## Installation
```sh
composer require tkachikov/memory
```

## Usage
```sh
// Create class
$memory = new Memory();

// Example memory usage: 2 MB
$usage = $memory->showUsage();

// Exmaple memory peak: 4 MB
$peak = $memory->showPeak();

// Get custom view memory
$customMemory = (new Memory()) // or in Laravel app(Memory::class)
  ->size(memory_get_usage(true))
  ->show();

// Reset peak memory (work on php 8.2)
$memory->reset();
```

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
