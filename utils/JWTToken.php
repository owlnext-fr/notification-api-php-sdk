<?php

namespace Owlnext\NotificationAPI\utils;

use DateInterval;
use DateTime;

final class JWTToken
{
    public string $token;
    public string $refreshToken;
    public DateTime $expirationDate;
    public DateTime $refreshExpirationDate;

    public function isExpired(): bool {
        return (new DateTime()) >= $this->expirationDate;
    }

    public function isRefreshable(): bool {
        return (new DateTime()) <= $this->refreshExpirationDate;
    }

    public static function default(): self {
        $instance = new self();

        // to render the token invalid
        $now = (new \DateTime())
            ->sub(new DateInterval("P1Y"));

        $instance->token = "";
        $instance->refreshToken = "";
        $instance->expirationDate = $now;
        $instance->refreshExpirationDate = $now;

        return $instance;
    }

    public static function newInstance(string $token, string $refreshToken): self {
        $instance = new self();

        // to render the token invalid
        $expirationDate = (new DateTime())
            ->add(new DateInterval(sprintf("PT%sS", Constants::JWT_TTL)));

        $refreshExpirationDate = (new DateTime())
            ->add(new DateInterval(sprintf("PT%sS", Constants::JWT_REFRESH_TTL)));

        $instance->token = $token;
        $instance->refreshToken = $refreshToken;
        $instance->expirationDate = $expirationDate;
        $instance->refreshExpirationDate = $refreshExpirationDate;

        return $instance;
    }
}