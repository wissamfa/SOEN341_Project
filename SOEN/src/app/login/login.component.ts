import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
// import { ToastrService } from 'ngx-toaster';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  loginForm: FormGroup;

  submitted = false;

  constructor(private formBuilder: FormBuilder, private router: Router) {}

  ngOnInit() {
    this.loginForm = this.formBuilder.group({
    username: ['', Validators.required],
    password: ['', [Validators.required]],
  }); }

  // This function will call the validation to make sure all the fields are filled before sending it to the backend
  checkup() {
    this.submitted = true;
    if (this.loginForm.invalid) {
        return;
    } else {
      this.loginUser();
    }
  }

  loginUser() {
    this.router.navigate(['/profile'])

  }

  // convenience getter for easy access to form fields
  get g() { return this.loginForm.controls; }

  showError(error: String ) {
    // this.toaster.toastrConfig.toastClass = 'alert';
    // this.toaster.toastrConfig.iconClasses.error = 'alert-danger';
    // this.toaster.error('Cannot login. ' + error + '.');
  }

}
