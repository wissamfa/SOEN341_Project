import { Component, OnInit } from "@angular/core";
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { Router } from "@angular/router";
// import { ToastrService } from 'ngx-toaster';
import { AuthService } from "../shared/services/auth.service";
import { GlobalEventsService } from '../global-events.service';

@Component({
  selector: "app-login",
  templateUrl: "./login.component.html",
  styleUrls: ["./login.component.css"]
})
export class LoginComponent implements OnInit {
  loginForm: FormGroup;

  submitted = false;

  constructor(
    private formBuilder: FormBuilder,
    private router: Router,
    private auth: AuthService,
    private globalEvents: GlobalEventsService
  ) {}

  ngOnInit() {
    this.loginForm = this.formBuilder.group({
      username: ["", Validators.required],
      password: ["", [Validators.required]]
    });
  }

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
    const value = {
      email: this.loginForm.get("username").value,
      password: this.loginForm.get("password").value
    };
    this.auth.doLogin(value).then(
      res => {
        this.router.navigate(["/profile"]);
        this.globalEvents.showNavBar(true);
      },
      err => {
        console.error(err);
      }
    );
  }

  // convenience getter for easy access to form fields
  get g() {
    return this.loginForm.controls;
  }

  showError(error: String) {
    // this.toaster.toastrConfig.toastClass = 'alert';
    // this.toaster.toastrConfig.iconClasses.error = 'alert-danger';
    // this.toaster.error('Cannot login. ' + error + '.');
  }
}
