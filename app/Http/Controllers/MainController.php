<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        echo "I'm creating a new note.";
    }

    public function editNote($id)
    {
        $id = $this->decryptId($id);

        echo "I'm editing note with id = $id";
    }
    public function deleteNote($id)
    {
        $id = $this->decryptId($id);
        echo "I'm deleting note with id = $id";
    }

    private function decryptId($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }

        return $id;
    }
}
