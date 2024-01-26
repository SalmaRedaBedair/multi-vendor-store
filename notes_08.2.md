# authenticated user
- may be returned from request or auth as usual
```php
$user=$request->user(); // same as Auth::user
```
# user & profile has relation 1:1
```php
$user->profile()->create($request->all());
// is equal to, user if is added automatically

$request->merge([
    'user_id'=>$user->id
]);
Profile::create($request->all());
```
# save
- that save will create new profile if not exist, or update it if already exist
```php
$user->profile->fill($request->all())->save();
// that save will create new profile if not exist, or update it if already exist

// is equal to all under it
$profile = $user->profile;
        if ($profile->first_name) {
            $profile->update($request->all());
        } else {
            $user->profile()->create($request->all());
            // is equal to

            $request->merge([
                'user_id'=>$user->id
            ]);
            Profile::create($request->all());
        }
```
# diffrence betwween route patch and put
```php
    Route::patch('profile',[ProfileController::class,'update'])->name('profile.edit'); 
    // we use patch because route put must contains id
```