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
        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes->toArray();

        return view("home", ['notes' => $notes]);
    }

    public function newNote()
    {
        return view('new_note');
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
        echo "I'm editing note with id = $id";
    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);
        echo "I'm deleting note with id = $id";
    }
}
