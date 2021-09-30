<?php

/**
 * Wrapper class for the Smarty PHP engine, allows for using the engine in the app while having the app be independant of this particular engine and being dependant only on the wrapper's interface
 */

 namespace Framework\Classes;
 use Framework\Interfaces\TemplateRendering;
 use Framework\Traits\TemplateHelpers;
 use Smarty;

 class SmartyRenderer implements TemplateRendering
 {
    use TemplateHelpers;

    protected Smarty $smartyInstance;
    protected $template;
     public function __construct()
     {
         $this->smartyInstance = new Smarty();
         $this->smartyInstance->setCompileDir($this->getCompiledTemplateDirectory(Config::getConfig('app')));
         $this->smartyInstance->caching = false;
     }

     public static function getRenderer()
     {
         return new SmartyRenderer();
     }


     public function assignVariables(array $variables)
     {
         if (is_array($variables))
         {
            foreach ($variables as $name=>$value){
                $this->smartyInstance->assign($name, $value);
            }
         }
     }

     public function renderAndDisplayTemplate(array $variables, string $template)
     {
         $this->assignVariables($variables);
         $this->smartyInstance->display($template);
     }

     public function getRenderedTemplateString(array $variables, string $template)
     {
         $this->assignVariables($variables);
         return $this->smartyInstance->fetch($template);
     }
 }