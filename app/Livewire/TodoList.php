<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class TodoList extends Component
{
    public string $title = '';
    public string $bg = '1';

    public function mount()
    {
        $this->bg = session('bg', '1');
    }

    public function addTodo()
    {
        $this->validate([
            'title' => 'required|min:1|max:255',
        ]);

        $todo = Auth::user()->todos()->create([
            'title' => $this->title,
            'done'  => false,
        ]);

        $this->title = '';
        $this->dispatch('todo-added', id: $todo->id);
    }

    public function toggle(int $id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        $todo->update(['done' => !$todo->done]);
        $this->dispatch('todo-toggled', done: $todo->done);
    }

    public function delete(int $id)
    {
        $todo = Auth::user()->todos()->find($id);

        if (!$todo) return;

        $todo->delete();
        $this->dispatch('todo-deleted');
    }

    public function changeBg(string $bg)
    {
        $this->bg = $bg;
        session(['bg' => $bg]);
        $this->dispatch('bg-changed');
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Auth::user()->todos()->latest()->get(),
        ]);
    }
}