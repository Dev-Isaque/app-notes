<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        $id = session("user.id");
        $notes = User::find($id)
            ->notes()
            ->whereNull('deleted_at')
            ->get()
            ->toArray();

        return view("home", ['notes' => $notes]);
    }

    public function edit(Request $request) {
        return view('edit');
    }

    public function update(Request $request, Note $note) {
        return redirect()->route('home');
    }

    public function newNote()
    {
        return view('notes/new_note');
    }

    public function newNoteSubmit(Request $request)
    {
        // validate request
        $request->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000',
            ],
            [
                'text_title.required' => 'O Title é obrigatório',
                'text_title.min' => 'O Title deve ter pelo menos :min caracteres',
                'text_title.max' => 'O Title deve ter no máximo :max caracteres',

                'text_note.required' => 'A Note é obrigatória',
                'text_note.min' => 'A Note deve ter pelo menos :min caracteres',
                'text_note.max' => 'A Note deve ter no máximo :max caracteres'
            ]
        );

        // get user id
        $id = session('user.id');

        // create new note
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        // redirect to home
        return redirect()->route('home');
    }

    public function editNote($id)
    {
        $id =  Operations::decryptId($id);

        if ($id === null) {
            return redirect()->route('home');
        }

        // load note
        $note = Note::find($id);

        return view('notes/edit_note', ['note' => $note]);
    }

    public function editNoteSubmit(Request $request)
    {
        // validate request
        $request->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000',
            ],
            [
                'text_title.required' => 'O Title é obrigatório',
                'text_title.min' => 'O Title deve ter pelo menos :min caracteres',
                'text_title.max' => 'O Title deve ter no máximo :max caracteres',
                'text_note.required' => 'A Note é obrigatória',
                'text_note.min' => 'A Note deve ter pelo menos :min caracteres',
                'text_note.max' => 'A Note deve ter no máximo :max caracteres'
            ]
        );

        // check if note_id is present
        if ($request->note_id == null) {
            return redirect()->route('home');
        }

        // descrypt note_id
        $id = Operations::decryptId($request->note_id);

        if ($id === null) {
            return redirect()->route('home');
        }

        // load note
        $note = Note::find($id);

        // update note
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        // redirect to home
        return redirect()->route('home');
    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);

        // load note
        $note = Note::find($id);

        // show delete note confirmation
        return view('notes/delete_note', ['note' => $note]);
    }

    public function deleteNoteConfirm($id)
    {
        // check if id is encrypted
        $id = Operations::decryptId($id);

        if ($id === null) {
            return redirect()->route('home');
        }

        // load note
        $note = Note::find($id);

        // 1. hard delete
        // $note->delete();

        // 2. soft delete
        // $note->deleted_at = date('Y-m-d H:i:s');
        // $note->save();

        // 3. soft delete (property SoftDeletes in model)
        $note->delete();

        // 3. hard delete (property SoftDeletes in model)
        // $note->forceDelete();

        // redirect to home
        return redirect()->route('home');
    }
}
