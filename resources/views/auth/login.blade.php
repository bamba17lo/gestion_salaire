<link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('css/auth.css')}}">


<form method="post" action="{{ route('post.login') }}">

    @csrf
    @method('POST')

    <div class="box">
        <h1>Connexion</h1>
        
        @if (session('succes'))
        <div style="color: rgb(13, 218, 13))" class="alert alert-success">{{session('succes')}}</div>
        @endif
        @if (session('error'))
            <div style="color: rgb(250, 40, 40)" class="alert alert-danger">{{session('error')}}</div>
         @endif

        <input type="email" name="email" class="email"  placeholder="email" value="{{ old('email')}}"/>
        @error('email')
            <div style="color: rgb(250, 40, 40)">{{$message}}</div>
        @enderror

        <input type="password" name="password" class="email" placeholder="********"/>
        @error('password')
            <div>{{$message}}</div>
        @enderror

        <div class="btn-container">
            <button type="submit"> Se connecter</button>
        </div>

        <!-- End Btn -->
        <!-- End Btn2 -->
    </div>
    <!-- End Box -->
</form>
