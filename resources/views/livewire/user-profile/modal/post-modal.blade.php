<div class="">
    @livewire('components.post', ['post' => $post], key($post->id))

    <div class="">
        @livewire('user-profile.comments', ['post'=> $post])
    </div>

</div>
