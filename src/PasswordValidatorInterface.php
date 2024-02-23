<?php
declare(strict_types=1);

namespace Averay\PasswordValidator;

interface PasswordValidatorInterface
{
  /**
   * @param string $cleartext The password to hash.
   * @return string A hashed representation of the password.
   */
  public function hash(#[\SensitiveParameter] string $cleartext): string;

  /**
   * @param string $cleartext The password to verify.
   * @param string $hash The hashed representation of the original password.
   * @return bool Whether the password matches the hash.
   */
  public function verify(#[\SensitiveParameter] string $cleartext, #[\SensitiveParameter] string $hash): bool;
}
