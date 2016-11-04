<?php

namespace BrianFaust\Settings\Store;

use Illuminate\Filesystem\Filesystem;
use BrianFaust\Cerealizer\Contracts\Serialiser;
use BrianFaust\Cerealizer\Contracts\Unserialiser;

abstract class FileStore extends Store
{
    protected $files;

    private $serialiser;

    private $unserialiser;

    public function __construct(Filesystem $files, Serialiser $serialiser, Unserialiser $unserialiser, $path)
    {
        $this->files = $files;
        $this->serialiser = $serialiser;
        $this->unserialiser = $unserialiser;
        $this->setPath($path);
    }

    protected function read()
    {
        return $this->unserialiser->unserialise($this->files->get($this->path));
    }

    protected function write(array $data)
    {
        return $this->files->put($this->path, $this->serialiser->serialise($data));
    }

    private function setPath($path)
    {
        if (!$this->files->exists($path)) {
            $result = $this->files->put($path, '');

            if ($result === false) {
                throw new NotWriteableException("Could not write to $path.");
            }
        }

        if (!$this->files->isWritable($path)) {
            throw new NotWriteableException("$path is not writable.");
        }

        $this->path = $path;
    }
}