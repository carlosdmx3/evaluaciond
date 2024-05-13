


                @if (Route::has('login'))

                @auth

                @else

                            <div class="container-fluid shadow ">
                            
                                        <div class="colorBG card-header bg-purple">
                                            &nbsp;ACCESO &nbsp;  <i class="fa fa-desktop"></i>
                                        </div>
                                        <div class="card-body">
                                            @extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

                                            @php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
                                            @php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
                                            @php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

                                                @if (config('adminlte.use_route_url', false))
                                                    @php( $login_url = $login_url ? route($login_url) : '' )

                                                @else
                                                    @php( $login_url = $login_url ? url($login_url) : '' )

                                                @endif

                                    
                                        <form action="{{ $login_url }}" method="post">
                                            @csrf
                                            {{-- Email field --}}
                                            <div class="input-group mb-3">
                                                        <input type="text" name="email" class="form-control  input-sm @error('email') is-invalid @enderror"
                                                            value="{{ old('email') }}" placeholder="usuario" autofocus> 

                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fa fa-user-circle {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                                            </div>
                                                        </div>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>

                                            {{-- Password field --}}
                                            <div class="input-group mb-3" id="show_hide_password">
                                                        <input type="password" name="password" class="password1 form-control @error('password') is-invalid @enderror"
                                                            placeholder="password">  

                                                        <div id="pwd" class="input-group-append">
                                                            <div class="input-group-text">&nbsp;
                                                            <a href="" style="color:black;"><i class="fa fa-eye-slash {{ config('adminlte.classes_auth_icon', '') }}" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                                

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>

                                            {{-- Login field --}}
                                            <div>
                                                        
                                                        <button type=submit class="colorBG btn btn-block btn-sm {{ config('adminlte.classes_auth_btn', 'btn-flat') }}" style="text-decoration:none; color:white;">
                                                            Ingresar <i class="fa fa-sign-in"></i>
                                                        </button>
                                                        <br>
                                                        <p> 
                                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="remember">
                                                            {{ __('adminlte::adminlte.remember_me') }}
                                                        </label>
                                                        </p>
                                            </div>

                                        </form>
                                        </div>
                                        
                            </div>
                @endauth

                @endif



