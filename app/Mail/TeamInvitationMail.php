<?php

namespace App\Mail;

use App\Models\Invitation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeamInvitationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invitation, $team_name, $recipient_name, $sender_name;

    /**
     * Create a new message instance.
     */
    public function __construct(Invitation $invitation, Team $team, $recipient_name, $sender_name)
    {
        $this->invitation = $invitation;
        $this->team_name = $team->team_name;
        $this->recipient_name = $recipient_name;
        $this->sender_name = $sender_name;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Team Invitation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.team-invitation',
            with: [
                'url' => route('invite.accept', $this->invitation->token),
                'team_name' => $this->team_name,
                'recipient_name' => $this->recipient_name,
                'sender_name' => $this->sender_name
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
