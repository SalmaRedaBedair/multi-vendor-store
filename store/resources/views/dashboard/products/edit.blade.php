@extends('layouts.dashboard')

@section('title','Edit Category')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Profucts</li>
<li class="breadcrumb-item active">Edit product</li>
@endsection

@section('content')
<form action="{{ route('dashboard.products.update',$product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('dashboard.products._form',[
        'button_label'=>'update'
    ])
</form>
@endsection
