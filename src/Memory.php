<?php
declare(strict_types=1);

namespace Tkachikov\Memory;

class Memory
{
    protected float $size;

    protected float $preparedSize;

    protected int $pow;

    protected array $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PT'];

    public function __construct(null|float|int $size = null)
    {
        if ($size) {
            $this->size($size);
        }
    }

    /**
     * @param float|int $size
     *
     * @return $this
     */
    public function size(float|int $size): self
    {
        $this->size = (float) $size;
        $this->initPow();
        $this->initPreparedSize();

        return $this;
    }

    /**
     * @return string
     */
    public function show(): string
    {
        return "$this->preparedSize {$this->units[$this->pow]}";
    }

    /**
     * @return string
     */
    public function showUsage(): string
    {
        return $this->showMemory();
    }

    /**
     * @return string
     */
    public function showPeak(): string
    {
        return $this->showMemory('peak_');
    }

    /**
     * @return void
     */
    public function reset(): void
    {
        $function = 'memory_reset_peak_usage';
        if (function_exists($function)) {
            $function();
        }
    }

    /**
     * @return void
     */
    protected function initPow(): void
    {
        $this->pow = (int) floor(log($this->size, 1024));
    }

    /**
     * @return void
     */
    protected function initPreparedSize(): void
    {
        $this->preparedSize = round($this->size / pow(1024, $this->pow));
    }

    /**
     * @param string $prefix
     *
     * @return string
     */
    protected function showMemory(string $prefix = ''): string
    {
        $method = "memory_get_{$prefix}usage";
        $this->size($method(true));

        return $this->show();
    }
}