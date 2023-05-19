# memory

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
$customMemory = (new Memory())
  ->size(memory_get_usage(true))
  ->show();

// Reset peak memory (work on php 8.2)
$memory->reset();
```
