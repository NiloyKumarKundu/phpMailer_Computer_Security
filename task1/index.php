<?php include '../header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="m-4">Log in</h1>

            <form action="handleLogin.php" method="POST">
                <!-- Email input --> 
                <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email"/>
                    <label class="form-label" for="form2Example1">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" class="form-control" placeholder="Password"/>
                    <label class="form-label" for="form2Example2">Password</label>
                </div>

                <!-- Submit button -->
                <input type="submit" name="Login" class="btn btn-primary btn-block mb-4" value="Sign in" />
            </form>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Not a member? <a href="register.php">Register</a></p>
            </div>

        </div>
    </div>
</div>

<?php include '../footer.php' ?>