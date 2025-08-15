<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Document;

class DocumentPublished extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Document $document
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouveau document publié : ' . $this->document->titre)
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Un nouveau document a été publié dans le système de gestion documentaire.')
            ->line('**Titre :** ' . $this->document->titre)
            ->line('**Type :** ' . $this->document->type)
            ->line('**Description :** ' . ($this->document->description ?: 'Aucune description'))
            ->line('**Publié par :** ' . $this->document->user->name)
            ->line('**Date de publication :** ' . $this->document->date_publication->format('d/m/Y à H:i'))
            ->action('Consulter le document', route('dashboard'))
            ->line('Merci d\'utiliser notre système de gestion documentaire !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'document_id' => $this->document->id,
            'titre' => $this->document->titre,
            'type' => $this->document->type,
            'user_id' => $this->document->user_id,
        ];
    }
}
