<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NotificationService
{
    /**
     * Create Notification
     */
    public function create(array $data): Notification
    {
        if (!empty($data['attachment'])) {
            $data['attachment'] = $data['attachment']->store(
                'notifications',
                'public'
            );
        }

        return Notification::create([
            'title'       => $data['title'],
            'slug'        => Str::slug($data['title']) . '-' . time(),
            'message'     => $data['message'],
            'priority'    => $data['priority'],
            'audience'    => $data['audience'],
            'attachment'  => $data['attachment'] ?? null,
            'publish_at'  => $data['publish_at'] ?? null,
            'expire_at'   => $data['expire_at'] ?? null,
            'status'      => $data['status'],
            'created_by'  => Auth::id(),
        ]);
    }

    /**
     * Update Notification
     */
    public function update(Notification $notification, array $data): Notification
    {
        if (!empty($data['attachment'])) {

            if (
                $notification->attachment &&
                Storage::disk('public')->exists($notification->attachment)
            ) {
                Storage::disk('public')->delete($notification->attachment);
            }

            $data['attachment'] = $data['attachment']->store(
                'notifications',
                'public'
            );
        } else {
            $data['attachment'] = $notification->attachment;
        }

        $notification->update([
            'title'       => $data['title'],
            'slug'        => Str::slug($data['title']) . '-' . time(),
            'message'     => $data['message'],
            'priority'    => $data['priority'],
            'audience'    => $data['audience'],
            'attachment'  => $data['attachment'],
            'publish_at'  => $data['publish_at'] ?? null,
            'expire_at'   => $data['expire_at'] ?? null,
            'status'      => $data['status'],
        ]);

        return $notification;
    }

    /**
     * Delete Notification
     */
    public function delete(Notification $notification): bool
    {
        if (
            $notification->attachment &&
            Storage::disk('public')->exists($notification->attachment)
        ) {
            Storage::disk('public')->delete($notification->attachment);
        }

        return $notification->delete();
    }
}
