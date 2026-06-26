@extends('layouts.admin')

@section('content')

<div class="container">

    <h2>Create Notice</h2>

    <form action="{{ route('notices.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Message</label>
            <textarea name="message"
                      class="form-control"
                      rows="5"
                      required></textarea>
        </div>

        <div class="mb-3">
            <label>Publish Date</label>
            <input type="date"
                   name="publish_date"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Status</label>

            <select name="status" class="form-control">
                <option value="1">Published</option>
                <option value="0">Draft</option>
            </select>
        </div>

        <button class="btn btn-primary">
            Save Notice
        </button>

    </form>

</div>

@endsection