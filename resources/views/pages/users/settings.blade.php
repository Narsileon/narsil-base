@extends('narsil::layouts.auth')

@section('hideUserSettings')
@endsection

@section('body')
	<livewire:narsil-user-settings :initially-open="true" />
@endsection
