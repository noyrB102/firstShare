<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Thoughts;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\User;

class Mythoughts extends Component
{
    use WithFileUploads;

    // #[Validate('required|max:500', message:'Please, write something')]
    #[Validate('required',message:'Please, write something')]
    #[Validate('max:500',message:'Too many characters')]
    public $content;

    // #[Validate('')] // 2MB Max
    public $image;

    public User $user;
    public Thoughts $thoughts;

    // public function mount()
    // {
    //     $this->user = auth()->user();
    // }

//*************========= IF ISSUES -- UNCOMMENT THIS - BUT I DON'T THINK IT'S REALLY NEEDED ==*****
    public function updated()
    {
        $this->user = auth()->user();
    }
//*************========= IF ISSUES -- UNCOMMENT THIS - BUT I DON'T THINK IT'S REALLY NEEDED ==*****

    public function add()
    {
        $this->validate();
        if($this->image) {
            Thoughts::create(
                [
                    'user_id' => $this->user->id,
                    'content' => $this->content,
                    'image' => $this->image->store('photos', 'public'),
                ]);
        } else {
            Thoughts::create(
                [
                    'user_id' => $this->user->id,
                    'content' => $this->content,
                    // 'image' => $this->image->store('photos', 'public'),
                ]);
        }

            $this->reset();
            // return redirect(route('posts'));

    }

    public function delete($id)
    {
        $row =  Thoughts::findOrFail($id);
        $row->delete();
    }

    public function render()
    {
        $contents = Thoughts::latest()->get();

        return view('livewire.mythoughts',compact('contents'));
    }
}
