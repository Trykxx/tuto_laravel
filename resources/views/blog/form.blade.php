<form action="" method="POST">
    @csrf
    {{-- @method($post->id ? 'PATCH' : 'POST') --}}
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" name="title" value={{ old('title', $post->title) }}>
        @error('title')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" name="slug" value={{ old('slug', $post->slug) }}>
        @error('slug')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Contenu</label>
        <textarea class="form-control" name="content">{{ old('content', $post->content) }}</textarea>
        @error('content')
            {{ $message }}
        @enderror
    </div>
    <button class="btn btn-primary">
        @if ($post->id)
            Mofifier
        @else
            Creer
        @endif
    </button>
</form>