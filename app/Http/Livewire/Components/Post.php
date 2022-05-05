<?php

namespace App\Http\Livewire\Components;


use App\Models\Post as ModelsPost;
use App\Models\Post\UserPostStat;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Post extends Component
{
    protected $listeners = [
        'btnRefresh' => '$refresh',
        "deletePost" => 'deletePost'
    ];

    public function resendClick(ModelsPost $post)
    {

        $userPostStat = UserPostStat::firstOrCreate([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ]);
        if ($userPostStat->resend == false) {
            $userPostStat->resend = true;
            $post->stats->resend += 1;
        } else {
            $userPostStat->resend = false;
            $post->stats->resend -= 1;
        }
        $userPostStat->save();
        $post->stats->save();
        $this->emit('btnRefresh');
    }

    public function likeClick(ModelsPost $post)
    {

        $userPostStat = UserPostStat::firstOrCreate([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ]);
        if ($userPostStat->liked == false) {
            $userPostStat->liked = true;
            $post->stats->like += 1;
        } else {
            $userPostStat->liked = false;
            $post->stats->like -= 1;
        }
        $userPostStat->save();
        $post->stats->save();
        $this->emit('btnRefresh');
    }

    public function openPostModal(ModelsPost $post)
    {
        return $post->image != '{}'
            ? $this->emit('openModal', 'user-profile.modal.image-post-modal', ['post' => $post->id])
            : $this->emit('openModal', 'user-profile.modal.post-modal', ['post' => $post->id]);
    }

    public function numberFilter($n)
    {
        if ($n > 1000000000000) return round(($n / 1000000000000), 1) . 'T';
        else if ($n > 1000000000) return round(($n / 1000000000), 1) . 'B';
        else if ($n > 1000000) return round(($n / 1000000), 1) . 'M';
        else if ($n > 1000) return round(($n / 1000), 1) . 'K';

        return number_format($n);
    }

    public function dateFormat($date)
    {
        $date = new Carbon($date);
        return ($date->diff()->days < 1)
            ? $date->diffForHumans()
            : $date->format('d F Y');
    }

    public function deleteConfirm($id)
    {
        ModelsPost::where('id', $id)->delete();
        $this->emit('refreshPosts');
    }

    public function mount($post, User $user)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.components.post');
    }
}
