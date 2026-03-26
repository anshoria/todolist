<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

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

        Todo::create(['title' => $this->title]);
        $this->title = '';
    }

    public function toggle(Todo $todo)
    {
        $todo->update(['done' => !$todo->done]);
    }

    public function delete(Todo $todo)
    {
        $todo->delete();
    }

    public function changeBg(string $bg)
    {
        $this->bg = $bg;
        session(['bg' => $bg]);
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->get(),
        ]);
    }
}