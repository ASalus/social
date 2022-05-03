<?php

namespace App\Http\Livewire\UserProfile\Modal;

use App\Models\Post;
use App\Models\Post\UserPostStat;
use LivewireUI\Modal\ModalComponent;

class ImagePostModal extends ModalComponent
{
    public $post;

    public static function modalMaxWidth(): string
    {
        return 'full';
    }

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function numberFilter($n)
    {
        if ($n > 1000000000000) return round(($n / 1000000000000), 1) . 'T';
        else if ($n > 1000000000) return round(($n / 1000000000), 1) . 'B';
        else if ($n > 1000000) return round(($n / 1000000), 1) . 'M';
        else if ($n > 1000) return round(($n / 1000), 1) . 'K';

        return number_format($n);
    }

    public function resendClick(Post $post)
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
        $this->emit('$refresh');
    }

    public function likeClick(Post $post)
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
        $this->emit('$refresh');
    }

    public function render()
    {
        return view('livewire.user-profile.modal.image-post-modal');
    }
}
