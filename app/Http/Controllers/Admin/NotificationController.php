<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use App\Services\NotificationService;

class NotificationController extends Controller
{
    /**
     * Notification Service Instance
     */
    protected NotificationService $notificationService;

    /**
     * Constructor
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Display Notification List
     */
    public function index()
{
    $notifications = Notification::with('creator')
        ->latest()
        ->paginate(10);

    $stats = [
        'total'      => Notification::count(),
        'published'  => Notification::where('status', 'Published')->count(),
        'draft'      => Notification::where('status', 'Draft')->count(),
        'urgent'     => Notification::where('priority', 'Urgent')->count(),
    ];

    return view('admin.notifications.index', compact(
        'notifications',
        'stats'
    ));
}

    /**
     * Show Create Form
     */
    public function create()
    {
        return view('admin.notifications.create');
    }

    /**
     * Store Notification
     */
    public function store(StoreNotificationRequest $request)
{
    $this->notificationService->create($request->validated());

    return redirect()
        ->route('admin.notifications.index')
        ->with('success', 'Notification created successfully.');
}

    /**
     * Display Notification
     */
    public function show(Notification $notification)
    {
        return view(
            'admin.notifications.show',
            compact('notification')
        );
    }

    /**
     * Show Edit Form
     */
    public function edit(Notification $notification)
    {
        return view(
            'admin.notifications.edit',
            compact('notification')
        );
    }

    /**
     * Update Notification
     */
    public function update(
    UpdateNotificationRequest $request,
    Notification $notification
) {
    $this->notificationService->update(
        $notification,
        $request->validated()
    );

    return redirect()
        ->route('admin.notifications.index')
        ->with(
            'success',
            'Notification updated successfully.'
        );
}
    /**
     * Delete Notification
     */public function destroy(Notification $notification)
{
    $this->notificationService->delete($notification);

    return redirect()
        ->route('admin.notifications.index')
        ->with(
            'success',
            'Notification deleted successfully.'
        );
}
}
