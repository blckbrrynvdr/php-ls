<?php
namespace Base;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private $templatePath;
    private $data;
    private $twig;

    public function __construct()
    {

    }

    public function setTemplatePath(string $path)
    {
        $this->templatePath = $path;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function render(string $tpl, $data = []): string
    {

        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
        ob_start();
        include $this->templatePath . '/' . $tpl;
        $data = ob_get_clean();
        return $data;
    }

    public function renderTwig($tpl, $data = [])
    {
        if (!$this->twig) {
            $loader = new FilesystemLoader($this->templatePath);
            $this->twig = new Environment($loader);
        }

        return $this->twig->render($tpl, $data);
    }

}