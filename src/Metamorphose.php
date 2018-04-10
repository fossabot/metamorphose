<?php

namespace PowerDataHub\Metamorphose;

class Metamorphose
{
    /**
     * @var array
     */
    protected $defaultTransformers = [];

    /**
     * @var
     */
    protected $sourcesTransformers = [];

    protected $source;

    public function transform($data, $source = null, $configs = [])
    {
        if ($source !== null) {
            $this->setSource($source);
        }

        return TransformPipeline::create(
            $data,
            $this->source,
            [
                'default' => $this->defaultTransformers,
                'sourcerTransformers' => $this->sourcesTransformers,
            ]
        )->run();
    }

    /**
     * @param $source
     *
     * @return $this
     */
    public function source(string $source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @param array $transformers
     *
     * @return $this
     */
    public function with(array $transformers)
    {
        $this->defaultTransformers = $transformers;

        return $this;
    }
}