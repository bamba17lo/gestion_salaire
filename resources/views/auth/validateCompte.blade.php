<link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('css/auth.css')}}">


<form method="post" action="{{ route('admin.submit',$email) }}">

    @csrf
    @method('POST')

    <div class="box">
        <h1>Validation de Compte</h1>
        
        @if (session('error'))
            <div style="color: rgb(250, 40, 40)" class="alert alert-danger">{{session('error')}}</div>
         @endif

        <input type="email" name="email" class="email" readonly  placeholder="email" value="{{$email}}" /><br>

<label for="">Code</label>  <br>      
        <input type="text" name="code" class="email"  placeholder="" value="{{old('code')}}"/>
        @error('code')
            <div style="color: rgb(250, 40, 40)">{{$message}}</div>
        @enderror

    <div class="form-roup">
            <label class="form-group" for="">Mot de passe</label>
            <input type="password" name="password" class="email" placeholder="********"/>
        @error('password')
            <div style="color: rgb(250, 40, 40)">{{$message}}</div>
        @enderror
    </div>

    <div class="form-roup">
        <label for="">Mot de passe de confirmation</label>
        <input type="password" name="password_confirmation" class="email" placeholder="********"/>
        @error('password-confirmation')
        <div style="color: rgb(250, 40, 40)">{{$message}}</div>
    @enderror
    </div>

        <div class="btn-container">
            <button type="submit">Valider</button>
        </div>

        <!-- End Btn -->
        <!-- End Btn2 -->
    </div>
    <!-- End Box -->
</form>
