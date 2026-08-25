<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Mail\ContactMessageMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    private const SPAM_MIN_SECONDS = 3;

    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (! $this->isLikelySpam($request)) {
            Mail::to(config('portfolio.contact.email'))->send(new ContactMessageMail(
                senderName: $validated['name'],
                senderEmail: $validated['email'],
                messageBody: $validated['message'],
            ));
        }

        return back()->with('contactStatus', 'success');
    }

    private function isLikelySpam(StoreContactMessageRequest $request): bool
    {
        if (filled($request->input('company'))) {
            return true;
        }

        $renderedAt = (int) $request->input('rendered_at', 0);

        return $renderedAt > 0 && (time() - $renderedAt) < self::SPAM_MIN_SECONDS;
    }
}
