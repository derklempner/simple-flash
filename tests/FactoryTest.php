<?php

use Tamtamchik\SimpleFlash\Templates;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'BadTemplate.php';

class FactoryTest extends TestCase
{
    private $templates = [];

    /**
     * Prepare setup before tests.
     * @throws ReflectionException
     */
    public function setUp()
    {
        $templatesReflection = new ReflectionClass('Tamtamchik\\SimpleFlash\\Templates');
        $this->templates     = $templatesReflection->getConstants();
    }

    /**
     * Base create function.
     *
     * @param $name
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    private function _testTemplate($name)
    {
        $template = \Tamtamchik\SimpleFlash\TemplateFactory::create($name);

        $flash = new \Tamtamchik\SimpleFlash\Flash();

        $flash->setTemplate($template);

        $msg  = $template->wrapMessage('Testing templates');
        $text = $template->wrapMessages($msg, 'info');

        $content = $flash->info('Testing templates')->display();

        $this->assertContains($text, $content);

        unset($flash);
    }

    /** @test
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    public function testTemplates()
    {
        foreach ($this->templates as $template) {
            $this->_testTemplate($template);
        }
        $this->_testTemplate(Templates::BASE);
    }

    /** @test
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    public function testDefaultTemplate()
    {
        $template = \Tamtamchik\SimpleFlash\TemplateFactory::create();
        $this->assertEquals('Tamtamchik\SimpleFlash\Templates\BootstrapTemplate', get_class($template));
    }

    /** @test
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    public function testBootstrapTemplate()
    {
        $template = \Tamtamchik\SimpleFlash\TemplateFactory::create(Templates::BOOTSTRAP);
        $this->assertEquals('Tamtamchik\SimpleFlash\Templates\BootstrapTemplate', get_class($template));
    }

    /** @test
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    public function testFoundationTemplate()
    {
        $template = \Tamtamchik\SimpleFlash\TemplateFactory::create(Templates::FOUNDATION);
        $this->assertEquals('Tamtamchik\SimpleFlash\Templates\FoundationTemplate', get_class($template));
    }

    /** @test
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    public function testSemanticTemplate()
    {
        $template = \Tamtamchik\SimpleFlash\TemplateFactory::create(Templates::SEMANTIC);
        $this->assertEquals('Tamtamchik\SimpleFlash\Templates\SemanticTemplate', get_class($template));
    }

    /** @test
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    public function testUiKitTemplate()
    {
        $template = \Tamtamchik\SimpleFlash\TemplateFactory::create(Templates::UIKIT);
        $this->assertEquals('Tamtamchik\SimpleFlash\Templates\UikitTemplate', get_class($template));
    }

    /** @test
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    public function testSiimpleTemplate()
    {
        $template = \Tamtamchik\SimpleFlash\TemplateFactory::create(Templates::SIIMPLE);
        $this->assertEquals('Tamtamchik\SimpleFlash\Templates\SiimpleTemplate', get_class($template));
    }

    /** @test
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    public function testBulmaTemplate()
    {
        $template = \Tamtamchik\SimpleFlash\TemplateFactory::create(Templates::BULMA);
        $this->assertEquals('Tamtamchik\SimpleFlash\Templates\BulmaTemplate', get_class($template));
    }

    /** @test
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    public function testMaterializeTemplate()
    {
        $template = \Tamtamchik\SimpleFlash\TemplateFactory::create(Templates::MATERIALIZE);
        $this->assertEquals('Tamtamchik\SimpleFlash\Templates\MaterializeTemplate', get_class($template));
    }

    /** @test
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    public function testSpectreTemplate()
    {
        $template = \Tamtamchik\SimpleFlash\TemplateFactory::create(Templates::SPECTRE);
        $this->assertEquals('Tamtamchik\SimpleFlash\Templates\SpectreTemplate', get_class($template));
    }

    /** @test
     * @throws \Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException
     */
    public function testTailwindTemplate()
    {
        $template = \Tamtamchik\SimpleFlash\TemplateFactory::create(Templates::TAILWIND);
        $this->assertEquals('Tamtamchik\SimpleFlash\Templates\TailwindTemplate', get_class($template));
    }

    /** @test */
    public function testNotFoundTemplate()
    {
        try {
            \Tamtamchik\SimpleFlash\TemplateFactory::create('ABCTemplate');
        } catch (\Tamtamchik\SimpleFlash\Exceptions\FlashTemplateNotFoundException $e) {
            $this->assertContains('Template "ABCTemplate" not found!', $e->getMessage());
        }
    }
}
