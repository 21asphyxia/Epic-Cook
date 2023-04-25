@extends('layouts.admin')

@section('content')
    <h1>Comments</h1>
    {{-- success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body" style="overflow: auto">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <td class="text-center">Author</td>
                        <td class="text-center">Content</td>
                        <td class="text-center">Created at</td>
                        <td class="text-center">Updated at</td>
                        <td class="text-center"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                        {{-- {{ dd($comment) }} --}}
                            <td class="text-center">{{ $comment->user->name }}</td>
                            <td class="text-center">{{ $comment->content }}</td>
                            <td class="text-center">{{ $comment->created_at->toDayDateTimeString() }}</td>
                            <td class="text-center">{{ $comment->updated_at ? $comment->updated_at->toDayDateTimeString() : 'Not edited' }}</td>
                            <td class="text-center">
                                <form class="d-inline" method="POST"
                                    action="{{ route('admin.comments.destroy', $comment) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="unstyled" type="submit"><i class="text-danger bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>    
            </table>
        </div>
    </div>
@endsection