@extends('dashboard.layouts.app')
@section('main')


{{-- {{dd(Storage::url('products_img'))}} --}}
<div class="container-fluid">
    <h1 class="mt-4">
        @if (Route::currentRouteName()=='blood.edit')Edit
        @else Add
        @endif Blood
    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">
            @if (Route::currentRouteName()=='blood.edit')Edit
            @else Add
            @endif Blood
        </li>

    </ol>
    <div class="row">
        <div class="col-md-5 card" style="max-width: 1000px; margin: auto; padding: 10px 20px;">
            <form enctype="multipart/form-data" @if (Route::currentRouteName()=='blood.edit') action="{{route('blood.update', $blood->id)}}" method="post"
            @else action="{{route('blood.store')}}" method="post"
            @endif >

            @csrf

            {{-- <input type="hidden" name="id" id="id" value="{{Auth::id()}}"> --}}

            <div class="row">

                <div class="col-md-12">
                    <x-form.input.select id="blood" label="Blood Group" otherattr="required" class="form-control form-control-sm" value="{{(isset($blood->blood) && $blood->blood!='')?$blood->blood :''}}">
                        <option value="{{(isset($blood->blood) && $blood->blood!='')?$blood->blood :''}}">{{(isset($blood->blood) && $blood->blood!='')?$blood->blood :'-- Select --'}}</option>
                        <option value="A+">A+</option>
                        <option value="B+">B+</option>
                        <option value="O+">O+</option>
                        <option value="Other">Other</option>
                    </x-form.input.select>
                </div>

                <div class="col-md-12">
                    <x-form.input.date id="stored_date" label="Blood Stored Date" class="form-control form-control-sm" placeholder="dd/mm/yyyy" value="{{(isset($blood->stored_date) && $blood->stored_date!='')?$blood->stored_date :''}}" />
                </div>

                <div class="col-md-12">
                    <x-form.input.date id="expired_date" label="Blood Stored Date" class="form-control form-control-sm" placeholder="dd/mm/yyyy" value="{{(isset($blood->expired_date) && $blood->expired_date!='')?$blood->expired_date :''}}" />
                </div>

            </div>

            <div class="col-md-3 pr-0" style="float:right;">
                <input id="submit" type="submit" class="form-control form-control-sm btn btn-success pt-0" value="submit">
            </div>
            </form>
        </div>
    </div>
</div>
@endsection