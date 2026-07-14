<?php

namespace App\Models;

use App\Enums\ContactSubmissionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'read_at',
        'replied_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => ContactSubmissionStatus::class,
            'read_at' => 'datetime',
            'replied_at' => 'datetime',
        ];
    }

    public function markAsRead(): void
    {
        $this->update([
            'status' => ContactSubmissionStatus::Read,
            'read_at' => $this->read_at ?? now(),
        ]);
    }

    public function markAsReplied(): void
    {
        $this->update([
            'status' => ContactSubmissionStatus::Replied,
            'read_at' => $this->read_at ?? now(),
            'replied_at' => now(),
        ]);
    }
}
