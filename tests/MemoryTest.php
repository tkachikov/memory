<?php
declare(strict_types=1);

use Tkachikov\Memory\Memory;
use PHPUnit\Framework\TestCase;

final class MemoryTest extends TestCase
{
    public Memory $service;

    /**
     * @return array
     */
    public static function memories(): array
    {
        return [
            [1, '1 B'],
            [2048.0, '2 KB'],
            [3145728, '3 MB'],
            [4294967296.0, '4 GB'],
        ];
    }

    /**
     * @description testing view when set value in constructor
     *
     * @dataProvider memories
     *
     * @param float|int $memory
     * @param string    $view
     *
     * @return void
     */
    public function testShowMemoryInConstructor(float|int $memory, string $view): void
    {
        $this->assertSame((new Memory($memory))->show(), $view);
    }

    /**
     * @description testing view in use fluent method for set value
     *
     * @dataProvider memories
     *
     * @param float|int $memory
     * @param string    $view
     *
     * @return void
     */
    public function testShowMemoryFromFluentMethod(float|int $memory, string $view): void
    {
        $this->assertSame($this->memory->size($memory)->show(), $view);
    }

    /**
     * @description testing method for view usage memory
     *
     * @return void
     */
    public function testShowUsage(): void
    {
        $this->assertTrue(is_string($this->memory->showUsage()));
    }

    /**
     * @description testing method for view peak memory
     *
     * @return void
     */
    public function testShowPeak(): void
    {
        $this->assertTrue(is_string($this->memory->showPeak()));
    }

    /**
     * @description testing method for reset peak memory
     *
     * @return void
     */
    public function testReset(): void
    {
        $function = 'memory_reset_peak_usage';
        if (!function_exists($function)) {
            $this->markTestSkipped();
        } else {
            $i = 0;
            while ($i < pow(10, 5)) {
                $arr[] = $i++;
            }
            $lastMemory = $this->memory->showPeak();
            $this->memory->reset();
            $this->assertNotSame($lastMemory, $this->memory->showPeak());
        }
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->memory = new Memory();
    }
}