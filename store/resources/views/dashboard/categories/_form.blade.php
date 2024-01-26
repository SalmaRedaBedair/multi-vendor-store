@if ($errors->any())
    <div class="alert alert-danger">
        <b>Errors Ocurred!</b>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @endif

<div class="form-group"></div>
    <x-form.input name='name' :value="$category->name" label="Category Name"/>
</div>
<div class="form-group">
    <label for="">Category Parent</label>
    <select name="parent_id" class="form-control form-select">
        <x-form.select :options="$parents"  :checked="$category->parent" name="parent_id" />
    </select>
</div>
<div class="form-group">
    <x-form.textarea name="description" :value="$category->description" label="Description" />
</div>
<div class="form-group">
    <x-form.label for="image" >Image</x-form.label>
    <x-form.input name="image" type="file" accept="image/*" />
    @if (old('image',$category->image))
    <img src="{{ asset('storage/' . old('image',$category->image)) }}" alt="" height="60" >
    @endif
</div>
<div class="form-group">
    <label for="">Status</label>
    <x-form.radio name="status" :options="['Active'=>'active', 'Archived'=>'archived']" :checked="$category->status" />
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
