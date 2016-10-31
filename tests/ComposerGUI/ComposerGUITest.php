<?php

class ComposerGUITest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testNotSendAnyParameter()
    {
        $composerGUI = new ComposerGUI\ComposerGUI();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSendAnInvalidConfigurationKey()
    {
        $configurations = [
            'invalid' => 'value'
        ];

        $composerGUI = new ComposerGUI\ComposerGUI($configurations);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSendMissingParameter()
    {
        $configurations = [
            'composer_path' => 'testpath'
        ];

        $composerGUI = new ComposerGUI\ComposerGUI($configurations);
    }

    public function testSuccessfullyInitiate()
    {
        $configurations = [
            'password' => 'secret'
        ];

        $composerGUI = new ComposerGUI\ComposerGUI($configurations);

        $actualConfigurations = $composerGUI->getConfigurations();

        // correctly override with defaults
        $this->assertEquals($actualConfigurations['composer_path'], '/usr/bin/composer');
        $this->assertEquals($actualConfigurations['password'], $configurations['password']);
    }
}