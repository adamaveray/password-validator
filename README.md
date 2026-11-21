**This repository has been migrated to Codeberg: [codeberg.org/adamaveray/password-validator](https://codeberg.org/adamaveray/password-validator)**

---

# Password Validator

An object-oriented wrapper around the PHP `password_hash` & `password_verify` functions, including an interface for abstraction.

## Usage

```php
<?php
$passwordValidator = new \Averay\PasswordValidator\PasswordValidator();

$hash = $passwordValidator->hash('secret value');

if ($passwordValidator->verify('secret value', $hash)) {
  echo '✅ Correct';
} else {
  echo '❌ Incorrect';
}
```

The algorithm may be customised during instantiation:

```php
<?php
$passwordValidator = new \Averay\PasswordValidator\PasswordValidator(
  \PASSWORD_ARGON2I,
  ['memory_cost' => 2 ^ 32, 'time_cost' => 10],
);
```
