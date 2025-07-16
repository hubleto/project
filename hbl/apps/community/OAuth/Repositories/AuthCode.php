<?php

namespace HubletoApp\Community\OAuth\Repositories;

use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use HubletoApp\Community\OAuth\Entities\AuthCodeEntity;

class AuthCode implements AuthCodeRepositoryInterface
{

  public \HubletoMain $main;

  public function __construct(\HubletoMain $main)
  {
    $this->main = $main;
  }

  public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity): void
  {

    $dbData = [
      'code_id' => $authCodeEntity->getIdentifier(),
      'expires_at' => $authCodeEntity->getExpiryDateTime(),
      'user_id' => $authCodeEntity->getUserIdentifier(), // Can be null if no user is involved (e.g., client credentials)
      'client_id' => $authCodeEntity->getClient()->getIdentifier(),
      'scopes' => json_encode(array_map(fn($scope) => $scope->getIdentifier(), $authCodeEntity->getScopes())),
      // 'code_challenge' => $authorizationRequest->getCodeChallenge(),
      // 'code_challenge_method' => $authorizationRequest->getCodeChallengeMethod(),
      // Add any other fields you need, like redirect_uri
      'redirect_uri' => $authCodeEntity->getRedirectUri(), // Important for validating token exchange
      'revoked' => false,
    ];

    $mAuthCode = new \HubletoApp\Community\OAuth\Models\AuthCode($this->main);
    $mAuthCode->record->recordCreate($dbData);
  }

  public function revokeAuthCode($codeId): void
  {
    $mAuthCode = new \HubletoApp\Community\OAuth\Models\AuthCode($this->main);
    $mAuthCode->record->where('code', $codeId)->update(['revoked' => true]);
  }

  public function isAuthCodeRevoked($codeId): bool
  {
    $mAuthCode = new \HubletoApp\Community\OAuth\Models\AuthCode($this->main);
    $authCode = $mAuthCode->record->find($codeId);
    return $authCode && $authCode->revoked;
  }

  public function getNewAuthCode(): AuthCodeEntityInterface
  {
    return new AuthCodeEntity();
  }

}
