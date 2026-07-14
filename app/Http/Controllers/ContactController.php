<?php

namespace App\Http\Controllers;

use App\Enums\ContactSubmissionStatus;
use App\Http\Requests\StoreContactSubmissionRequest;
use App\Models\ContactSubmission;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact.index', [
            'settings' => SiteSetting::current(),
        ]);
    }

    public function store(StoreContactSubmissionRequest $request): JsonResponse
    {
        ContactSubmission::query()->create([
            ...$request->validated(),
            'status' => ContactSubmissionStatus::New,
        ]);

        return response()->json([
            'message' => 'Thank you for your message. We will respond shortly.',
        ]);
    }
}
