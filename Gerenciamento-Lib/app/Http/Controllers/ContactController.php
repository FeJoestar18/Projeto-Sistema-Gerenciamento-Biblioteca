<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a new contact message
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create([
            'subject' => $request->subject,
            'message' => $request->message,
            'user_id' => Auth::id(),
            'status' => 'open'
        ]);

        return redirect()->route('contact.my-messages')->with('success', 'Sua mensagem foi enviada com sucesso!');
    }

    public function myMessages()
    {
        $messages = ContactMessage::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('contact.my-messages', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        if ($contactMessage->user_id !== Auth::id() && !$this->canManageMessages()) {
            abort(403);
        }

        return view('contact.show', compact('contactMessage'));
    }

    public function manage()
    {
        if (!$this->canManageMessages()) {
            abort(403);
        }

        $messages = ContactMessage::with(['user', 'assignedTo'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('contact.manage', compact('messages'));
    }

    public function edit(ContactMessage $contactMessage)
    {
        if (!$this->canManageMessages()) {
            abort(403);
        }

        return view('contact.edit', compact('contactMessage'));
    }

    public function update(Request $request, ContactMessage $contactMessage)
    {
        if (!$this->canManageMessages()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:open,in_progress,closed',
            'response' => 'nullable|string|max:2000'
        ]);

        $data = [
            'status' => $request->status,
            'assigned_to' => Auth::id(),
        ];

        if ($request->filled('response')) {
            $data['response'] = $request->response;
            $data['responded_at'] = now();
        }

        $contactMessage->update($data);

        return redirect()->route('contact.manage')->with('success', 'Mensagem atualizada com sucesso!');
    }

    public function assign(ContactMessage $contactMessage)
    {
        if (!$this->canManageMessages()) {
            abort(403);
        }

        $contactMessage->update([
            'assigned_to' => Auth::id(),
            'status' => 'in_progress'
        ]);

        return redirect()->route('contact.manage')->with('success', 'Mensagem atribuída a você com sucesso!');
    }

    private function canManageMessages(): bool
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isEmployee() && $user->employee) {
            $customerServiceDept = Department::where('name', 'Atendimento')->first();
            return $user->employee->department_id === $customerServiceDept?->id;
        }

        return false;
    }
}
