@extends('narsil::layouts.auth')

@section('body')
	<x-narsil::blocks.resource-form
		:form-data="$data"
		:form="$form"
	/>
@endsection
