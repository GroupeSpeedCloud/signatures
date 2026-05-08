<?php

namespace App\Services;

use Google\Client;
use Google\Service\Oauth2;
use Exception;

/**
 * Service d'authentification Google OAuth
 */
class AuthService
{
    private Client $client;
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = new Client();
        $this->client->setClientId($config['client_id']);
        $this->client->setClientSecret($config['client_secret']);
        $this->client->setRedirectUri($config['redirect_uri']);
        $this->client->addScope('email');
        $this->client->addScope('profile');
        $this->client->setHostedDomain($config['hosted_domain']);
    }

    /**
     * Génère l'URL d'authentification Google
     */
    public function getAuthUrl(): string
    {
        return $this->client->createAuthUrl();
    }

    /**
     * Échange le code d'autorisation contre un token
     * et retourne les informations utilisateur
     */
    public function authenticate(string $code): array
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
        
        if (isset($token['error'])) {
            throw new Exception($token['error_description'] ?? $token['error']);
        }
        
        $this->client->setAccessToken($token);
        
        // Récupérer les infos utilisateur
        $oauth2 = new Oauth2($this->client);
        $userInfo = $oauth2->userinfo->get();
        
        // Vérifier le domaine
        if (!str_ends_with($userInfo->email, '@' . $this->config['hosted_domain'])) {
            throw new Exception('Accès réservé aux emails @' . $this->config['hosted_domain']);
        }
        
        // Parser le nom
        $nameParts = explode(' ', $userInfo->name, 2);
        
        return [
            'email' => $userInfo->email,
            'name' => $userInfo->name,
            'firstName' => $nameParts[0] ?? '',
            'lastName' => $nameParts[1] ?? '',
            'picture' => $userInfo->picture,
            'token' => $token,
            'token_created' => time(),
        ];
    }

    /**
     * Vérifie si le token est encore valide
     */
    public function isTokenValid(array $user): bool
    {
        if (!isset($user['token']['expires_in'])) {
            return false;
        }
        
        $tokenCreated = $user['token_created'] ?? 0;
        $expiresIn = $user['token']['expires_in'];
        
        // Token expire dans moins de 5 minutes
        return time() < ($tokenCreated + $expiresIn - 300);
    }
}
