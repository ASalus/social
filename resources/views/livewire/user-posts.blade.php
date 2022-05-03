<div x-data>
    <ul>
        @foreach ($posts as $post)
            <li @if ($loop->last) id="last-record" @endif>
                @livewire('components.post', ['post' => $post, 'user' => $user->id], key($post->id))
            </li>
        @endforeach
    </ul>

    @if ($loadAmount < $totalPosts)
        <x-loading-animation wire:loading.500ms></x-loading-animation>
    @endif

    <script>
        const lastRecord = document.getElementById('last-record');
        const options = {
            root: null,
            threshold: 1,
            rootMargin: '0px'
        }
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    @this.loadMore()
                }
            });
        });
        observer.observe(lastRecord);
    </script>

</div>
