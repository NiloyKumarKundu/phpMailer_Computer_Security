<?php include 'header.php' ?>

<div class="container">
    <div class="tab-pane" role="tabpanel" aria-labelledby="tab-register">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="m-4">
                    Sign Up
                </h1>
                <form>
                    <!-- Name input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="registerName" class="form-control" />
                        <label class="form-label" for="registerName">Name</label>
                    </div>

                    <!-- Username input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="registerUsername" class="form-control" />
                        <label class="form-label" for="registerUsername">Username</label>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="registerEmail" class="form-control" />
                        <label class="form-label" for="registerEmail">Email</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="registerPassword" class="form-control" />
                        <label class="form-label" for="registerPassword">Password</label>
                    </div>

                    <!-- Repeat Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="registerRepeatPassword" class="form-control" />
                        <label class="form-label" for="registerRepeatPassword">Confirm password</label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-3">Sign Up</button>
                </form>
            </div>
            <div class="col-md-6 offset-md-3">
                <a href="index.php" class="btn btn-success btn-block mb-3">Already have an account? Log in Here</a>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>