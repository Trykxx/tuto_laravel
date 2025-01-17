@extends('base')

@section('title')
    Accueil du blog
@endsection

@section('content')
    <h1>Mon blog</h1>

    @foreach ($posts as $post)
        <article>
            <h2>{{ $post->title }}</h2>

            <p class="small">
                @if ($post->category)
                    <strong>Catégorie : </strong>{{ $post->category?->name }},
                @endif
                @if (!$post->tags->isEmpty())
                    <strong>Tags :</strong>
                    @foreach ($post->tags as $tag)
                        <span class="badge bg-secondary">{{$tag->name}}</span>
                    @endforeach
                @endif
            </p>
            @if ($post->image)
                <img src="{{ $post->imageUrl()}}" alt="">
            @endif
            <p>{{ $post->content }}</p>
            <p>
                <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-primary">Lire
                    la suite</a>
            </p>
        </article>
    @endforeach

    {{ $posts->links() }}
@endsection
