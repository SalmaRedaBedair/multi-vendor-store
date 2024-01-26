@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Categories</li>
    <li class="breadcrumb-item active">Trash</li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-small btn-outline-primary">Back</a>
    </div>

    <x-alert type="success" />
    <x-alert type="info" />


    <form action="{{ URL::current() }}" method="GET" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <select name="status" class="form-control form-select">
            <x-form.select name="status" :options="[
                (object) ['id' => '', 'name' => 'All'],
                (object) ['id' => 'active', 'name' => 'Active'],
                (object) ['id' => 'archived', 'name' => 'Archived'],
            ]" class="mx-2" />
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Deleted At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $category->image) }}" alt="" height="60">
                    </td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->deleted_at }}</td>
                    <td>
                        <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="POST"
                            style="display: inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-small btn-outline-info">Restore</button>
                        </form>
                        <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="POST"
                            style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    {{ $categories->withQueryString()->links() }}

@endsection
