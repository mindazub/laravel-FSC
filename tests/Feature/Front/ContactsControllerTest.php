<?php



declare(strict_types = 1);

namespace Tests\Feature\Front;

use App\Mail\ContactMessage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * Class ContactControllerTest
 * @package Tests\Feature\Front
 */
class ContactControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_get_response_ok(): void
    {
        $response = $this->get(route('contacts'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function it_should_send_email(): void
    {
        Mail::fake();

        $response = $this->post(route('contacts'), [
            'full_name' => 'some name',
            'email' => 'mail@mail.com',
            'message' => 'some text',
        ]);

        Mail::assertSent(ContactMessage::class);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHasNoErrors();
    }

    /**
     * @test
     */
    public function it_should_not_send_email_with_bad_mail(): void
    {
        Mail::fake();

        $response = $this->post(route('contacts'), [
            'full_name' => 'some name',
            'email' => 'mail',
            'message' => 'some text',
        ]);

        Mail::assertNotSent(ContactMessage::class);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHasErrors(['email']);
    }
}