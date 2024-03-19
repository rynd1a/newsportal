<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;

class NewsDTO
{
    private string $header;
    private string $announce;
    private string $description;
    private int $userId;
    private ?UploadedFile $image;

    public function setHeader(string $header): void
    {
        $this->header = $header;
    }

    public function setAnnounce(string $announce): void
    {
        $this->announce = $announce;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setImage(?UploadedFile $image): void
    {
        $this->image = $image;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getHeader(): string
    {
        return $this->header;
    }

    public function getAnnounce(): string
    {
        return $this->announce;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }
}
