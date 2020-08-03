<?php include('src/includes.php'); ?>
<style>
.note
{
    text-align: center;
    height: 80px;
    background: -webkit-linear-gradient(left, #47bd24, #358c1b);
    color: #fff;
    font-weight: bold;
    line-height: 80px;
}
.form-content
{
    padding: 5%;
    border: 1px solid #ced4da;
    margin-bottom: 2%;
}
.form-control{
    border-radius:1.5rem;
}
.btnSubmit
{
    border:none;
    border-radius:1.5rem;
    padding: 1%;
    width: 20%;
    cursor: pointer;
    background: #28a745;
    color: #fff;
    transition-duration: 0.4;
}
.btnSubmit1 {
    transition-duration: 0.4s;
}
.btnSubmit1:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.28), 0 17px 50px 0 rgba(0,0,0,0.22);
}
</style>
<div class="container register-form">
            <div class="form">
                <div class="note">
                    <p>Quizzane Registration</p>
                </div>

                <div class="form-content">
                    <div class="row">
                        <div class="col-md-6">
                        <form action="registerbe.php" method="POST" name="signUpForm">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username *" name="username" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Email *" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Your Password *" name="passwordField1" required/>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirm Password *" name="passwordField2" required/>
                            </div>
                        </div>
                    </div>
                    <div style="padding-top: 20px;" align="center">
                    <button type="submit" id="okButton" class="btnSubmit btnSubmit1">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>