<?php
declare(strict_types=1);

namespace Averay\PasswordValidator\Tests;

use Averay\PasswordValidator\PasswordValidator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(PasswordValidator::class)]
final class PasswordValidatorTest extends TestCase
{
  #[DataProvider('validationDataProvider')]
  public function testValidation(PasswordValidator $validator): void
  {
    $plaintext = 'hello world';

    $hash = $validator->hash($plaintext);
    self::assertNotEquals($plaintext, $hash, 'The hash should be different to the plaintext value.');
    self::assertNotEquals($hash, $validator->hash($plaintext), 'Hashes should be different to one another.');

    self::assertTrue($validator->verify($plaintext, $hash), 'Hashes should match the plaintext value.');

    self::assertFalse(
      $validator->verify($plaintext, $hash . '!'),
      'Modified hashes should not match the plaintext value.',
    );

    self::assertFalse($validator->verify('another value', $hash), 'Hashes should not match other plaintext values.');
    self::assertFalse(
      $validator->verify($plaintext, $validator->hash('another value')),
      'Hashes should not match other plaintext values.',
    );
  }

  public static function validationDataProvider(): iterable
  {
    yield 'Default' => [
      'validator' => new PasswordValidator(),
    ];

    yield 'Custom' => [
      'validator' => new PasswordValidator(\PASSWORD_ARGON2I, [
        'memory_cost' => 2 ^ 32,
        'time_cost' => 10,
      ]),
    ];
  }
}
