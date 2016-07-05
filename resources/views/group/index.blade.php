@extends('layouts.master')

@section('content')
    <p>This is my body content.</p>
    @foreach ($groups as $group)
        {{ $group->name }}
    @endforeach

    {{ $groups->links()}}
@endsection

@section('script')
    $(document).foundation();
@endsection
