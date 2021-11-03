<x-layout>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h2 class="headingTitle">Welcome to CRUD application</h2>
            <p>Sign in below to manage and update users.</p>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                @if($errors->any())
                            @foreach($errors->all() as $error)
                                <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif
                    <div class="logincard">
                        <h2><center>Sign in</center></h2>
                        <form action="/sign-in" method="post">
                            @CSRF
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                            </div>
                            
                            <input type="submit" name="submit" id="submit" value="Sign in" class="form-control btn btn-success">
                        </form>
                    </div>
                    <p><center><a href="#">Forgot your password?</a></center></p>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</x-layout>