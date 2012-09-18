<?php

namespace Drupal\DrupalExtension\Context\Initializer;

use Behat\Behat\Context\Initializer\InitializerInterface;
use Behat\Behat\Context\ContextInterface;

use Drupal\Drupal,
    Drupal\DrupalExtension\Context\DrupalContext;

class DrupalAwareInitializer implements InitializerInterface {
  private $drupal, $parameters;

  public function __construct(Drupal $drupal, array $parameters) {
    $this->drupal = $drupal;
    $this->parameters = $parameters;
    xdebug_break();
  }

  public function initialize(ContextInterface $context) {
    // Set the default driver.
    $this->drupal->setDefaultDriverName($this->parameters['default_driver']);

    // Set Drupal driver manager.
    $context->setDrupal($this->drupal);

    // Add all parameters to the context.
    $context->parameters = $this->parameters;

    // Add commonly used parameters as proper class variables.
    $context->basic_auth = $this->parameters['basic_auth'];
  }

  public function supports(ContextInterface $context) {
    // @todo Create a DrupalAwareInterface instead, so developers don't have to
    // directly extend the DrupalContext class.
    return $context instanceof DrupalContext;
  }
}
