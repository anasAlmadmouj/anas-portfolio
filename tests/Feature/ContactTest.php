<?php

namespace Tests\Feature;

use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    public function test_a_valid_submission_sends_mail_and_redirects_with_a_success_flash(): void
    {
        Mail::fake();

        $response = $this->from('/en')->post('/en/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'message' => 'This is a test message with enough length to pass validation.',
            'rendered_at' => now()->subSeconds(10)->timestamp,
        ]);

        $response->assertRedirect('/en');
        $response->assertSessionHas('contactStatus', 'success');

        Mail::assertSent(ContactMessageMail::class, fn (ContactMessageMail $mail) => $mail->senderEmail === 'test@example.com'
        );
    }

    public function test_an_invalid_submission_redirects_back_with_errors_and_sends_no_mail(): void
    {
        Mail::fake();

        $response = $this->from('/en')->post('/en/contact', [
            'name' => '',
            'email' => 'not-an-email',
            'message' => 'short',
            'rendered_at' => now()->subSeconds(10)->timestamp,
        ]);

        $response->assertRedirect('/en');
        $response->assertSessionHasErrors(['name', 'email', 'message']);

        Mail::assertNothingSent();
    }

    public function test_a_filled_honeypot_field_silently_drops_the_message(): void
    {
        Mail::fake();

        $response = $this->from('/en')->post('/en/contact', [
            'name' => 'Bot',
            'email' => 'bot@example.com',
            'message' => 'This message is long enough to pass validation rules.',
            'company' => 'I am a bot',
            'rendered_at' => now()->subSeconds(10)->timestamp,
        ]);

        $response->assertRedirect('/en');
        $response->assertSessionHas('contactStatus', 'success');

        Mail::assertNothingSent();
    }

    public function test_a_submission_that_is_too_fast_is_treated_as_spam(): void
    {
        Mail::fake();

        $response = $this->from('/en')->post('/en/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'message' => 'This is a test message with enough length to pass validation.',
            'rendered_at' => now()->timestamp,
        ]);

        $response->assertRedirect('/en');

        Mail::assertNothingSent();
    }
}
