<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\ContactMailRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
class ContactController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('front.contacts');
    }

    /**
     * @param ContactMailRequest $request
     * @return RedirectResponse
     */
    public function sendMessage(ContactMailRequest $request): RedirectResponse
    {
        try {
            Mail::send(new ContactMessage(
                $request->getFullName(),
                $request->getEmail(),
                $request->getMessage()
            ));
        } catch (\Throwable $exception) {
            return redirect()->back()
                ->with('error', $exception->getMessage())
                ->withInput();
        }
        return redirect()->route('contacts')->with('status', 'Message send!');
    }
}
