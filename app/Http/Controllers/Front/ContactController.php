<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Front;

use App\Http\Requests\ContactEmailRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

/**
 * Class ContactController
 * @package App\Http\Controllers\Front
 */
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
     * @param ContactEmailRequest $request
     * @return RedirectResponse
     */
    public function sendMessage(ContactEmailRequest $request): RedirectResponse
    {
        try{
            Mail::send(new ContactMessage(
                $request->getFullName(),
                $request->getEmail(),
                $request->getMessage()
            ));

//            dd($request->getFullName());

        } catch (\Throwable $exception)
        {
            return redirect()->back()
                ->with('error', $exception->getMessage())
                ->withInput();
        }
        return redirect()->route('contacts')->with('status', 'Message sent.');

    }
}
