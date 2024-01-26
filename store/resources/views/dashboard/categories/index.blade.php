@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-small btn-outline-primary mr-2">Create</a>
        <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-small btn-outline-dark">Trash</a>
    </div>

    <x-alert type="success" />
    <x-alert type="info" />


    <form action="{{ URL::current() }}" method="GET" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <select name="status" class="form-control form-select">
            <x-form.select name="status" :options="[
                ''=>'All',
                'active'=>'Active',
                'archived'=>'Archived'
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
                <th>Parent</th>
                <th>products #</th>
                <th>Status</th>
                <th>Created At</th>
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
                    <td><a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->parent? $category->parent->name:'Main Category' }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                            class="btn btn-small btn-outline-success">Edit</a>
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST"
                            style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @empty($categories)
            <tr>
                <td colspan="8">No categories defined.</td>
            </tr>
            @endempty
        </tbody>
    </table>

    {{ $categories->withQueryString()->links() }}

@endsection
