<div x-data>
    <div class="flex justify-center font-bold text-lg my-4">
        @if (str_starts_with($tag, '#'))
            Posts with {{ $tag }} tag
        @else
            Posts {{ $tag }} mentioned
        @endif
    </div>
    <ul>
        @foreach ($posts as $post)
            <li @if ($loop->last) id="last-record" @endif>
                @livewire('components.post', ['post' => $post], key($post->id))
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
