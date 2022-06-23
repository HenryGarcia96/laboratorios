@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-4 pe-md-0">
                        <div class="auth-side-wrapper" style="background-image: url({{ url('https://via.placeholder.com/219x452') }})">
                        </div>
                    </div>
                    <div class="col-md-8 ps-md-0">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo d-block mb-2">Stev<span>Lab</span></a>
                            <h5 class="text-muted fw-normal mb-4">Cree una cuenta gratis (Paso 1)</h5>
                                        
                            <form class="forms-sample"  method="POST" action="{{ route('registro.store') }}">
                            @csrf
                               
                                <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">Nombre</label>
                                    <input  class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"  value="{{old('name')}}" required autofocus autocomplete="name" placeholder="Usuario">
                                    <x-jet-input-error for="name"></x-jet-input-error>
                                </div>
                
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{old('email')}}"  required placeholder="Correo Electrónico">
                                    <x-jet-input-error for="email"></x-jet-input-error>
                                </div>

                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">Contraseña</label>
                                    <input type="password" name='password' class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required autocomplete="new-password" placeholder="Contraseña">
                                    <x-jet-input-error for="password"></x-jet-input-error>
                                </div>

                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">Confirme contraseña</label>
                                    <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Repita contraseña">
                                </div>

                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <x-jet-checkbox id="terms" name="terms" />
                                            <label class="custom-control-label" for="terms">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                                    ]) !!}
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <button class="btn btn-primary me-2 mb-2 mb-md-0" type="submit">Crear cuenta</button>
                                </div>
                                <a href="{{ route('login') }}" class="d-block mt-3 text-muted">¿Ya estás registrado? Inicie sesión</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- 
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <x-jet-label value="{{ __('Name') }}" />

                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" required autofocus autocomplete="name" />
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Confirm Password') }}" />

                    <x-jet-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-jet-button>
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout> --}}