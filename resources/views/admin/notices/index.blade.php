@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h2>Notices</h2>

        <a href="{{ route('notices.create') }}"
           class="btn btn-primary">
            Create Notice
        </a>
    </div>

    <table class="table">

        <thead>
            <tr>
                <th>Title</th>
                <th>Publish Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        @foreach($notices as $notice)

            <tr>

                <td>{{ $notice->title }}</td>

                <td>{{ $notice->publish_date }}</td>

                <td>
                    {{ $notice->status ? 'Published' : 'Draft' }}
                </td>

                <td>

                    <a href="{{ route('notices.edit',$notice->id) }}"
                       class="btn btn-warning btn-sm">
                       Edit
                    </a>

                    <form action="{{ route('notices.destroy',$notice->id) }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection