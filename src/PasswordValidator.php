<?php
declare(strict_types=1);

namespace Averay\PasswordValidator;

readonly class PasswordValidator implements PasswordValidatorInterface
{
  /**
   * @param string $algorithm A password algorithm constant.
   * @param array<string, string|int> $options Options for the provided algorithm.
   * @see https://secure.php.net/manual/en/password.constants.php
   */
  public function __construct(private string $algorithm = \PASSWORD_DEFAULT, private array $options = [])
  {
  }

  public function hash(#[\SensitiveParameter] string $cleartext): string
  {
    return password_hash($cleartext, $this->algorithm, $this->options);
  }

  public function verify(#[\SensitiveParameter] string $cleartext, #[\SensitiveParameter] string $hash): bool
  {
    return password_verify($cleartext, $hash);
  }
}
