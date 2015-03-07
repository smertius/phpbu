<?php
namespace phpbu\App\Backup;

/**
 * Compressor test
 *
 * @package    phpbu
 * @subpackage tests
 * @author     Sebastian Feldmann <sebastian@phpbu.de>
 * @copyright  Sebastian Feldmann <sebastian@phpbu.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpbu.de/
 * @since      Class available since Release 1.0.0
 */
class CompressorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Compressor::create
     *
     * @expectedException \phpbu\App\Exception
     */
    public function testCreateInvalid()
    {
        Compressor::create('/foo/bar');
        $this->assertFalse(true, 'Exception should be thrown');
    }

    /**
     * Test gzip compressor
     */
    public function testGzip()
    {
        $gzip = Compressor::create('gzip');
        $this->assertEquals('gz', $gzip->getSuffix());
        $this->assertEquals('gzip', $gzip->getCommand());
        $this->assertEquals('application/x-gzip', $gzip->getMimeType());
    }

    /**
     * Test bzip2 compressor
     */
    public function testBzip2()
    {
        $gzip = Compressor::create('bzip2');
        $this->assertEquals('bz2', $gzip->getSuffix());
        $this->assertEquals('bzip2', $gzip->getCommand());
        $this->assertEquals('application/x-bzip2', $gzip->getMimeType());
    }

    /**
     * Test zip compressor
     */
    public function testZip()
    {
        $gzip = Compressor::create('zip');
        $this->assertEquals('zip', $gzip->getSuffix());
        $this->assertEquals('zip', $gzip->getCommand());
        $this->assertEquals('application/zip', $gzip->getMimeType());
    }

    /**
     * Tets compressor with path to binary
     */
    public function testGzipWithPath()
    {
        $gzip = Compressor::create('/usr/local/bin/gzip');
        $this->assertEquals('gz', $gzip->getSuffix());
        $this->assertEquals('/usr/local/bin/gzip', $gzip->getCommand());
    }

    /**
     * Tests Compressor::getExec
     */
    public function testGetExec()
    {
        $zip = Compressor::create('zip');
        $exec = $zip->getExec(__FILE__, array('-f'));
        $this->assertEquals('zip -f \'' . __FILE__ . '\'', $exec->getExec());
    }
}
