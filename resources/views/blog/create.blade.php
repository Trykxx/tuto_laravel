@extends('base')

@section('title')
    Creer un article
@endsection

@section('content')
    <form action="" method="POST">
        @csrf
        <input type="text" name="title" value="article de demo">
        <textarea name="content">contenu de demo</textarea>
        <button>Enregistrer</button>
    </form>
@endsection
