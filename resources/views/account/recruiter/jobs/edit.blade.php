{{-- edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Modifier une offre')
@section('content')
    @include('account.recruiter.jobs.form', ['jobOffer' => $offer])
@endsection
