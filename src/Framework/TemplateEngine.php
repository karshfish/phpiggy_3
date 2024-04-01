<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    private array $globalTemplateData = [];
    public function __construct(private string $basePath) //this property is for identifying the template tha we are gonna use
    {
    }
    public function render(string $template, array $data = []) /*template variable identifies what page the controller will use for the url path.
                                                                the array data is to pass data into the template page  */
    {
        extract($data, EXTR_SKIP);  //Extract array data into variable that we can use separately
        extract($this->globalTemplateData, EXTR_SKIP);
        include $this->resolve($template); // including the full path of the template page
    }
    public function resolve(string $path)
    {
        return "{$this->basePath}/{$path}";
    }

    public function addGlobal(string $key, mixed $value)
    {
        $this->globalTemplateData[$key] = $value;
    }
}
