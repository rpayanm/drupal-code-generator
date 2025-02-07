<?php declare(strict_types = 1);

namespace DrupalCodeGenerator\Tests\Generator\Drush;

use DrupalCodeGenerator\Command\Drush\Generator;
use DrupalCodeGenerator\Test\Functional\GeneratorTestBase;

/**
 * Tests drush:generator generator.
 */
final class GeneratorTest extends GeneratorTestBase {

  protected string $fixtureDir = __DIR__ . '/_generator';

  /**
   * Test callback.
   */
  public function testGenerator(): void {

    $input = [
      'example',
      'Example',
      'example:foo-bar',
      'Example generator.',
      'FooBarGenerator',
      'example',
      'example',
    ];
    $this->execute(Generator::class, $input);

    $expected_display = <<< 'TXT'

     Welcome to generator generator!
    –––––––––––––––––––––––––––––––––

     Module machine name:
     ➤ 

     Module name [Example]:
     ➤ 

     Generator name [example:example]:
     ➤ 

     Generator description:
     ➤ 

     Class [FooBar]:
     ➤ 

     The following directories and files have been created or updated:
    –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
     • drush.services.yml
     • example.info.yml
     • src/Generator/FooBarGenerator.php
     • templates/generator/foo-bar.twig

    TXT;
    $this->assertDisplay($expected_display);

    $this->assertGeneratedFile('drush.services.yml');
    $this->assertGeneratedFile('example.info.yml');
    $this->assertGeneratedFile('src/Generator/FooBarGenerator.php');
    $this->assertGeneratedFile('templates/generator/foo-bar.twig');
  }

}
