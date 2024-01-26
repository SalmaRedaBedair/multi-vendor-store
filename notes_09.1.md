# to replace all asset in vs code
- that will search with regex
```
href="(assets/.+)"
```
```
href="{{asset('$1')}}"
```

# relation with loop
- use eager loading