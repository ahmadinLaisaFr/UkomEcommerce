<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\Profile;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserProfileComponent extends Component
{
    public function dismissAlert($sessionName)
    {
        session()->forget($sessionName);
    }

    public function render()
    {
        $mydata['user'] = User::find(Auth::user()->id);
        
        if (Profile::where('user_id', Auth::user()->id)->first() == null) {
            Profile::create(['user_id' => Auth::user()->id]);
        }

        $mydata['profile'] = Profile::where('user_id', Auth::user()->id)->first();
        return view('livewire.user.user-profile-component', $mydata)->layout('layouts.base');
    }
}
