<?php

namespace ComposerGUI;

use \InvalidArgumentException;
use \LogicException;

class ComposerGUI {

    protected $configurations         = [];
    protected $configurationDefaults  = ['composer_path' => '/usr/bin/composer'];
    protected $configurationsAllowed  = ['composer_path', 'password'];

    public function __construct($configurations = [])
    {
        if (empty($configurations)) {
            throw new InvalidArgumentException(sprintf('Empty ComposerGUI Configurations'));
        }

        // Throw an exception if has incorrect values
        $this->isConfigurationsValid($configurations);

        // Throw an exception if required configuration is empty, and override defaults
        $configurations = $this->overrideDefaults($configurations);

        $this->setConfigurations($configurations);
    }

    protected function isConfigurationsValid(array $configurations)
    {
        foreach ($configurations as $configuration => $value) {
            if (in_array($configuration, $this->configurationsAllowed) === false) {
                throw new InvalidArgumentException(sprintf('There is no existing configuration key for "%s"', $configuration));
            }
        }
    }

    protected function overrideDefaults(array $configurations)
    {
        foreach ($this->configurationsAllowed as $configuration) {
            if (isset($configurations[$configuration]) && !empty($configurations[$configuration])) {
                continue;
            }

            if (isset($this->configurationDefaults[$configuration])) {
                $configurations[$configuration] = $this->configurationDefaults[$configuration];
                continue;
            }

            throw new InvalidArgumentException(sprintf('Configuration key "%s" required.', $configuration));
        }

        return $configurations;
    }

    public function boot()
    {
        // Boot Composer GUI
    }

    public function setConfigurations(array $configurations)
    {
        $this->configurations = $configurations;
    }

    public function getConfigurations()
    {
        return $this->configurations;
    }

}
