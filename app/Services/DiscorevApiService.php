<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Client\Response;

class DiscorevApiService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('DISCOREV_API_URL', 'http://localhost:3000');
    }
    public function get(string $endpoint, array $params = [])
    {
        return $this->withAutoRefresh(function () use ($endpoint, $params) {
            return Http::withToken(Session::get('access_token'))
                ->get("{$this->baseUrl}/{$endpoint}", $params);
        });
    }

    public function post(string $endpoint, array $data)
    {
        return $this->withAutoRefresh(function () use ($endpoint, $data) {
            return Http::withToken(Session::get('access_token'))
                ->post("{$this->baseUrl}/{$endpoint}", $data);
        });
    }

    public function put(string $endpoint, array $data)
    {
        return $this->withAutoRefresh(function () use ($endpoint, $data) {
            return Http::withToken(Session::get('access_token'))
                ->put("{$this->baseUrl}/{$endpoint}", $data);
        });
    }

    public function delete(string $endpoint)
    {
        return $this->withAutoRefresh(function () use ($endpoint) {
            return Http::withToken(Session::get('access_token'))
                ->delete("{$this->baseUrl}/{$endpoint}");
        });
    }


    /**
     * Rafraîche automatiquement le token si expiré.
     */
    protected function withAutoRefresh(callable $requestCallback): Response
    {
        $response = $requestCallback();

        if ($response->status() === 401 && $this->refreshToken()) {
            // Réessaie la requête après refresh
            return $requestCallback();
        }

        return $response;
    }

    /**
     * Appelle /refresh-token pour obtenir un nouveau accessToken
     */
    protected function refreshToken(): bool
    {
        $refresh = Http::withCookies(request()->cookies->all(), parse_url($this->baseUrl)['host'])
            ->post("{$this->baseUrl}/auth/refresh-token");

        if ($refresh->successful()) {
            $newToken = $refresh['accessToken'] ?? null;
            if ($newToken) {
                Session::put('access_token', $newToken);
                return true;
            }
        }

        // Le refresh a échoué : déconnexion ?
        Session::forget('access_token');
        return false;
    }
}
