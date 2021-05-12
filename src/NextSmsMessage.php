<?php

namespace NotificationChannels\NextSms;

class NextSmsMessage
{
    /** @var string */
    protected string $content;

    /** @var string|null */
    protected ?string $from;

    /**
     * Set content for this message.
     *
     * @param string $content
     * @return NextSmsMessage
     */
    public function content(string $content): self
    {
        $this->content = trim($content);

        return $this;
    }

    /**
     * Set sender for this message.
     *
     * @param string $from
     * @return self
     */
    public function from(string $from): self
    {
        $this->from = trim($from);

        return $this;
    }

    /**
     * Get message content.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Get sender info.
     *
     * @return string
     */
    public function getSender(): string
    {
        return $this->from ?? config('services.nextsms.from');
    }
}
